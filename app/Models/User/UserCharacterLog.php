<?php

namespace App\Models\User;

<<<<<<< HEAD
use App\Models\Character\Character;
use App\Models\Model;

class UserCharacterLog extends Model {
=======
use Config;
use App\Models\Model;

class UserCharacterLog extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'character_id', 'sender_id', 'sender_alias', 'recipient_id', 'recipient_alias',
<<<<<<< HEAD
        'log', 'log_type', 'data', 'sender_url', 'recipient_url',
=======
        'log', 'log_type', 'data', 'sender_url', 'recipient_url'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_character_log';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**********************************************************************************************
<<<<<<< HEAD

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who initiated the logged action.
     */
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
=======
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the user who initiated the logged action.
     */
    public function sender() 
    {
        return $this->belongsTo('App\Models\User\User', 'sender_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user who received the logged action.
     */
<<<<<<< HEAD
    public function recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
=======
    public function recipient() 
    {
        return $this->belongsTo('App\Models\User\User', 'recipient_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the character that is the target of the action.
     */
<<<<<<< HEAD
    public function character() {
        return $this->belongsTo(Character::class);
    }

    /**********************************************************************************************

=======
    public function character() 
    {
        return $this->belongsTo('App\Models\Character\Character');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the sender's alias, linked to their profile.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplaySenderAliasAttribute() {
        return prettyProfileLink($this->sender_url);
    }

=======
    public function getDisplaySenderAliasAttribute()
    {
        return prettyProfileLink($this->sender_url);
    }
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Displays the recipient's alias, linked to their profile.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayRecipientAliasAttribute() {
        return prettyProfileLink($this->recipient_url);
    }
=======
    public function getDisplayRecipientAliasAttribute()
    {
        return prettyProfileLink($this->recipient_url);
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
