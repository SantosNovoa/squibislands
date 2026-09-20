<?php

namespace App\Models\Prompt;

<<<<<<< HEAD
use App\Models\Model;

class PromptCategory extends Model {
=======
use Config;
use App\Models\Model;

class PromptCategory extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'name', 'sort', 'has_image', 'description', 'parsed_description', 'hash',
=======
        'name', 'sort', 'has_image', 'description', 'parsed_description'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prompt_categories';
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
        'name'        => 'required|unique:prompt_categories|between:3,100',
        'description' => 'nullable',
        'image'       => 'mimes:png',
    ];

=======
        'name' => 'required|unique:prompt_categories|between:3,100',
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

        ACCESSORS

    **********************************************************************************************/

=======
        'name' => 'required|between:3,100',
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
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'" class="display-category">'.$this->name.'</a>';
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
        return 'images/data/prompt-categories';
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
        return url('prompts/prompt-categories?name='.$this->name);
    }

    /**
     * Gets the URL for an encyclopedia search for prompts in this category.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSearchUrlAttribute() {
        return url('prompts/prompts?prompt_category_id='.$this->id);
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/prompt-categories/edit/'.$this->id);
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
        return url('prompts/prompts?prompt_category_id='.$this->id);
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
