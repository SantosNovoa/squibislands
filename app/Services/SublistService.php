<<<<<<< HEAD
<?php

namespace App\Services;

use App\Models\Character\CharacterCategory;
use App\Models\Character\Sublist;
use App\Models\Species\Species;
use Illuminate\Support\Facades\DB;

class SublistService extends Service {
=======
<?php namespace App\Services;

use App\Services\Service;

use DB;
use Config;

use App\Models\Character\Sublist;
use App\Models\Character\CharacterCategory;
use App\Models\Species\Species;

class SublistService extends Service
{
>>>>>>> Cylunny/extension/polls-and-forms
    /*
    |--------------------------------------------------------------------------
    | Sub Masterlist Service
    |--------------------------------------------------------------------------
    |
    | Handles the creation and editing of sub masterlists.
    |
    */

    /**********************************************************************************************
<<<<<<< HEAD

=======
     
>>>>>>> Cylunny/extension/polls-and-forms
        SUB MASTERLISTS

    **********************************************************************************************/

    /**
     * Create a sublist.
     *
<<<<<<< HEAD
     * @param array $data
     * @param array $contents
     *
     * @return bool|Sublist
     */
    public function createSublist($data, $contents) {
=======
     * @param  array                 $data
     * @param  array                 $contents
     * @return \App\Models\Character\Sublist|bool
     */
    public function createSublist($data, $contents)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            $sublist = Sublist::create($data);

            //update categories and species
<<<<<<< HEAD
            if (isset($contents['categories']) && $contents['categories']) {
                CharacterCategory::whereIn('id', $contents['categories'])->update(['masterlist_sub_id' => $sublist->id]);
            }
            if (isset($contents['species']) && $contents['species']) {
                Species::whereIn('id', $contents['species'])->update(['masterlist_sub_id' => $sublist->id]);
            }

            return $this->commitReturn($sublist);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
            if(isset($contents['categories']) && $contents['categories'])
            {
                CharacterCategory::whereIn('id', $contents['categories'])->update(array('masterlist_sub_id' => $sublist->id));
            }
            if(isset($contents['species']) && $contents['species'])
            {
                Species::whereIn('id', $contents['species'])->update(array('masterlist_sub_id' => $sublist->id));
            }

            return $this->commitReturn($sublist);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Update a sublist.
     *
<<<<<<< HEAD
     * @param Sublist $sublist
     * @param array   $data
     * @param array   $contents
     *
     * @return bool|Sublist
     */
    public function updateSublist($sublist, $data, $contents) {
=======
     * @param  \App\Models\Character\Sublist        $sublist
     * @param  array                                $data
     * @param  array                                $contents
     * @param  \App\Models\User\User                $user
     * @return \App\Models\Character\Sublist|bool
     */
    public function updateSublist($sublist, $data, $contents)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            // More specific validation
<<<<<<< HEAD
            if (Sublist::where('name', $data['name'])->where('id', '!=', $sublist->id)->exists()) {
                throw new \Exception('The name has already been taken.');
            }
=======
            if(Sublist::where('name', $data['name'])->where('id', '!=', $sublist->id)->exists()) throw new \Exception("The name has already been taken.");
>>>>>>> Cylunny/extension/polls-and-forms

            //update sublist
            $sublist->update($data);

            //update categories and species
<<<<<<< HEAD
            CharacterCategory::where('masterlist_sub_id', $sublist->id)->update(['masterlist_sub_id' => 0]);
            Species::where('masterlist_sub_id', $sublist->id)->update(['masterlist_sub_id' => 0]);
            if (isset($contents['categories'])) {
                CharacterCategory::whereIn('id', $contents['categories'])->update(['masterlist_sub_id' => $sublist->id]);
            }
            if (isset($contents['species'])) {
                Species::whereIn('id', $contents['species'])->update(['masterlist_sub_id' => $sublist->id]);
            }

            return $this->commitReturn($sublist);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
            CharacterCategory::where('masterlist_sub_id', $sublist->id)->update(array('masterlist_sub_id' => 0));
            Species::where('masterlist_sub_id', $sublist->id)->update(array('masterlist_sub_id' => 0));
            if(isset($contents['categories']))
                CharacterCategory::whereIn('id', $contents['categories'])->update(array('masterlist_sub_id' => $sublist->id));
            if(isset($contents['species']))
                Species::whereIn('id', $contents['species'])->update(array('masterlist_sub_id' => $sublist->id));

            return $this->commitReturn($sublist);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Delete a sublist.
     *
<<<<<<< HEAD
     * @param Sublist $sublist
     *
     * @return bool
     */
    public function deleteSublist($sublist) {
=======
     * @param  \App\Models\Character\Sublist  $sublist
     * @return bool
     */
    public function deleteSublist($sublist)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            // Check first if the sublist is currently in use
<<<<<<< HEAD
            CharacterCategory::where('masterlist_sub_id', $sublist->id)->update(['masterlist_sub_id' => 0]);
            Species::where('masterlist_sub_id', $sublist->id)->update(['masterlist_sub_id' => 0]);

            $sublist->delete();

            return $this->commitReturn(true);
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

=======
            CharacterCategory::where('masterlist_sub_id', $sublist->id)->update(array('masterlist_sub_id' => 0));
            Species::where('masterlist_sub_id', $sublist->id)->update(array('masterlist_sub_id' => 0));
            
            $sublist->delete();

            return $this->commitReturn(true);
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->rollbackReturn(false);
    }

    /**
     * Sorts sublist  order.
     *
<<<<<<< HEAD
     * @param array $data
     *
     * @return bool
     */
    public function sortSublist($data) {
=======
     * @param  array  $data
     * @return bool
     */
    public function sortSublist($data)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        DB::beginTransaction();

        try {
            // explode the sort array and reverse it since the order is inverted
            $sort = array_reverse(explode(',', $data));

<<<<<<< HEAD
            foreach ($sort as $key => $s) {
=======
            foreach($sort as $key => $s) {
>>>>>>> Cylunny/extension/polls-and-forms
                Sublist::where('id', $s)->update(['sort' => $key]);
            }

            return $this->commitReturn(true);
<<<<<<< HEAD
        } catch (\Exception $e) {
            $this->setError('error', $e->getMessage());
        }

        return $this->rollbackReturn(false);
    }
}
=======
        } catch(\Exception $e) { 
            $this->setError('error', $e->getMessage());
        }
        return $this->rollbackReturn(false);
    }
}
>>>>>>> Cylunny/extension/polls-and-forms
