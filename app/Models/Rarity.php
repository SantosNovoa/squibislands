<?php

namespace App\Models;

<<<<<<< HEAD
class Rarity extends Model {
=======
use Config;
use App\Models\Model;

class Rarity extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'sort', 'color', 'has_image', 'description', 'parsed_description', 'hash', 'has_icon', 'icon_hash',
=======
        'name', 'sort', 'color', 'has_image', 'description', 'parsed_description'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rarities';
<<<<<<< HEAD
=======
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
<<<<<<< HEAD
        'name'        => 'required|unique:rarities|between:3,100',
        'color'       => 'nullable|regex:/^#?[0-9a-fA-F]{6}$/i',
        'description' => 'nullable',
        'image'       => 'mimes:png',
        'icon'        => 'mimes:png',
    ];

=======
        'name' => 'required|unique:rarities|between:3,100',
        'color' => 'nullable|regex:/^#?[0-9a-fA-F]{6}$/i',
        'description' => 'nullable',
        'image' => 'mimes:png',
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
<<<<<<< HEAD
        'name'        => 'required|between:3,100',
        'color'       => 'nullable|regex:/^#?[0-9a-fA-F]{6}$/i',
        'description' => 'nullable',
        'image'       => 'mimes:png',
        'icon'        => 'mimes:png',
    ];

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

=======
        'name' => 'required|between:3,100',
        'color' => 'nullable|regex:/^#?[0-9a-fA-F]{6}$/i',
        'description' => 'nullable',
        'image' => 'mimes:png',
    ];

    /**********************************************************************************************
    
        ACCESSORS

    **********************************************************************************************/
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
        $string = '';

        if ($this->has_icon) {
            $string = '<img src="'.$this->rarityIconUrl.'"/> ';
        }

        return $string.'<a href="'.$this->url.'" class="display-rarity" '.($this->color ? 'style="color: #'.$this->color.';"' : '').'>'.$this->name.'</a>';
    }

    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
    public function getDisplayNameNoIconAttribute() {
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'" class="display-rarity" '.($this->color ? 'style="color: #'.$this->color.';"' : '').'>'.$this->name.'</a>';
    }

    /**
     * Gets the file directory containing the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageDirectoryAttribute() {
=======
    public function getImageDirectoryAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return 'images/data/rarities';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getRarityImageFileNameAttribute() {
        return $this->hash.$this->id.'-image.png';
=======
    public function getRarityImageFileNameAttribute()
    {
        return $this->id . '-image.png';
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getRarityImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

=======
    public function getRarityImagePathAttribute()
    {
        return public_path($this->imageDirectory);
    }
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getRarityImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->rarityImageFileName);
=======
    public function getRarityImageUrlAttribute()
    {
        if (!$this->has_image) return null;
        return asset($this->imageDirectory . '/' . $this->rarityImageFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the URL of the model's encyclopedia page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
        return url('world/rarities?name='.$this->name);
    }

=======
    public function getUrlAttribute()
    {
        return url('world/rarities?name='.$this->name);
    }
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Gets the URL for an encyclopedia search of features (character traits) in this category.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSearchFeaturesUrlAttribute() {
        return url('world/traits?rarity_id='.$this->id);
    }

=======
    public function getSearchFeaturesUrlAttribute()
    {
        return url('world/traits?rarity_id='.$this->id);
    }
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Gets the URL for a masterlist search of characters of this rarity.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSearchCharactersUrlAttribute() {
        return url('masterlist?rarity_id='.$this->id);
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/rarities/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
    }

    /**
     * Gets the file name of the model's icon.
     *
     * @return string
     */
    public function getRarityIconFileNameAttribute() {
        return $this->icon_hash.$this->id.'-icon.png';
    }

    /**
     * Gets the URL of the model's icon.
     *
     * @return string
     */
    public function getRarityIconUrlAttribute() {
        if (!$this->has_icon) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->rarityIconFileName);
    }
=======
    public function getSearchCharactersUrlAttribute()
    {
        return url('masterlist?rarity_id='.$this->id);
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
