<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Models\Model;

class CharacterCategory extends Model {
=======
use Config;
use App\Models\Model;

class CharacterCategory extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'code', 'name', 'sort', 'has_image', 'description', 'parsed_description', 'masterlist_sub_id', 'is_visible', 'hash',
=======
        'code', 'name', 'sort', 'has_image', 'description', 'parsed_description', 'masterlist_sub_id'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_categories';
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
        'name'        => 'required|unique:character_categories|between:3,100',
        'code'        => 'required|unique:character_categories|between:1,25',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

=======
        'name' => 'required|unique:character_categories|between:3,100',
        'code' => 'required|unique:character_categories|between:1,25',
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
        'code'        => 'required|between:1,25',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the sub masterlist for this species.
     */
    public function sublist() {
        return $this->belongsTo(Sublist::class, 'masterlist_sub_id');
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to show only visible categories.
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
        'name' => 'required|between:3,100',
        'code' => 'required|between:1,25',
        'description' => 'nullable',
        'image' => 'mimes:png',
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the sub masterlist for this species.
     */
    public function sublist() 
    {
        return $this->belongsTo('App\Models\Character\Sublist', 'masterlist_sub_id');
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
        return '<a href="'.$this->url.'" class="display-category">'.$this->name.' ('.$this->code.')</a>';
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
        return 'images/data/character-categories';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCategoryImageFileNameAttribute() {
        return $this->hash.$this->id.'-image.png';
=======
    public function getCategoryImageFileNameAttribute()
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
    public function getCategoryImagePathAttribute() {
        return public_path($this->imageDirectory);
    }

=======
    public function getCategoryImagePathAttribute()
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
    public function getCategoryImageUrlAttribute() {
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->categoryImageFileName);
=======
    public function getCategoryImageUrlAttribute()
    {
        if (!$this->has_image) return null;
        return asset($this->imageDirectory . '/' . $this->categoryImageFileName);
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
        return url('world/character-categories?name='.$this->name);
    }

    /**
     * Gets the URL for a masterlist search of characters in this category.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSearchUrlAttribute() {
        if ($this->masterlist_sub_id != 0 && $this->sublist->show_main == 0) {
            return url('sublist/'.$this->sublist->key.'?character_category_id='.$this->id);
        } else {
            return url('masterlist?character_category_id='.$this->id);
        }
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/character-categories/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
=======
    public function getSearchUrlAttribute()
    {
        if($this->masterlist_sub_id != 0 && $this->sublist->show_main == 0)
        return url('sublist/'.$this->sublist->key.'?character_category_id='.$this->id);
        else
        return url('masterlist?character_category_id='.$this->id);
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
