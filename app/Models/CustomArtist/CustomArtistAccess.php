<?php

namespace App\Models\CustomArtist;

use App\Models\Model;
use App\Models\User\User;

class CustomArtistAccess extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'granted_by',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'custom_artist_access';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * The user who was granted access.
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The staff member who granted access.
     */
    public function grantedBy() {
        return $this->belongsTo(User::class, 'granted_by');
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Whether a user may post an Official Customs entry:
     * their rank has the power, or they were granted access individually.
     *
     * @param User|null $user
     *
     * @return bool
     */
    public static function userCanEdit($user) {
        if (!$user) {
            return false;
        }
        if ($user->hasPower('manage_custom_profile')) {
            return true;
        }

        return static::where('user_id', $user->id)->exists();
    }
}
