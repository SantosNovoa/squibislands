<?php

namespace App\Services;

use App\Facades\Settings;
use App\Models\EventTeam;
use App\Models\User\UserCurrency;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class EventService extends Service {
    /*
    |--------------------------------------------------------------------------
    | Event Service
    |--------------------------------------------------------------------------
    |
    | Handles functions relating to events.
    |
    */

    /**
     * Zeroes currently owned event currency for all users.
     *
     * @param \App\Models\User\User $user
     *
     * @return bool
     */
    public function clearEventCurrency($user) {
        DB::beginTransaction();

        try {
            if (UserCurrency::where('currency_id', Settings::get('event_currency'))->exists()) {
                UserCurrency::where('currency_id', Settings::get('event_currency'))->update(['quantity' => 0]);
            } else {
                throw new \Exception('No event currency exists to be cleared!');
            }

            if (EventTeam::where('score', '>', 0)->exists()) {
                EventTeam::where('score', '>', 0)->update(['score' => 0]);
            }

            $this->logAdminAction($user, 'Cleared Event Currency', 'Cleared event currency and team scores');

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Updates team information.
     * Existing teams are keyed by ID; new teams are keyed "new-N" by the settings page.
     *
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool
     */
    public function updateTeams($data, $user) {
        DB::beginTransaction();

        try {
            // It's important that this processing run even if
            // no information has been provided, e.g. if all
            // teams are being removed. Setting this indicates
            // as much and will allow removals, etc to proceed.
            if (!isset($data['name'])) {
                $data['name'] = [];
            }

            // Delete only removed teams
            foreach (EventTeam::all() as $team) {
                if (!Arr::has($data['name'], $team->id)) {
                    if (Settings::get('event_teams')) {
                        throw new \Exception('Teams cannot be deleted while enabled/an event is ongoing!');
                    }

                    if ($team->has_image && file_exists($team->imagePath.'/'.$team->imageFileName)) {
                        $this->deleteImage($team->imagePath, $team->imageFileName);
                    }

                    if ($team->members()->count()) {
                        $team->members()->update(['team_id' => null]);
                    }

                    $team->delete();
                }
            }

            foreach ($data['name'] as $key => $teamName) {
                if ($teamName == null) {
                    throw new \Exception('Team name is required.');
                }
                $isExisting = is_numeric($key) && EventTeam::where('id', $key)->exists();

                if (EventTeam::where('name', $teamName)->when($isExisting, function ($query) use ($key) {
                    $query->where('id', '!=', $key);
                })->exists()) {
                    throw new \Exception('A team with this name already exists.');
                }

                if ($isExisting) {
                    $team = EventTeam::where('id', $key)->first();

                    $team->update([
                        'name'  => $teamName,
                        'score' => isset($data['score'][$key]) && is_numeric($data['score'][$key]) ? (int) $data['score'][$key] : $team->score,
                    ]);

                    if (isset($data['image'][$key])) {
                        $team->update(['has_image' => 1]);
                        if (!$this->handleImage($data['image'][$key], $team->imagePath, $team->imageFileName)) {
                            throw new \Exception('Failed to upload team image.');
                        }
                    } elseif (isset($data['remove_image'][$key]) && $data['remove_image'][$key] && $team->has_image) {
                        $team->update(['has_image' => 0]);
                        if (file_exists($team->imagePath.'/'.$team->imageFileName)) {
                            $this->deleteImage($team->imagePath, $team->imageFileName);
                        }
                    }
                } else {
                    $team = EventTeam::create([
                        'name' => $teamName,
                    ]);

                    if (!$team) {
                        throw new \Exception('Failed to create team.');
                    }

                    if (isset($data['image'][$key])) {
                        $team->update(['has_image' => 1]);
                        if (!$this->handleImage($data['image'][$key], $team->imagePath, $team->imageFileName)) {
                            throw new \Exception('Failed to upload team image.');
                        }
                    }
                }
            }

            $this->logAdminAction($user, 'Updated Event Teams', 'Updated event teams');

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
