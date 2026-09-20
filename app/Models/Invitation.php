<?php

namespace App\Models;

<<<<<<< HEAD
use App\Models\User\User;

class Invitation extends Model {
=======
use App\Models\Model;

class Invitation extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'code', 'user_id', 'recipient_id',
=======
        'code', 'user_id', 'recipient_id'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invitations';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

<<<<<<< HEAD
    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who generated the invitation code.
     */
    public function user() {
        return $this->belongsTo(User::class);
=======

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the user who generated the invitation code.
     */
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user who created their account using the invitation code.
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
}
