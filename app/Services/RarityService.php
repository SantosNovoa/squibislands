<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\Character\Character;
use App\Models\Character\CharacterImage;
use App\Models\Rarity;
use Illuminate\Support\Facades\DB;

class RarityService extends Service {
=======
<?php namespace App\Services;

use App\Services\Service;

use DB;
use Config;

use App\Models\Rarity;
use App\Models\Character\Character;
use App\Models\Character\CharacterImage;

class RarityService extends Service
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Rarity Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of rarities.
    |
    */

    /**
     * Creates a new rarity.
     *
<<<<<<< HEAD
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool|Rarity
     */
    public function createRarity($data, $user) {
=======
     * @param  array                  $data 
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\Rarity
     */
    public function createRarity($data, $user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            $data = $this->populateData($data);

            $image = null;
<<<<<<< HEAD
            if (isset($data['image']) && $data['image']) {
                $data['hash'] = randomString(10);
                $data['has_image'] = 1;
                $image = $data['image'];
                unset($data['image']);
            } else {
                $data['has_image'] = 0;
            }

            $icon = null;
            if (isset($data['icon']) && $data['icon']) {
                $data['icon_hash'] = randomString(10);
                $data['has_icon'] = 1;
                $icon = $data['icon'];
                unset($data['icon']);
            } else {
                $data['has_icon'] = 0;
            }

            $rarity = Rarity::create($data);

            if ($image) {
                $this->handleImage($image, $rarity->rarityImagePath, $rarity->rarityImageFileName);
            }

            if ($icon) {
                $this->handleImage($image, $rarity->rarityImagePath, $rarity->rarityIconFileName);
            }

            return $this->commitReturn($rarity);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
            if(isset($data['image']) && $data['image']) {
                $data['has_image'] = 1;
                $image = $data['image'];
                unset($data['image']);
            }
            else $data['has_image'] = 0;

            $rarity = Rarity::create($data);

            if ($image) $this->handleImage($image, $rarity->rarityImagePath, $rarity->rarityImageFileName);

            return $this->commitReturn($rarity);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Updates a rarity.
     *
<<<<<<< HEAD
     * @param Rarity                $rarity
     * @param array                 $data
     * @param \App\Models\User\User $user
     *
     * @return bool|Rarity
     */
    public function updateRarity($rarity, $data, $user) {
=======
     * @param  \App\Models\Rarity     $rarity
     * @param  array                  $data 
     * @param  \App\Models\User\User  $user
     * @return bool|\App\Models\Rarity
     */
    public function updateRarity($rarity, $data, $user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            // More specific validation
<<<<<<< HEAD
            if (Rarity::where('name', $data['name'])->where('id', '!=', $rarity->id)->exists()) {
                throw new \Exception('The name has already been taken.');
            }

            $data = $this->populateData($data, $rarity);

            $image = null;
            if (isset($data['image']) && $data['image']) {
                $data['has_image'] = 1;
                $data['hash'] = randomString(10);
=======
            if(Rarity::where('name', $data['name'])->where('id', '!=', $rarity->id)->exists()) throw new \Exception("The name has already been taken.");

            $data = $this->populateData($data, $rarity);

            $image = null;            
            if(isset($data['image']) && $data['image']) {
                $data['has_image'] = 1;
>>>>>>> Cylunny/extension/polls-and-forms
                $image = $data['image'];
                unset($data['image']);
            }

<<<<<<< HEAD
            $icon = null;
            if (isset($data['icon']) && $data['icon']) {
                $data['has_icon'] = 1;
                $data['icon_hash'] = randomString(10);
                $icon = $data['icon'];
                unset($data['icon']);
            }

            $rarity->update($data);

            if ($rarity) {
                $this->handleImage($image, $rarity->rarityImagePath, $rarity->rarityImageFileName);
            }

            if ($icon) {
                $this->handleImage($icon, $rarity->rarityImagePath, $rarity->rarityIconFileName);
            }

            return $this->commitReturn($rarity);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Deletes a rarity.
     *
     * @param Rarity $rarity
     *
     * @return bool
     */
    public function deleteRarity($rarity) {
        DB::beginTransaction();

        try {
            // Check first if characters with this rarity exist
            if (CharacterImage::where('rarity_id', $rarity->id)->exists() || Character::where('rarity_id', $rarity->id)->exists()) {
                throw new \Exception('A character or character image with this rarity exists. Please change its rarity first.');
            }

            if ($rarity->has_image) {
                $this->deleteImage($rarity->rarityImagePath, $rarity->rarityImageFileName);
            }
            $rarity->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }

    /**
     * Sorts rarity order.
     *
     * @param array $data
     *
     * @return bool
     */
    public function sortRarity($data) {
        DB::beginTransaction();

        try {
            // explode the sort array and reverse it since the order is inverted
            $sort = array_reverse(explode(',', $data));

            foreach ($sort as $key => $s) {
                Rarity::where('id', $s)->update(['sort' => $key]);
            }

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
            $rarity->update($data);

            if ($rarity) $this->handleImage($image, $rarity->rarityImagePath, $rarity->rarityImageFileName);

            return $this->commitReturn($rarity);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Processes user input for creating/updating a rarity.
     *
<<<<<<< HEAD
     * @param array  $data
     * @param Rarity $rarity
     *
     * @return array
     */
    private function populateData($data, $rarity = null) {
        if (isset($data['description']) && $data['description']) {
            $data['parsed_description'] = parse($data['description']);
        }

        if (isset($data['color'])) {
            $data['color'] = str_replace('#', '', $data['color']);
        }

        if (isset($data['remove_image'])) {
            if ($rarity && $rarity->has_image && $data['remove_image']) {
                $data['has_image'] = 0;
                $this->deleteImage($rarity->rarityImagePath, $rarity->rarityImageFileName);
=======
     * @param  array               $data 
     * @param  \App\Models\Rarity  $rarity
     * @return array
     */
    private function populateData($data, $rarity = null)
    {
        if(isset($data['description']) && $data['description']) $data['parsed_description'] = parse($data['description']);

        if(isset($data['color'])) $data['color'] = str_replace('#', '', $data['color']);
        
        if(isset($data['remove_image']))
        {
            if($rarity && $rarity->has_image && $data['remove_image']) 
            { 
                $data['has_image'] = 0; 
                $this->deleteImage($rarity->rarityImagePath, $rarity->rarityImageFileName); 
>>>>>>> Cylunny/extension/polls-and-forms
            }
            unset($data['remove_image']);
        }

<<<<<<< HEAD
        if (isset($data['remove_icon'])) {
            if ($rarity && $rarity->has_icon && $data['remove_icon']) {
                $data['has_icon'] = 0;
                $this->deleteImage($rarity->rarityImagePath, $rarity->rarityIconFileName);
            }
            unset($data['remove_icon']);
        }

        return $data;
    }
}
=======
        return $data;
    }
    
    /**
     * Deletes a rarity.
     *
     * @param  \App\Models\Rarity  $rarity
     * @return bool
     */
    public function deleteRarity($rarity)
    {
        DB::beginTransaction();

        try {         
            // Check first if characters with this rarity exist
            if(CharacterImage::where('rarity_id', $rarity->id)->exists() || Character::where('rarity_id', $rarity->id)->exists()) throw new \Exception("A character or character image with this rarity exists. Please change its rarity first.");

            if($rarity->has_image) $this->deleteImage($rarity->rarityImagePath, $rarity->rarityImageFileName); 
            $rarity->delete();

            return $this->commitReturn(true);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }

    /**
     * Sorts rarity order.
     *
     * @param  array  $data
     * @return bool
     */
    public function sortRarity($data)
    {
        DB::beginTransaction();

        try {
            // explode the sort array and reverse it since the order is inverted
            $sort = array_reverse(explode(',', $data));

            foreach($sort as $key => $s) {
                Rarity::where('id', $s)->update(['sort' => $key]);
            }

            return $this->commitReturn(true);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }
}
>>>>>>> Cylunny/extension/polls-and-forms
