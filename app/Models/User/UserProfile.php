<?php

namespace App\Models\User;

use App\Models\Model;
use App\Traits\Commentable;

<<<<<<< HEAD
class UserProfile extends Model {
=======
class UserProfile extends Model
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
        'text', 'parsed_text', 'pronouns',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    /**
=======
        'text', 'parsed_text'
    ];

    /**
>>>>>>> Cylunny/extension/polls-and-forms
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
     * Get the user this profile belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class);
=======
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the user this profile belongs to.
     */
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
