<?php

namespace App\Models\Gallery;

<<<<<<< HEAD
use App\Models\Model;
use App\Models\User\User;

class GalleryCollaborator extends Model {
=======
use Settings;
use Config;
use DB;
use Carbon\Carbon;

use App\Models\Currency\Currency;

use App\Models\Model;

class GalleryCollaborator extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'gallery_submission_id', 'user_id',
        'has_approved', 'data', 'type',
=======
        'gallery_submission_id', 'user_id', 
        'has_approved', 'data', 'type'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery_submission_collaborators';

<<<<<<< HEAD
    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'user',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the submission this is attached to.
     */
    public function submission() {
        return $this->belongsTo(GallerySubmission::class, 'gallery_submission_id');
    }

    /**
     * Get the user being attached to the submission.
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**********************************************************************************************

=======
    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the submission this is attached to.
     */
    public function submission() 
    {
        return $this->belongsTo('App\Models\Gallery\GallerySubmission', 'gallery_submission_id');
    }
    
    /**
     * Get the user being attached to the submission.
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
     * Get the display name of the participant's type.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayTypeAttribute() {
        switch ($this->type) {
=======
    public function getDisplayTypeAttribute()
    {
        switch($this->type) {
>>>>>>> Cylunny/extension/polls-and-forms
            default:
                flash('Invalid type selected.')->error();
                break;
            case 'Collab':
                return 'Collaborator';
                break;
            case 'Trade':
                return 'Trade With';
                break;
            case 'Gift':
                return 'Gift For';
                break;
            case 'Comm':
                return 'Commissioned';
                break;
<<<<<<< HEAD
        }
    }
=======
            case 'Comm (Currency)':
                return 'Commissioned ('.Currency::find(Settings::get('group_currency'))->name.')';
                break;
        }
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
