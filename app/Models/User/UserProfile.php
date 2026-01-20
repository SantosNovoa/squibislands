<?php

namespace App\Models\User;

use App\Models\Model;
use App\Traits\Commentable;

class UserProfile extends Model {
    use Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'text', 'parsed_text',
=======
        'text', 'parsed_text', 'pronouns'
>>>>>>> AnimatedCritter/extension/user-pronouns
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_profiles';

    /**
     * The primary key of the model.
     *
     * @var string
     */
    public $primaryKey = 'user_id';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user this profile belongs to.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}
