<?php

namespace App\Services;

use App\Models\Boss\Boss;
use App\Models\Currency\Currency;
use App\Models\Item\Item;
use App\Models\User\UserBossAttack;
use App\Models\User\UserBossLog;
use App\Models\User\UserItem;
use Illuminate\Support\Facades\DB;

class BossAttackManager extends Service {
    /*
    |--------------------------------------------------------------------------
    | Boss Attack Manager
    |--------------------------------------------------------------------------
    |
    | Handles user attacks on bosses.
    |
    */

    /**********************************************************************************************

        GENERIC

    **********************************************************************************************/

    /**
     * Generic attack method that handles sub calls and logging.
     *
     * @param mixed      $boss
     * @param mixed      $user
     * @param mixed      $method
     * @param mixed|null $requestData
     */
    public function attackBoss($boss, $user, $method, $requestData = null) {
        DB::beginTransaction();

        try {
            $damage = 0;
            $logType = '';
            $log = '';

            switch ($method) {
                case 'donate_currency':
                    if (!$damage = $this->attackDonateCurrency($boss, $user, $requestData)) {
                        throw new \Exception('Could not complete attack.');
                    }
                    $logType = 'Donating Currency';
                    $log = 'Dealt '.$damage.' damage to '.$boss->name.' by donating '.$requestData['currency_quantity'].' '.Currency::find($requestData['currency_id'])->name.'.';
                    break;
                case 'daily_login':
                    if (!$damage = $this->attackDailyLogin($boss, $user)) {
                        throw new \Exception('Could not complete attack.');
                    }
                    $logType = 'Daily Login';
                    $log = 'Dealt '.$damage.' damage to '.$boss->name.' using the daily login attack method.';
                    break;
                case 'donate_item':
                    if (!$damage = $this->attackDonateItem($boss, $user, $requestData)) {
                        throw new \Exception('Could not complete attack.');
                    }
                    $logType = 'Donating Item';
                    $log = 'Dealt '.$damage.' damage to '.$boss->name.' by donating '.$requestData['item_quantity'].' '.Item::find($requestData['item_id'])->name.'.';
                    break;
                    // case 'donation_shop':
                    //     $damage = $this->attackDonationShop($boss, $user);
                    //     $logType = 'Donation Shop';
                    //     break;
                default:
                    throw new \Exception('Invalid attack method.');
                    break;
            }

            $this->attack($boss, $method, $damage, $user, [
                'logType' => $logType,
                'log'     => $log,
            ]);

            return $this->commitReturn($damage);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**********************************************************************************************

        PUBLIC ATTACK METHODS

    **********************************************************************************************/

    /**
     * Prompt attack method.
     *
     * @param Boss       $boss
     * @param Submission $submission
     * @param mixed      $submissionData
     * @param mixed|null $rewards
     *
     * @return int
     */
    public function attackPrompt($boss, $submission, $submissionData, $rewards = null) {
        DB::beginTransaction();

        try {
            $data = $boss->getAttackMethodInformation('prompt');
            if (!$data || !$data['damage_calculation_method']) {
                throw new \Exception('No data found for this attack method.');
            }

            $damage = 0;
            if ($data['damage_calculation_method'] == 'input') {
                if (!isset($submissionData['boss_damage']) && !isset($submissionData['boss_damage'][$boss->id])) {
                    throw new \Exception('No damage input found.');
                }
                $damage = $submissionData['boss_damage'][$boss->id];
            } elseif ($data['damage_calculation_method'] == 'currency') {
                $currencyRewards = $rewards['currencies'] ?? [];
                if (!isset($data['currency_id'])) {
                    throw new \Exception('No currency set.');
                }

                if ($data['currency_id'] == 'any') {
                    foreach ($currencyRewards as $currencyId => $asset) {
                        $damage += $asset['quantity'];
                    }
                } else {
                    if (isset($currencyRewards[$data['currency_id']])) {
                        $damage = $currencyRewards[$data['currency_id']]['quantity'] ?? 0;
                    }
                }
            } else {
                throw new \Exception('Invalid damage calculation method.');
            }

            $this->attack($boss, 'prompt', $damage, $submission->user, [
                'logType' => 'Prompt Attack',
                'log'     => 'Dealt '.$damage.' damage to '.$boss->name.' using the prompt attack method.',
            ]);

            return $this->commitReturn($damage);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**********************************************************************************************

        REWARDS

    **********************************************************************************************/

    /**
     * Claim rewards for a boss.
     *
     * @param mixed $boss
     * @param mixed $user
     */
    public function claimRewards($boss, $user) {
        DB::beginTransaction();

        try {
            if (!$boss->allow_users_to_claim_rewards) {
                throw new \Exception('You cannot claim rewards for this boss.');
            }

            $userBossAttacks = UserBossAttack::where('user_id', $user->id)->where('boss_id', $boss->id)->get();
            if ($boss->is_rewards_only_for_participants && $userBossAttacks->isEmpty()) {
                throw new \Exception('You have not attacked this boss - rewards are only for participants.');
            }

            // get the % of damage done to the boss overall
            $currentHealth = $boss->current_health < 0 ? 0 : $boss->current_health;
            $threshold = ($boss->total_health - $currentHealth) / $boss->total_health * 100;
            // reward thresholds are inverse, so reward threshold of 100 means 0% damage, and 25% means 75% damage
            $bossRewards = $boss->rewards->where('threshold', '=<', $threshold);
            if ($bossRewards->isEmpty()) {
                throw new \Exception('There are no rewards to claim.');
            }

            $assets = createAssetsArray(false);
            foreach ($bossRewards as $reward) {
                addAsset($assets, $reward->reward, $reward->quantity);
            }

            $logType = 'Boss Rewards';
            $data = [
                'data' => 'Received rewards for defeating the boss '.$boss->displayName,
            ];
            if (!$rewards = fillUserAssets($assets, null, $user, $logType, $data)) {
                throw new \Exception('Failed to distribute rewards to user.');
            }

            flash('You have received: '.createRewardsString($assets));

            UserBossLog::create([
                'user_id' => $user->id,
                'boss_id' => $boss->id,
                'data'    => [
                    'rewards' => getDataReadyAssets($assets),
                ],
            ]);

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Generic attack method.
     *
     * @param mixed $boss
     * @param mixed $method
     * @param mixed $damage
     * @param mixed $user
     * @param mixed $data
     */
    private function attack($boss, $method, $damage, $user, $data) {
        if ($damage > 0 && $boss->type == 'Global') {
            if ($boss->current_health <= 0 && !$boss->can_attack_after_defeat) {
                throw new \Exception('This boss has already been defeated.');
            }

            $boss->current_health -= $damage;
            $boss->save();
        } // dont log if its a user type, since we sum the damage in the user boss attack log

        $log = UserBossAttack::create([
            'user_id'       => $user->id,
            'boss_id'       => $boss->id,
            'attack_method' => $method,
            'damage'        => $damage,
            'data'          => $data,
        ]);
    }

    /**********************************************************************************************

        PRIVATE ATTACK METHODS

    **********************************************************************************************/

    /**
     * Daily login attack.
     *
     * @param Boss $boss
     * @param User $user
     *
     * @return int
     */
    private function attackDailyLogin($boss, $user) {
        // check the user hasn't attacked in the last 24h
        $logs = UserBossAttack::where('user_id', $user->id)
            ->where('boss_id', $boss->id)
            ->where('attack_method', 'daily_login')
            ->where('created_at', '>=', now()->subDay())
            ->count();

        if ($logs) {
            throw new \Exception('You have already attacked this boss today.');
        }

        $data = $boss->getAttackMethodInformation('daily_login');
        if (!$data) {
            throw new \Exception('No data found for this attack method.');
        }

        $min = $data['min_damage'] ?? 0;
        $max = $data['max_damage'] ?? 0;

        if ($max) {
            return mt_rand($min, $max);
        }

        return $min;
    }

    /**
     * Donate currency attack.
     *
     * @param Boss  $boss
     * @param User  $user
     * @param array $requestData
     *
     * @return int
     */
    private function attackDonateCurrency($boss, $user, $requestData) {
        DB::beginTransaction();

        try {
            $data = $boss->getAttackMethodInformation('donate_currency');
            if (!$data || !$data['damage_ratio']) {
                throw new \Exception('No data found for this attack method.');
            }

            if (!isset($requestData['currency_id'])) {
                throw new \Exception('No currency selected.');
            }

            if (!isset($requestData['currency_quantity'])) {
                throw new \Exception('No quantity selected.');
            }

            // 1 is an option instead of erroring in the case of 'any' currency
            $ratio = $data['damage_ratio'][$requestData['currency_id']] ?? 1;

            // make sure quantity can be integer divided by ratio (ex we want damage to be whole numbers)
            if ($requestData['currency_quantity'] % $ratio != 0) {
                throw new \Exception('Invalid quantity.');
            }

            $service = new CurrencyManager;
            if (!$service->debitCurrency($user, null, 'Boss Attack', 'Donated currency to '.$boss->name, Currency::find($requestData['currency_id']), $requestData['currency_quantity'])) {
                throw new \Exception('You do not have enough of this currency to donate.');
            }

            return $this->commitReturn($requestData['currency_quantity'] * $ratio);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Donate item attack.
     *
     * @param Boss  $boss
     * @param User  $user
     * @param array $requestData
     *
     * @return int
     */
    private function attackDonateItem($boss, $user, $requestData) {
        DB::beginTransaction();

        try {
            $data = $boss->getAttackMethodInformation('donate_item');
            if (!$data || !$data['damage_per_item']) {
                throw new \Exception('No data found for this attack method.');
            }

            $item = Item::find($requestData['item_id']);
            if (!$item) {
                throw new \Exception('Invalid item.');
            }

            if (!isset($requestData['item_quantity']) || $requestData['item_quantity'] <= 0) {
                throw new \Exception('No quantity selected.');
            }

            // find the damage for this item, based on rarity if it has one
            $rarity = $item->rarity ? $item->rarity->id : 'no rarity';
            $damage = $data['damage_per_item'][$rarity] ?? 0;

            if (!$damage) {
                throw new \Exception('No damage found for this item.');
            }

            $service = new InventoryManager;
            $userItemSum = UserItem::where('user_id', $user->id)->where('item_id', $item->id)->sum('count');
            if ($userItemSum < $requestData['item_quantity']) {
                throw new \Exception('You do not have enough of this item to donate.');
            }

            $count = $requestData['item_quantity'];
            while ($count > 0) {
                $userItem = UserItem::where('user_id', $user->id)->where('item_id', $item->id)->where('count', '>', 0)->first();
                if (!$userItem) {
                    throw new \Exception('You do not have enough of this item to donate.');
                }

                $quantity = $userItem->count;
                if ($quantity >= $count) {
                    $quantity = $count;
                }

                if (!$service->debitStack($user, 'Boss Attack', [
                    'data' => 'Donated item to attack the boss '.$boss->name,
                ], $userItem, $quantity)) {
                    foreach ($service->errors()->getMessages()['error'] as $error) {
                        flash($error)->error();
                    }
                    throw new \Exception('You do not have enough of this item to donate.');
                }

                $count -= $quantity;
            }

            return $this->commitReturn($damage);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
