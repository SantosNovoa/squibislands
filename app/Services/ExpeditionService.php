<?php

namespace App\Services;

use App\Services\Service;

use DB;
use Carbon\Carbon;

use App\Models\Expedition\Expedition;
use App\Models\Expedition\ExpeditionLog;
use App\Models\Expedition\ExpeditionReward;
use App\Models\Character\Character;
use App\Models\Item\Item;
use App\Models\Currency\Currency;
use App\Models\Loot\LootTable;

class ExpeditionService extends Service
{
    /*
    |--------------------------------------------------------------------------
    | Expedition Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation/editing of expeditions, and processing character trips.
    |
    */

    /**********************************************************************************************

        ADMIN: EXPEDITION TEMPLATES

     **********************************************************************************************/

    /**
     * 
     *
     * @param  array  $data
     * @return bool|\App\Models\Expedition\Expedition
     */
    public function createExpedition($data)
    {
        DB::beginTransaction();

        try {
            if (Expedition::where('name', $data['name'])->exists()) throw new \Exception("The name has already been taken.");

            $data = $this->populateExpeditionData($data);

            $expedition = Expedition::create($data);

            if (isset($data['image']) && $data['image']) {
                $this->handleImage($data['image'], $expedition->expeditionImagePath, $expedition->expeditionImageFileName);
            }

            $this->populateRewards($data, $expedition);

            return $this->commitReturn($expedition);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * 
     *
     * @param  \App\Models\Expedition\Expedition  $expedition
     * @param  array                              $data
     * @return bool|\App\Models\Expedition\Expedition
     */
    public function updateExpedition($expedition, $data)
    {
        DB::beginTransaction();

        try {
            if (Expedition::where('name', $data['name'])->where('id', '!=', $expedition->id)->exists()) throw new \Exception("The name has already been taken.");

            $data = $this->populateExpeditionData($data, $expedition);

            $expedition->update($data);

            $this->populateRewards($data, $expedition);

            return $this->commitReturn($expedition);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * 
     *
     * @param  array                              $data
     * @param  \App\Models\Expedition\Expedition  $expedition
     * @return array
     */
    private function populateExpeditionData($data, $expedition = null)
    {
        $data['is_active'] = isset($data['is_active']);

        if (isset($data['image']) && $data['image']) {
            $data['has_image'] = 1;
        }

        if (isset($data['remove_image'])) {
            if ($expedition && $expedition->has_image && $data['remove_image']) {
                $data['has_image'] = 0;
                $this->deleteImage($expedition->expeditionImagePath, $expedition->expeditionImageFileName);
            }
            unset($data['remove_image']);
        }

        return $data;
    }

    /**
     * 
     *
     * @param  \App\Models\Expedition\Expedition  $expedition
     * @return bool
     */
    public function deleteExpedition($expedition)
    {
        DB::beginTransaction();

        try {
            if ($expedition->logs()->where('is_claimed', 0)->exists()) {
                throw new \Exception("This expedition has active or unclaimed trips and cannot be deleted.");
            }

            if ($expedition->has_image) $this->deleteImage($expedition->expeditionImagePath, $expedition->expeditionImageFileName);

            $expedition->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * Processes an expedition's configured rewards into a distributable assets array.
     *
     * @param  \App\Models\Expedition\Expedition  $expedition
     * @return array
     */
    private function processRewards($expedition)
    {
        $assets = createAssetsArray(false);

        foreach ($expedition->rewards as $expeditionReward) {
            $reward = null;
            switch ($expeditionReward->rewardable_type) {
                case 'Item':
                    $reward = Item::find($expeditionReward->rewardable_id);
                    break;
                case 'Currency':
                    $reward = Currency::find($expeditionReward->rewardable_id);
                    if (!$reward->is_user_owned) throw new \Exception("Invalid currency selected.");
                    break;
                case 'LootTable':
                    $reward = LootTable::find($expeditionReward->rewardable_id);
                    break;
            }
            if (!$reward) continue;

            if ($expeditionReward->rewardable_type == 'LootTable') {
            // Roll it now so we know exactly what was won, not just "entered into a table"
            $assets = mergeAssetsArrays($assets, $reward->roll($expeditionReward->quantity));
            } else {
                addAsset($assets, $reward, $expeditionReward->quantity);
            }
        }

        return $assets;
    }


    /**********************************************************************************************

        USER: SENDING CHARACTERS

     **********************************************************************************************/

    /**
     * 
     *
     * @param  \App\Models\Expedition\Expedition  $expedition
     * @param  array                              $characterIds
     * @param  \App\Models\User\User               $user
     * @return bool|\App\Models\Expedition\ExpeditionLog
     */
    public function sendExpedition($expedition, $characterIds, $user)
    {
        DB::beginTransaction();

        try {
            if (!$expedition->is_active) throw new \Exception("This expedition is not currently available.");

            if (!count($characterIds)) throw new \Exception("Please select at least one character to send.");

            if (count($characterIds) > $expedition->max_characters) {
                throw new \Exception("You can only send up to " . $expedition->max_characters . " character(s) on this expedition.");
            }

            // confirm every character exists and is owned by this user
            $characters = Character::whereIn('id', $characterIds)->where('user_id', $user->id)->get();
            if ($characters->count() != count($characterIds)) {
                throw new \Exception("One or more selected characters could not be found in your roster.");
            }

            // is any selected character already on an unclaimed trip?
            $busyIds = DB::table('expedition_log_character')
                ->join('expedition_logs', 'expedition_logs.id', '=', 'expedition_log_character.expedition_log_id')
                ->where('expedition_logs.is_claimed', 0)
                ->whereIn('expedition_log_character.character_id', $characterIds)
                ->pluck('expedition_log_character.character_id')
                ->toArray();

            if (count($busyIds)) {
                $names = Character::whereIn('id', $busyIds)->pluck('slug')->implode(', ');
                throw new \Exception("The following character(s) are already on an expedition: " . $names);
            }

            $existingLog = ExpeditionLog::where('expedition_id', $expedition->id)
                ->where('user_id', $user->id)
                ->where('is_claimed', 0)
                ->exists();

            if ($existingLog) {
                throw new \Exception("You already have an active trip on this expedition. Wait for it to finish and claim it before sending another.");
            }

            $log = ExpeditionLog::create([
                'expedition_id' => $expedition->id,
                'user_id'       => $user->id,
                'started_at'    => Carbon::now(),
                'completes_at'  => Carbon::now()->addHours($expedition->duration_hours),
                'is_processed'  => 0,
                'is_claimed'    => 0,
            ]);

            $log->characters()->attach($characterIds);

            return $this->commitReturn($log);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * Claims a completed expedition log, marking it claimed and freeing its characters.
     *
     * @param  \App\Models\Expedition\ExpeditionLog  $log
     * @param  \App\Models\User\User                 $user
     * @return bool
     */
    public function claimExpedition($log, $user)
    {
        DB::beginTransaction();

        try {
            if ($log->user_id != $user->id) throw new \Exception("This expedition does not belong to you.");
            if (!$log->is_processed) throw new \Exception("This expedition has not finished yet.");
            if ($log->is_claimed) throw new \Exception("This expedition has already been claimed.");

            $earnedRewards = [];
            if ($log->success) {
                $rewards = $this->processRewards($log->expedition);
                $assets = fillUserAssets($rewards, null, $user, 'Expedition Reward', ['data' => 'Received rewards for completing an expedition (#' . $log->id . ')']);
                if (!$assets) throw new \Exception("Failed to distribute rewards to user.");
                $earnedRewards = $rewards;
            }

            $log->is_claimed = 1;
            $log->save();

            return $this->commitReturn(['log' => $log, 'rewards' => $earnedRewards]);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }


    /**
     * Processes user input for creating/updating expedition rewards.
     *
     * @param  array                              $data
     * @param  \App\Models\Expedition\Expedition  $expedition
     */
    private function populateRewards($data, $expedition)
    {
        // Clear the old rewards first, then re-add whatever was submitted
        $expedition->rewards()->delete();

        if (isset($data['rewardable_type'])) {
            foreach ($data['rewardable_type'] as $key => $type) {
                if ($type != null) {
                    ExpeditionReward::create([
                        'expedition_id'   => $expedition->id,
                        'rewardable_type' => $type,
                        'rewardable_id'   => $data['rewardable_id'][$key],
                        'quantity'        => $data['quantity'][$key],
                    ]);
                }
            }
        }
    }
}