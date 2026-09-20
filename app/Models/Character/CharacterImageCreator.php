<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Models\Model;
use App\Models\User\User;

class CharacterImageCreator extends Model {
=======
use Config;
use DB;
use App\Models\Model;
use App\Models\User\User;
use App\Models\Character\CharacterCategory;

class CharacterImageCreator extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'character_image_id', 'type', 'url', 'alias', 'character_type', 'user_id',
=======
        'character_image_id', 'type', 'url', 'alias', 'character_type', 'user_id'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_image_creators';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = false;
<<<<<<< HEAD

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the image associated with this record.
     */
    public function image() {
        return $this->belongsTo(CharacterImage::class, 'character_image_id');
=======
    
    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the image associated with this record.
     */
    public function image() 
    {
        return $this->belongsTo('App\Models\Character\CharacterImage', 'character_image_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user associated with this record.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**********************************************************************************************

=======
    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Displays a link using the creator's URL.
<<<<<<< HEAD
     *
     * @return string
     */
    public function displayLink() {
        if ($this->user_id) {
            $user = User::find($this->user_id);

            return $user->displayName;
        } elseif ($this->url) {
            return prettyProfileLink($this->url);
        } elseif ($this->alias) {
            $user = User::where('alias', trim($this->alias))->first();
            if ($user) {
                return $user->displayName;
            } else {
                return '<a href="https://www.deviantart.com/'.$this->alias.'">'.$this->alias.'@dA</a>';
            }
=======
     * 
     * @return string
     */
    public function displayLink()
    {
        if($this->user_id)
        {
            $user = User::find($this->user_id);
            return $user->displayName;
        }
        else if ($this->url)
        {
            return prettyProfileLink($this->url);
        }
        else if($this->alias)
        {
            $user = User::where('alias', trim($this->alias))->first();
            if($user) return $user->displayName;
            else return '<a href="https://www.deviantart.com/'.$this->alias.'">'.$this->alias.'@dA</a>';
>>>>>>> Cylunny/extension/polls-and-forms
        }
    }
}
