<?php

namespace App\Models\User;

use App\Models\Model;

<<<<<<< HEAD
class UserUpdateLog extends Model {
=======
class UserUpdateLog extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'staff_id', 'user_id', 'data', 'type',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_update_log';
    /**
=======
        'staff_id', 'user_id', 'data', 'type'
    ];

    /**
>>>>>>> Cylunny/extension/polls-and-forms
     * The primary key of the model.
     *
     * @var string
     */
    public $primaryKey = 'user_id';

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
     * Get the staff who updated the user.
     */
    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Get the user that was updated.
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**********************************************************************************************

=======
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_update_log';

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the staff who updated the user.
     */
    public function staff() 
    {
        return $this->belongsTo('App\Models\User\User', 'staff_id');
    }
    
    /**
     * Get the user that was updated.
     */
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the data attribute as an associative array.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getDataAttribute() {
=======
    public function getDataAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return json_decode($this->attributes['data'], true);
    }
}
