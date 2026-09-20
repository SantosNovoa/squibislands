<?php

namespace App\Models;

<<<<<<< HEAD
use App\Traits\Commentable;

class SitePage extends Model {
=======
use Config;
use App\Models\Model;

use App\Traits\Commentable;

class SitePage extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    use Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'key', 'title', 'text', 'parsed_text', 'is_visible', 'can_comment', 'allow_dislikes',
=======
        'key', 'title', 'text', 'parsed_text', 'is_visible', 'can_comment'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_pages';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;
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
        'key'   => 'required|unique:site_pages|between:3,25|alpha_dash',
        'title' => 'required|between:3,100',
        'text'  => 'nullable',
    ];

=======
        'key' => 'required|unique:site_pages|between:3,25|alpha_dash',
        'title' => 'required|between:3,100',
        'text' => 'nullable',
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
<<<<<<< HEAD
        'key'   => 'required|between:3,25|alpha_dash',
        'title' => 'required|between:3,100',
        'text'  => 'nullable',
=======
        'key' => 'required|between:3,25|alpha_dash',
        'title' => 'required|between:3,100',
        'text' => 'nullable',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * Gets the URL of the public-facing page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('info/'.$this->key);
    }

    /**
     * Displays the news post title, linked to the news post itself.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
        return '<a href="'.$this->url.'">'.$this->title.'</a>';
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/pages/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_pages';
    }
=======
    public function getDisplayNameAttribute()
    {
        return '<a href="'.$this->url.'">'.$this->title.'</a>';
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
