<?php

namespace App\Services;

use App\Models\Boss\Boss;
use App\Models\Boss\BossReward;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class BossService extends Service {
    /*
    |--------------------------------------------------------------------------
    | Boss Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of bosses.
    |
    */

    /**********************************************************************************************

        BOSSES

    **********************************************************************************************/

    /**
     * Creates a new boss.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return \App\Models\Boss\Boss|bool
     */
    public function createBoss($data, $user) {
        DB::beginTransaction();

        try {
            if (Boss::where('name', $data['name'])->exists()) {
                throw new \Exception('The name has already been taken.');
            }

            $data = $this->populateData($data);

            $image = null;
            if (isset($data['image']) && $data['image']) {
                $data['has_image'] = 1;
                $data['hash'] = randomString(10);
                $image = $data['image'];
                unset($data['image']);
            } else {
                $data['has_image'] = 0;
            }

            $boss = Boss::create(Arr::only($data, [
                'name', 'description', 'has_image', 'is_active', 'start_at', 'end_at', 'total_health', 'current_health', 'type', 'can_attack_after_defeat',
                'is_rewards_only_for_participants', 'hash', 'attack_methods', 'is_staff_only', 'allow_users_to_claim_rewards', 'is_reversed',
            ]));

            if (!$this->logAdminAction($user, 'Created Boss', 'Created '.$boss->displayName)) {
                throw new \Exception('Failed to log admin action.');
            }

            if ($image) {
                $this->handleImage($image, $boss->imagePath, $boss->imageFileName);
            }
            $this->processStageImages($data, $boss);
            $this->populateRewards(Arr::only($data, ['rewardable_type', 'rewardable_id', 'quantity', 'threshold']), $boss);

            return $this->commitReturn($boss);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates an boss.
     *
     * @param \App\Models\Boss\Boss $boss
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return \App\Models\Boss\Boss|bool
     */
    public function updateBoss($boss, $data, $user) {
        DB::beginTransaction();

        try {
            // More specific validation
            if (Boss::where('name', $data['name'])->where('id', '!=', $boss->id)->exists()) {
                throw new \Exception('The name has already been taken.');
            }

            $data = $this->populateData($data, $boss);

            $image = null;
            if (isset($data['image']) && $data['image']) {
                $data['has_image'] = 1;
                $data['hash'] = randomString(10);
                $image = $data['image'];
                unset($data['image']);
            }

            $boss->update(Arr::only($data, [
                'name', 'description', 'has_image', 'is_active', 'start_at', 'end_at', 'total_health', 'current_health', 'type', 'can_attack_after_defeat',
                'is_rewards_only_for_participants', 'hash', 'attack_methods', 'is_staff_only', 'allow_users_to_claim_rewards', 'is_reversed',
            ]));

            // we don't need to worry about unset etc here
            // because we're updating after the general data
            $this->processAttackMethods($data, $boss);

            if ($image) {
                $this->handleImage($image, $boss->imagePath, $boss->imageFileName);
            }
            $this->processStageImages($data, $boss); // we leave it outside the if statement because we want to update the stage images even if there's no image
            $this->populateRewards(Arr::only($data, ['rewardable_type', 'rewardable_id', 'quantity', 'threshold']), $boss);

            if (!$this->logAdminAction($user, 'Updated Boss', 'Updated '.$boss->displayName)) {
                throw new \Exception('Failed to log admin action.');
            }

            return $this->commitReturn($boss);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Deletes an boss.
     *
     * @param \App\Models\Boss\Boss $boss
     * @param mixed                 $user
     *
     * @return bool
     */
    public function deleteBoss($boss, $user) {
        DB::beginTransaction();

        try {
            if (!$this->logAdminAction($user, 'Deleted Boss', 'Deleted '.$boss->name)) {
                throw new \Exception('Failed to log admin action.');
            }

            if ($boss->has_image) {
                $this->deleteImage($boss->imagePath, $boss->imageFileName);
            }
            $boss->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Processes user input for creating/updating an boss.
     *
     * @param array                 $data
     * @param \App\Models\Boss\Boss $boss
     *
     * @return array
     */
    private function populateData($data, $boss = null) {
        if (isset($data['description']) && $data['description']) {
            $data['description'] = parse($data['description']);
        }
        if (!isset($data['total_health'])) {
            $data['total_health'] = 1;
        }
        if (!isset($data['current_health'])) {
            $data['current_health'] = 0;
        }
        if (!isset($data['is_active'])) {
            $data['is_active'] = 0;
        }
        if (!isset($data['can_attack_after_defeat'])) {
            $data['can_attack_after_defeat'] = 0;
        }
        if (!isset($data['is_rewards_only_for_participants'])) {
            $data['is_rewards_only_for_participants'] = 0;
        }
        if (!isset($data['is_staff_only'])) {
            $data['is_staff_only'] = 0;
        }
        if (!isset($data['allow_users_to_claim_rewards'])) {
            $data['allow_users_to_claim_rewards'] = 0;
        }
        if (!isset($data['is_reversed'])) {
            $data['is_reversed'] = 0;
        }

        if (isset($data['remove_image'])) {
            if ($boss && $boss->has_image && $data['remove_image']) {
                $data['has_image'] = 0;
                $this->deleteImage($boss->imagePath, $boss->imageFileName);
            }
            unset($data['remove_image']);
        }

        return $data;
    }

    /**
     * Process the stage images for bosses.
     *
     * @param array                 $data
     * @param \App\Models\Boss\Boss $boss
     */
    private function processStageImages($data, $boss) {
        $imageData = [];
        if (isset($boss->stage_images) && $boss->stage_images) {
            foreach ($boss->stage_images as $health => $image) {
                if (isset($data['old_stage_images'][$health]) && $data['old_stage_images'][$health]) {
                    $imageData[$health] = $image;
                } else {
                    $this->deleteImage($boss->imagePath, $image);
                }
            }
        }

        if (isset($data['stage_images']) && $data['stage_images']) {
            foreach ($data['stage_images'] as $key => $image) {
                if (!isset($data['stage_image_health'][$key])) {
                    continue;
                }

                $this->handleImage($image, $boss->imagePath, $boss->getStageImageFileName($data['stage_image_health'][$key]));
                $imageData[$data['stage_image_health'][$key]] = $boss->getStageImageFileName($data['stage_image_health'][$key]);
            }
        }

        $boss->update([
            'stage_images' => $imageData,
        ]);
    }

    /**
     * Process the attack methods & information for the boss.
     *
     * @param array                 $data
     * @param \App\Models\Boss\Boss $boss
     */
    private function processAttackMethods($data, $boss) {
        $information = [
            'methods'     => $data['attack_methods'] ?? [],
            'information' => [],
        ];

        if (isset($data['attack_methods_info']) && $data['attack_methods_info']) {
            foreach ($data['attack_methods_info'] as $key => $info) {
                $information['information'][$key] = $info;
            }
        }

        $boss->update([
            'attack_methods' => $information,
        ]);

        return $information;
    }

    /**
     * Processes user input for creating/updating boss rewards.
     *
     * @param array                 $data
     * @param \App\Models\Boss\Boss $boss
     */
    private function populateRewards($data, $boss) {
        // Clear the old rewards...
        $boss->rewards()->delete();

        if (isset($data['rewardable_type'])) {
            foreach ($data['rewardable_type'] as $key => $type) {
                BossReward::create([
                    'boss_id'         => $boss->id,
                    'rewardable_type' => $type,
                    'rewardable_id'   => $data['rewardable_id'][$key],
                    'quantity'        => $data['quantity'][$key],
                    'threshold'       => $data['threshold'][$key] ?? 0,
                ]);
            }
        }
    }
}
