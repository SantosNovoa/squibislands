<?php

namespace App\Models\Species;

<<<<<<< HEAD
use App\Models\Feature\Feature;
use App\Models\Model;

class Subtype extends Model {
=======
use Config;
use App\Models\Model;

class Subtype extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'species_id', 'name', 'sort', 'has_image', 'description', 'parsed_description', 'is_visible', 'hash',
=======
        'species_id', 'name', 'sort', 'has_image', 'description', 'parsed_description'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subtypes';
<<<<<<< HEAD

    /**
     * Accessors to append to the model.
     *
     * @var array
     */
    protected $appends = [
        'name_with_species',
    ];

=======
    
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
<<<<<<< HEAD
        'species_id'  => 'required',
        'name'        => 'required|between:3,100',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

=======
        'species_id' => 'required',
        'name' => 'required|between:3,100',
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
        'species_id'  => 'required',
        'name'        => 'required|between:3,100',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the species the subtype belongs to.
     */
    public function species() {
        return $this->belongsTo(Species::class, 'species_id');
    }

    /**
     * Get the features associated with this subtype.
     */
    public function features() {
        return $this->hasMany(Feature::class);
    }

    /**********************************************************************************************

            SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to show only visible subtypes.
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

=======
        'species_id' => 'required',
        'name' => 'required|between:3,100',
        'description' => 'nullable',
        'image' => 'mimes:png',
    ];
    
    /**
     * Accessors to append to the model.
     *
     * @var array
     */
    protected $appends = [
        'name_with_species'
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the species the subtype belongs to.
     */
    public function species() 
    {
        return $this->belongsTo('App\Models\Species\Species', 'species_id');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the subtype's name and species.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getNameWithSpeciesAttribute() {
        return $this->name.' ['.$this->species->name.' Subtype]';
    }

=======
    public function getNameWithSpeciesAttribute()
    {
        return $this->name . ' [' . $this->species->name . ' Subtype]';
    }
    
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
        return '<a href="'.$this->url.'" class="display-subtype">'.$this->name.'</a>';
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
        return 'images/data/subtypes';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSubtypeImageFileNameAttribute() {
        return $this->hash.$this->id.'-image.png';
=======
    public function getSubtypeImageFileNameAttribute()
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
    public function getSubtypeImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

=======
    public function getSubtypeImagePathAttribute()
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
    public function getSubtypeImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->subtypeImageFileName);
=======
    public function getSubtypeImageUrlAttribute()
    {
        if (!$this->has_image) return null;
        return asset($this->imageDirectory . '/' . $this->subtypeImageFileName);
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
        return url('world/subtypes?name='.$this->name);
    }

    /**
     * Gets the URL for a masterlist search of characters of this species subtype.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSearchUrlAttribute() {
        return url('masterlist?subtype_id='.$this->id);
    }

    /**
     * Gets the URL the visual index of this subtype's traits.
     *
     * @return string
     */
    public function getVisualTraitsUrlAttribute() {
        return url('/world/subtypes/'.$this->id.'/traits');
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/subtypes/edit/'.$this->id);
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
    public function getSearchUrlAttribute()
    {
        return url('masterlist?subtype_id='.$this->id);
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
