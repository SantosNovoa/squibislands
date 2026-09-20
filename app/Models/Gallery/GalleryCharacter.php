<?php

namespace App\Models\Gallery;

<<<<<<< HEAD
use App\Models\Character\Character;
use App\Models\Model;

class GalleryCharacter extends Model {
=======
use Config;
use DB;
use Carbon\Carbon;
use App\Models\Model;

class GalleryCharacter extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'gallery_submission_id', 'character_id',
=======
        'gallery_submission_id', 'character_id'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery_submission_characters';
<<<<<<< HEAD

    /**
     * Get the submission this is attached to.
     */
    public function submission() {
        return $this->belongsTo(GallerySubmission::class, 'gallery_submission_id');
    }

    /**
     * Get the character being attached to the submission.
     */
    public function character() {
        return $this->belongsTo(Character::class, 'character_id');
    }
=======
    
    /**
     * Get the submission this is attached to.
     */
    public function submission() 
    {
        return $this->belongsTo('App\Models\Gallery\GallerySubmission', 'gallery_submission_id');
    }
    
    /**
     * Get the character being attached to the submission.
     */
    public function character() 
    {
        return $this->belongsTo('App\Models\Character\Character', 'character_id');
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
