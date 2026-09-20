<?php

namespace App\Models\Currency;

<<<<<<< HEAD
use App\Models\Model;

class Currency extends Model {
=======
use Config;
use App\Models\Model;

class Currency extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_user_owned', 'is_character_owned',
        'name', 'abbreviation', 'description', 'parsed_description', 'sort_user', 'sort_character',
        'is_displayed', 'allow_user_to_user', 'allow_user_to_character', 'allow_character_to_user',
<<<<<<< HEAD
        'has_icon', 'has_image', 'hash',
=======
        'has_icon', 'has_image'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currencies';
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
        'name'         => 'required|unique:currencies|between:3,100',
        'abbreviation' => 'nullable|unique:currencies|between:1,25',
        'description'  => 'nullable',
        'icon'         => 'mimes:png',
        'image'        => 'mimes:png',
=======
        'name' => 'required|unique:currencies|between:3,100',
        'abbreviation' => 'nullable|unique:currencies|between:1,25',
        'description' => 'nullable',
        'icon' => 'mimes:png',
        'image' => 'mimes:png'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
<<<<<<< HEAD
        'name'         => 'required|between:3,100',
        'abbreviation' => 'nullable|between:1,25',
        'description'  => 'nullable',
        'icon'         => 'mimes:png',
        'image'        => 'mimes:png',
=======
        'name' => 'required|between:3,100',
        'abbreviation' => 'nullable|between:1,25',
        'description' => 'nullable',
        'icon' => 'mimes:png',
        'image' => 'mimes:png'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

<<<<<<< HEAD
        RELATIONSHIPS

    **********************************************************************************************/

    /**
     * Get the conversion options for the currency.
     */
    public function conversions() {
        return $this->hasMany(CurrencyConversion::class, 'currency_id');
    }

    /**********************************************************************************************

=======
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the currency as an icon with tooltip.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayIconAttribute() {
        return '<img src="'.$this->currencyIconUrl.'" title="'.$this->name.($this->abbreviation ? ' ('.$this->abbreviation.')' : '').'" data-toggle="tooltip" alt="'.$this->name.'"/>';
=======
    public function getDisplayIconAttribute()
    {
        return '<img src="'.$this->currencyIconUrl.'" title="'.$this->name . ($this->abbreviation ? ' ('.$this->abbreviation.')' : '') .'" data-toggle="tooltip" alt="'.$this->name.'"/>';
>>>>>>> Cylunny/extension/polls-and-forms
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
        return 'images/data/currencies';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCurrencyImageFileNameAttribute() {
        return $this->hash.$this->id.'-image.png';
=======
    public function getCurrencyImageFileNameAttribute()
    {
        return $this->id . '-image.png';
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the file name of the model's icon image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCurrencyIconFileNameAttribute() {
        return $this->hash.$this->id.'-icon.png';
=======
    public function getCurrencyIconFileNameAttribute()
    {
        return $this->id . '-icon.png';
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCurrencyImagePathAttribute() {
=======
    public function getCurrencyImagePathAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the path to the file directory containing the model's icon image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCurrencyIconPathAttribute() {
=======
    public function getCurrencyIconPathAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCurrencyImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->currencyImageFileName);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
    public function getImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->currencyImageFileName);
=======
    public function getCurrencyImageUrlAttribute()
    {
        if (!$this->has_image) return null;
        return asset($this->imageDirectory . '/' . $this->currencyImageFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the URL of the model's icon image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCurrencyIconUrlAttribute() {
        if (!$this->has_icon) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->currencyIconFileName);
=======
    public function getCurrencyIconUrlAttribute()
    {
        if (!$this->has_icon) return null;
        return asset($this->imageDirectory . '/' . $this->currencyIconFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the model's name, linked to its encyclopedia page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'" class="display-currency">'.$this->name.'</a>';
    }

    /**
     * Gets the URL of the model's encyclopedia page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('world/currencies?name='.$this->name);
    }

    /**
     * Gets the currency's asset type for asset management.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getAssetTypeAttribute() {
        return 'currencies';
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/currencies/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
    }

=======
    public function getAssetTypeAttribute()
    {
        return 'currencies';
    }

>>>>>>> Cylunny/extension/polls-and-forms
    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Displays a given value of the currency with icon, abbreviation or name.
     *
<<<<<<< HEAD
     * @param mixed $value
     *
     * @return string
     */
    public function display($value) {
        $ret = '<span class="display-currency">';
        
        if ($this->has_icon) {
            $ret .= $this->displayIcon;
        } elseif ($this->abbreviation) {
            $ret .= $this->abbreviation;
        } else {
            $ret .= $this->name;
        }
        
        $ret .= ' '.$value;

        return $ret.'</span>';
=======
     * @return string
     */
    public function display($value)
    {
        $ret = '<span class="display-currency">' . $value . ' ';
        if($this->has_icon) $ret .= $this->displayIcon;
        elseif ($this->abbreviation) $ret .= $this->abbreviation;
        else $ret .= $this->name;
        return $ret . '</span>';
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
