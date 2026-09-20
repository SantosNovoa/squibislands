<?php

namespace App\Models\Character;

use App\Models\Model;
<<<<<<< HEAD
use App\Models\User\User;

class CharacterBookmark extends Model {
=======

class CharacterBookmark extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'user_id', 'character_id', 'notify_on_trade_status', 'notify_on_gift_art_status', 'notify_on_gift_writing_status', 'notify_on_transfer', 'notify_on_image', 'comment',
    ];

=======
        'user_id', 'character_id', 'notify_on_trade_status', 'notify_on_gift_art_status', 'notify_on_gift_writing_status', 'notify_on_transfer', 'notify_on_image', 'comment'
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_bookmarks';
<<<<<<< HEAD
=======
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'character_id' => 'required',
<<<<<<< HEAD
        'comment'      => 'string|nullable|max:500',
    ];

=======
        'comment' => 'string|nullable|max:500'
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
<<<<<<< HEAD
        'comment' => 'string|nullable|max:500',
    ];

    /**********************************************************************************************

=======
        'comment' => 'string|nullable|max:500'
    ];

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include visible characters.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query) {
        return $query->whereHas('character', function ($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->whereHas('character', function($query) {
>>>>>>> Cylunny/extension/polls-and-forms
            $query->where('is_visible', 1);
        });
    }

    /**********************************************************************************************
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the character the record belongs to.
     */
<<<<<<< HEAD
    public function character() {
        return $this->belongsTo(Character::class);
    }

    /**
     * Get the user the record belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class);
=======
    public function character() 
    {
        return $this->belongsTo('App\Models\Character\Character');
    }
    
    /**
     * Get the user the record belongs to.
     */
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
