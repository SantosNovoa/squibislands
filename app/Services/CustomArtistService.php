<?php

namespace App\Services;

use App\Models\Currency\Currency;
use App\Models\CustomArtist\CustomArtistAccess;
use App\Models\CustomArtist\CustomArtistProfile;
use App\Models\User\User;
use Illuminate\Support\Facades\DB;

class CustomArtistService extends Service {
    /*
    |--------------------------------------------------------------------------
    | Custom Artist Service
    |--------------------------------------------------------------------------
    |
    | Handles artist entries on the Official Customs page and per-user access.
    |
    */

    /**
     * Saves an artist's own entry: toggles, options, contact and notes.
     *
     * @param User  $user
     * @param array $data
     *
     * @return bool|CustomArtistProfile
     */
    public function updateProfile($user, $data) {
        DB::beginTransaction();

        try {
            if (!CustomArtistAccess::userCanEdit($user)) {
                throw new \Exception('You do not have permission to post a customs entry.');
            }

            $profile = CustomArtistProfile::firstOrCreate(['user_id' => $user->id]);

            // Contact links, kept in the order they were arranged in the form
            $contacts = [];
            foreach ($data['contact_site'] ?? [] as $key => $site) {
                $site = trim($site ?? '');
                $url = trim($data['contact_url'][$key] ?? '');

                // Skip rows left completely blank
                if ($site === '' && $url === '') {
                    continue;
                }
                if ($site === '' || $url === '') {
                    throw new \Exception('Each contact link needs both a website name and a URL.');
                }
                if (!filter_var($url, FILTER_VALIDATE_URL) || !preg_match('/^https?:\/\//i', $url)) {
                    throw new \Exception('The URL for "'.$site.'" must be a full link starting with http:// or https://.');
                }

                $contacts[] = ['site' => $site, 'url' => $url];
            }

            $update = [
                'is_active'    => isset($data['is_active']),
                'contacts'     => count($contacts) ? $contacts : null,
                'notes'        => $data['notes'] ?? null,
                'parsed_notes' => !empty($data['notes']) ? parse($data['notes']) : null,
            ];
            foreach (array_keys(CustomArtistProfile::TYPES) as $type) {
                $update['is_'.$type.'_open'] = isset($data['open'][$type]);
            }
            $profile->update($update);

            // Rebuild options from the form so order, removals and edits all apply at once
            $profile->options()->delete();

            foreach (CustomArtistProfile::TYPES as $type => $label) {
                $rows = $data['options'][$type] ?? [];
                $sort = 0;

                foreach ($rows as $row) {
                    $name = trim($row['name'] ?? '');
                    $price = $row['price'] ?? null;

                    // Skip rows left completely blank
                    if ($name === '' && ($price === null || $price === '')) {
                        continue;
                    }
                    if ($name === '') {
                        throw new \Exception('Every '.$label.' option needs a name.');
                    }
                    if (!is_numeric($price) || $price < 0) {
                        throw new \Exception('The price for "'.$name.'" must be a number of 0 or more.');
                    }

                    $currencyId = !empty($row['currency_id']) ? (int) $row['currency_id'] : null;
                    if ($currencyId) {
                        if (!Currency::where('id', $currencyId)->exists()) {
                            throw new \Exception('The currency for "'.$name.'" is invalid.');
                        }
                        if (floor($price) != $price) {
                            throw new \Exception('The price for "'.$name.'" must be a whole number when using a site currency.');
                        }
                    }

                    $profile->options()->create([
                        'type'        => $type,
                        'name'        => $name,
                        'price'       => $price,
                        'currency_id' => $currencyId,
                        'is_active'   => isset($row['is_active']),
                        'sort'        => $sort++,
                    ]);
                }
            }

            if (!$this->logAdminAction($user, 'Updated Custom Artist Entry', 'Updated their Official Customs entry')) {
                throw new \Exception('Failed to log admin action.');
            }

            return $this->commitReturn($profile);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Gives an individual staff member access, regardless of their rank's powers.
     *
     * @param array $data
     * @param User  $staff
     *
     * @return bool|CustomArtistAccess
     */
    public function grantAccess($data, $staff) {
        DB::beginTransaction();

        try {
            $user = User::find($data['user_id'] ?? null);
            if (!$user) {
                throw new \Exception('Please select a valid user.');
            }
            if (!$user->isStaff) {
                throw new \Exception($user->name.' needs a staff rank to reach the admin panel.');
            }
            if (CustomArtistAccess::where('user_id', $user->id)->exists()) {
                throw new \Exception($user->name.' already has access.');
            }

            $access = CustomArtistAccess::create([
                'user_id'    => $user->id,
                'granted_by' => $staff->id,
            ]);

            if (!$this->logAdminAction($staff, 'Granted Custom Artist Access', 'Granted '.$user->displayName.' access to post an Official Customs entry')) {
                throw new \Exception('Failed to log admin action.');
            }

            return $this->commitReturn($access);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Removes an individual's access. Their entry is kept but stops showing
     * unless their rank has the power.
     *
     * @param CustomArtistAccess $access
     * @param User               $staff
     *
     * @return bool
     */
    public function revokeAccess($access, $staff) {
        DB::beginTransaction();

        try {
            if (!$access) {
                throw new \Exception('Invalid access entry selected.');
            }

            $name = $access->user ? $access->user->displayName : 'Deleted user #'.$access->user_id;
            $access->delete();

            if (!$this->logAdminAction($staff, 'Revoked Custom Artist Access', 'Revoked Official Customs access from '.$name)) {
                throw new \Exception('Failed to log admin action.');
            }

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
