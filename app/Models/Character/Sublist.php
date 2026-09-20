<?php

namespace App\Models\Character;

use App\Models\Model;
<<<<<<< HEAD
use App\Models\Species\Species;

class Sublist extends Model {
=======

use App\Models\Character\Character;
use App\Models\Character\CharacterImage;
use App\Models\Character\CharacterCategory;
use App\Models\Species\Species;

class Sublist extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'key', 'show_main', 'sort',
=======
        'name', 'key', 'show_main', 'sort'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'masterlist_sub';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'name' => 'required|unique:masterlist_sub|between:3,25',
<<<<<<< HEAD
        'key'  => 'required|unique:masterlist_sub|between:3,25|alpha_dash',
    ];

=======
        'key' => 'required|unique:masterlist_sub|between:3,25|alpha_dash'
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'name' => 'required|between:3,25',
<<<<<<< HEAD
        'key'  => 'required|between:3,25|alpha_dash',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get all character categories associated with the sub list.
     */
    public function categories() {
        return $this->hasMany(CharacterCategory::class, 'masterlist_sub_id');
=======
        'key' => 'required|between:3,25|alpha_dash'
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get all character categories associated with the sub list.
     */
    public function categories() 
    {
        return $this->hasMany('App\Models\Character\CharacterCategory', 'masterlist_sub_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get all character categories associated with the sub list.
     */
<<<<<<< HEAD
    public function species() {
        return $this->hasMany(Species::class, 'masterlist_sub_id');
    }

    /**********************************************************************************************

=======
    public function species() 
    {
        return $this->hasMany('App\Models\Species\Species', 'masterlist_sub_id');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Gets the sub masterlist's page's URL.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('sublist/'.$this->key);
    }
}
