<?php

namespace App\Models\Species;

<<<<<<< HEAD
use App\Models\Character\Sublist;
use App\Models\Element\Typing;
use App\Models\Feature\Feature;
use App\Models\Model;

class Species extends Model {
=======
use Config;
use App\Models\Model;

class Species extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'sort', 'has_image', 'description', 'parsed_description', 'masterlist_sub_id', 'is_visible', 'hash',
=======
        'name', 'sort', 'has_image', 'description', 'parsed_description', 'masterlist_sub_id'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'specieses';
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
        'name'        => 'required|unique:specieses|between:3,100',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

=======
        'name' => 'required|unique:specieses|between:3,100',
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
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

    /**********************************************************************************************

=======
        'name' => 'required|between:3,100',
        'description' => 'nullable',
        'image' => 'mimes:png',
    ];

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the subtypes for this species.
     */
<<<<<<< HEAD
    public function subtypes() {
        return $this->hasMany(Subtype::class);
=======
    public function subtypes() 
    {
        return $this->hasMany('App\Models\Species\Subtype');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the sub masterlist for this species.
     */
<<<<<<< HEAD
    public function sublist() {
        return $this->belongsTo(Sublist::class, 'masterlist_sub_id');
    }

    /**
     * Get the features associated with this species.
     */
    public function features() {
        return $this->hasMany(Feature::class);
    }

    /**
     * Get the species typing.
     */
    public function typing() {
        return $this->hasMany(Typing::class, 'typing_id')->where('typing_model', '\App\Models\Species\Species');
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to show only visible species.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed|null                            $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query, $user = null) {
        if ($user && $user->hasPower('edit_data')) {
            return $query;
        }

        return $query->where('is_visible', 1);
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

=======
    public function sublist() 
    {
        return $this->belongsTo('App\Models\Character\Sublist', 'masterlist_sub_id');
    }
    
    /**
     * Get the features associated with this species.
     */
    public function features() 
    {
        return $this->hasMany('App\Models\Feature\Feature');
    }

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
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'" class="display-species">'.$this->name.'</a>';
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
        return 'images/data/species';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSpeciesImageFileNameAttribute() {
        return $this->hash.$this->id.'-image.png';
=======
    public function getSpeciesImageFileNameAttribute()
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
    public function getSpeciesImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

=======
    public function getSpeciesImagePathAttribute()
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
    public function getSpeciesImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->speciesImageFileName);
=======
    public function getSpeciesImageUrlAttribute()
    {
        if (!$this->has_image) return null;
        return asset($this->imageDirectory . '/' . $this->speciesImageFileName);
>>>>>>> Cylunny/extension/polls-and-forms
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
        return url('world/species?name='.$this->name);
    }

    /**
     * Gets the URL for a masterlist search of characters of this species.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSearchUrlAttribute() {
        if ($this->masterlist_sub_id != 0 && $this->sublist->show_main == 0) {
            return url('sublist/'.$this->sublist->key.'?species_id='.$this->id);
        } else {
            return url('masterlist?species_id='.$this->id);
        }
=======
    public function getSearchUrlAttribute()
    {
        if($this->masterlist_sub_id != 0 && $this->sublist->show_main == 0)
        return url('sublist/'.$this->sublist->key.'?species_id='.$this->id);
        else
        return url('masterlist?species_id='.$this->id);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the URL the visual index of this species' traits.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getVisualTraitsUrlAttribute() {
        return url('/world/species/'.$this->id.'/traits');
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/species/edit/'.$this->id);
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
    public function getVisualTraitsUrlAttribute()
    {
        return url('/world/species/'.$this->id.'/traits');
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
