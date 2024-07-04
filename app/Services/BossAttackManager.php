<?php

namespace App\Services;

use App\Models\User\UserBossAttack;
use App\Models\Boss\Boss;
use App\Models\Boss\BossReward;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

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
     * Generic attack method that handles sub calls and logging
     */
    public function attackBoss($boss, $user, $method) {
        DB::beginTransaction();

        try {

            $damage = 0;
            $logType = '';
            $log = '';

            switch ($method) {
                case 'donate_currency':
                    $damage = $this->attackSpendCurrency($boss, $user);
                    $logType = 'Spending Specified Currency';
                    break;
                case 'daily_login':
                    $damage = $this->attackDailyLogin($boss, $user);
                    $logType = 'Daily Login';
                    $log = 'Dealt ' . $damage . ' damage to ' . $boss->name . ' using the daily login attack method.';
                    break;
                case 'donate_item':
                    $damage = $this->attackDonateItem($boss, $user);
                    $logType = 'Donating Items';
                    break;
                case 'donation_shop':
                    $damage = $this->attackDonationShop($boss, $user);
                    $logType = 'Donation Shop';
                    break;
                default:
                    throw new \Exception('Invalid attack method.');
                    break;
            }

            $this->attack($boss, $method, $damage, $user, [
                'logType' => $logType,
                'log' => $log,
            ]);

            return $this->commitReturn($damage);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Generic attack method
     */
    private function attack($boss, $method, $damage, $user, $data) {
        if ($damage > 0 && $boss->type == 'Global') {
            if ($boss->current_health <= 0 && !$boss->can_attack_after_defeat) {
                throw new \Exception('This boss has already been defeated.');
            }
            
            $boss->current_health -= $damage;
            $boss->save();
        }

        $log = UserBossAttack::create([
            'user_id' => $user->id,
            'boss_id' => $boss->id,
            'attack_method' => $method,
            'damage' => $damage,
            'data'    => $data
        ]);
    }

    /**********************************************************************************************

        PUBLIC ATTACK METHODS

    **********************************************************************************************/

    /**
     * Prompt attack method.
     * 
     * @param Boss $boss
     * @param Submission $submission
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
            } else if ($data['damage_calculation_method'] == 'currency') {
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
                'log' => 'Dealt ' . $damage . ' damage to ' . $boss->name . ' using the prompt attack method.',
            ]);

            return $this->commitReturn($damage);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**********************************************************************************************

        PRIVATE ATTACK METHODS

    **********************************************************************************************/

    /**
     * Daily login attack
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
}
