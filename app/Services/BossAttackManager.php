<?php

namespace App\Services;

use App\Models\Boss\Boss;
use App\Models\Currency\Currency;
use App\Models\Item\Item;
use App\Models\User\User;
use App\Models\User\UserBossAttack;
use App\Models\User\UserBossLog;
use App\Models\User\UserItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Notifications;

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
                    if (!isset($damage['damage'])) {
                        throw new \Exception('Invalid damage.');
                    }
                    $damage = $damage['damage'];
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

            return $this->commitReturn(['damage' => $damage]);
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

            if ($boss->is_rewards_only_for_participants && !$boss->hasUserParticipated($user)) {
                throw new \Exception('You have not attacked this boss - rewards are only for participants.');
            }

            if (!$assets = $this->grantRewards($boss, $user)) {
                throw new \Exception('There are no rewards to claim.');
            }

            flash('You have received: '.createRewardsString($assets));

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Staff action: sends every participant the rewards they've earned but not yet received.
     * Safe to run more than once - users who already claimed are skipped.
     *
     * @param Boss       $boss
     * @param mixed|null $staff
     *
     * @return array|bool ['recipients' => int, 'skipped' => int, 'failed' => [username => error]]
     */
    public function distributeRewards($boss, $staff = null) {
        DB::beginTransaction();

        try {
            if (!$boss->rewards()->count()) {
                throw new \Exception('This boss has no rewards to send.');
            }

            $result = $this->distributeToParticipants($boss);

            if ($staff && !$this->logAdminAction($staff, 'Distributed Boss Rewards', 'Sent rewards for '.$boss->displayName.' to '.$result['recipients'].' participant(s)')) {
                throw new \Exception('Failed to log admin action.');
            }

            return $this->commitReturn($result);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Grants rewards to every user who has attacked the boss.
     * Each user gets their own savepoint so one bad reward doesn't undo everyone else's.
     *
     * @param Boss $boss
     *
     * @return array
     */
    private function distributeToParticipants($boss) {
        $result = ['recipients' => 0, 'skipped' => 0, 'failed' => []];

        $users = User::whereIn('id', UserBossAttack::where('boss_id', $boss->id)->select('user_id')->distinct())->get();
        foreach ($users as $user) {
            try {
                $assets = DB::transaction(function () use ($boss, $user) {
                    return $this->grantRewards($boss, $user, true);
                });
                $assets ? $result['recipients']++ : $result['skipped']++;
            } catch (\Exception $e) {
                $result['failed'][$user->name] = $e->getMessage();
                Log::error('Boss reward distribution failed for user '.$user->id.' on boss '.$boss->id.': '.$e->getMessage());
            }
        }

        return $result;
    }

    /**
     * Grants any rewards the user has earned but not yet received for this boss.
     * Shared by user claims, staff distribution and auto-send on defeat, so nobody is paid twice for a threshold.
     * Expects to be called inside a transaction.
     *
     * @param Boss $boss
     * @param User $user
     * @param bool $notify send the user a notification (for rewards they didn't claim themselves)
     *
     * @return array|null the granted assets, or null if there was nothing new to grant
     */
    private function grantRewards($boss, $user, $notify = false) {
        // get the % of damage done to the boss overall
        $userBossLog = UserBossLog::where('user_id', $user->id)->where('boss_id', $boss->id)->first();
        if ($boss->type == 'Global') {
            $damagePercentage = round((($boss->total_health - $boss->current_health) / $boss->total_health) * 100);
        } else {
            $damagePercentage = round(($boss->getLogs($user)->sum('damage') / $boss->total_health) * 100);
        }
        // reward thresholds are inverse, so reward threshold of 100 means 0% damage, and 25% means 75% damage
        // -1 so 'any' threshold is always valid for users who haven't received anything yet
        // (a stored threshold of 0 is a real claim, so don't let ?: turn it back into -1 and pay out twice)
        $claimedThreshold = ($userBossLog && $userBossLog->threshold !== null) ? $userBossLog->threshold : -1;
        $bossRewards = $boss->rewards()->where('threshold', '>', $claimedThreshold)->where('threshold', '<=', $damagePercentage)->get();
        if ($bossRewards->isEmpty()) {
            return null;
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

        if ($userBossLog) {
            // we need to make a new $assets since we might only have some of the rewards in the current $assets
            $dataAssets = createAssetsArray(false);
            $rewards = $boss->rewards()->where('threshold', '<=', $damagePercentage)->get();
            foreach ($rewards as $reward) {
                addAsset($dataAssets, $reward->reward, $reward->quantity);
            }
            $userBossLog->update([
                'data' => [
                    'rewards' => getDataReadyAssets($dataAssets),
                ],
                'threshold' => $damagePercentage,
            ]);
        } else {
            UserBossLog::create([
                'user_id' => $user->id,
                'boss_id' => $boss->id,
                'data'    => [
                    'rewards' => getDataReadyAssets($assets),
                ],
                'threshold' => $damagePercentage,
            ]);
        }

        if ($notify) {
            $this->notifyRewardsReceived($boss, $user, $assets);
        }

        return $assets;
    }

    /**
     * Notifies a user that boss rewards were sent to them.
     * Uses plain-text reward names since notification data is capped at 1024 characters.
     *
     * @param Boss  $boss
     * @param User  $user
     * @param array $assets
     */
    private function notifyRewardsReceived($boss, $user, $assets) {
        $rewards = [];
        foreach ($assets as $contents) {
            foreach ($contents as $asset) {
                $rewards[] = e($asset['asset']->name).' x'.$asset['quantity'];
            }
        }

        Notifications::create('BOSS_REWARDS_RECEIVED', $user, [
            'boss_name' => e($boss->name),
            'boss_slug' => str_replace(' ', '-', $boss->name),
            'rewards'   => \Illuminate\Support\Str::limit(implode(', ', $rewards), 600),
        ]);
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
        $wasDefeated = $this->isDefeatedFor($boss, $user);

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

        // this attack was the killing blow - send rewards if the boss is set to do so
        if ($boss->auto_distribute_rewards && !$wasDefeated && $this->isDefeatedFor($boss, $user)) {
            $this->autoDistributeRewards($boss, $user);
        }
    }

    /**
     * Whether the boss is defeated - globally, or for this user on per-user bosses.
     *
     * @param Boss $boss
     * @param User $user
     *
     * @return bool
     */
    private function isDefeatedFor($boss, $user) {
        if ($boss->type == 'Global') {
            return $boss->current_health <= 0;
        }

        return UserBossAttack::where('boss_id', $boss->id)->where('user_id', $user->id)->sum('damage') >= $boss->total_health;
    }

    /**
     * Sends rewards on defeat. Global bosses pay out every participant; per-user bosses pay the user who won their battle.
     * Failures are logged rather than thrown so a reward problem never cancels the killing blow.
     *
     * @param Boss $boss
     * @param User $user
     */
    private function autoDistributeRewards($boss, $user) {
        if (!$boss->rewards()->count()) {
            return;
        }

        if ($boss->type == 'Global') {
            $result = $this->distributeToParticipants($boss);
            foreach ($result['failed'] as $name => $error) {
                Log::error('Boss auto-distribution: could not reward '.$name.' for boss '.$boss->id.': '.$error);
            }

            return;
        }

        try {
            DB::transaction(function () use ($boss, $user) {
                return $this->grantRewards($boss, $user, true);
            });
        } catch (\Exception $e) {
            Log::error('Boss auto-distribution failed for user '.$user->id.' on boss '.$boss->id.': '.$e->getMessage());
        }
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
            ->whereDate('created_at', now())
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

        if ($min > $max || $min < 0 || $max < 0) {
            throw new \Exception('Invalid damage range.');
        }

        // we have to return as an array to allow 0 damage
        if ($max) {
            return ['damage' => mt_rand($min, $max)];
        }

        return ['damage' => $min];
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
            $rarity = $item->rarity ? $item->rarity->id : 'no_rarity';
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

            $damage *= $requestData['item_quantity']; // multiply by quantity

            return $this->commitReturn($damage);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
