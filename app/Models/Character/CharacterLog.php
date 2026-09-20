<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Models\Model;
use App\Models\User\User;

class CharacterLog extends Model {
=======
use Config;
use App\Models\Model;

class CharacterLog extends Model
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
        'log', 'log_type', 'data', 'change_log', 'sender_url', 'recipient_url',
=======
        'log', 'log_type', 'data', 'change_log', 'sender_url', 'recipient_url'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_log';
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

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who initiated the logged action.
     */
<<<<<<< HEAD
    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
=======
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
     * Displays the recipient's alias if applicable.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayRecipientAliasAttribute() {
        if ($this->recipient_url) {
            return prettyProfileLink($this->recipient_url);
        } else {
            return '---';
        }
=======
    public function getDisplayRecipientAliasAttribute()
    {
        if($this->recipient_url)
            return prettyProfileLink($this->recipient_url);
        else return '---';
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Retrieves the changed data as an associative array.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getChangedDataAttribute() {
=======
    public function getChangedDataAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return json_decode($this->change_log, true);
    }
}
