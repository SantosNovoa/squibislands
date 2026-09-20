<?php

namespace App\Models\Gallery;

<<<<<<< HEAD
use App\Models\Model;
use App\Models\User\User;

class GalleryFavorite extends Model {
=======
use Config;
use DB;
use Carbon\Carbon;
use App\Models\Model;

class GalleryFavorite extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'user_id', 'gallery_submission_id',
=======
        'user_id', 'gallery_submission_id'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery_favorites';

    /**
     * Get the character being attached to the submission.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the submission this is attached to.
     */
    public function submission() {
        return $this->belongsTo(GallerySubmission::class, 'gallery_submission_id');
    }
=======
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }
    
    /**
     * Get the submission this is attached to.
     */
    public function submission() 
    {
        return $this->belongsTo('App\Models\Gallery\GallerySubmission', 'gallery_submission_id');
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
