<?php

namespace App\Models\User;

use App\Models\Model;

<<<<<<< HEAD
class UserSettings extends Model {
=======
class UserSettings extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'is_fto', 'submission_count', 'banned_at', 'ban_reason', 'birthday_setting', 'strike_count', 'selected_character_id', 'theme_id',
        'deactivate_reason', 'deactivated_at',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_settings';

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'banned_at'      => 'datetime',
        'deactivated_at' => 'datetime',
=======
        'is_fto', 'submission_count', 'banned_at', 'ban_reason', 'birthday_setting'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The primary key of the model.
     *
     * @var string
     */
    public $primaryKey = 'user_id';

<<<<<<< HEAD
    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user this set of settings belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the character the user has selected if appropriate.
     */
    public function selectedCharacter()
    {
        return $this->belongsTo('App\Models\Character\Character', 'selected_character_id')->visible();
=======
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_settings';

    /**
     * Dates on the model to convert to Carbon instances.
     *
     * @var array
     */
    protected $dates = ['banned_at'];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the user this set of settings belongs to.
     */
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
