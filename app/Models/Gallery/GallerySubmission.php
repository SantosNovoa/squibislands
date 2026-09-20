<?php

namespace App\Models\Gallery;

<<<<<<< HEAD
use App\Facades\Settings;
use App\Models\Comment\Comment;
use App\Models\Currency\Currency;
use App\Models\Model;
use App\Models\Prompt\Prompt;
use App\Models\Submission\Submission;
use App\Models\User\User;
use App\Models\WorldExpansion\Location;
use App\Traits\Commentable;

class GallerySubmission extends Model {
=======
use Config;
use DB;
use Settings;
use Carbon\Carbon;
use App\Models\Currency\Currency;
use App\Models\Prompt\Prompt;
use App\Models\Submission\Submission;
use App\Models\Model;

use App\Traits\Commentable;

class GallerySubmission extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    use Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'gallery_id', 'hash', 'extension',
        'text', 'parsed_text', 'content_warning',
        'title', 'description', 'parsed_description',
        'prompt_id', 'data', 'is_visible', 'status',
        'vote_data', 'staff_id', 'is_valued',
<<<<<<< HEAD
        'staff_comments', 'parsed_staff_comments',
        'location_id',
=======
        'staff_comments', 'parsed_staff_comments'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gallery_submissions';

    /**
<<<<<<< HEAD
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'user', 'collaborators', 'prompt:id,name,prefix', 'favorites', 'comments:id,commentable_type,commentable_id,type',
    ];

    /**
     * 	The relationship counts that should be eager loaded on every query.
     *
     * @var array
     */
    protected $withCount = [
        'favorites',
    ];

    /**
=======
>>>>>>> Cylunny/extension/polls-and-forms
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**
     * Validation rules for character creation.
     *
     * @var array
     */
    public static $createRules = [
<<<<<<< HEAD
        'title'       => 'required|between:3,200',
        'image'       => 'required_without:text|mimes:png,jpeg,jpg,gif,webp|max:3000',
        'text'        => 'required_without:image',
=======
        'title' => 'required|between:3,200',
        'image' => 'required_without:text|mimes:png,jpeg,jpg,gif|max:3000',
        'text' => 'required_without:image',
>>>>>>> Cylunny/extension/polls-and-forms
        'description' => 'nullable',
    ];

    /**
     * Validation rules for character updating.
     *
     * @var array
     */
    public static $updateRules = [
<<<<<<< HEAD
        'title'       => 'required|between:3,200',
        'description' => 'nullable',
        'image'       => 'mimes:png,jpeg,jpg,gif,webp|max:3000',
=======
        'title' => 'required|between:3,200',
        'description' => 'nullable',
        'image' => 'mimes:png,jpeg,jpg,gif|max:3000'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who made the submission.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class);
=======
    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the staff member who last edited the submission's comments.
     */
<<<<<<< HEAD
    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
=======
    public function staff()
    {
        return $this->belongsTo('App\Models\User\User', 'staff_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the collaborating users on the submission.
     */
<<<<<<< HEAD
    public function collaborators() {
        return $this->hasMany(GalleryCollaborator::class)->where('type', 'Collab');
=======
    public function collaborators()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCollaborator', 'gallery_submission_id')->where('type', 'Collab');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user(s) who are related to the submission in some way.
     */
<<<<<<< HEAD
    public function participants() {
        return $this->hasMany(GalleryCollaborator::class)->where('type', '!=', 'Collab');
=======
    public function participants()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCollaborator', 'gallery_submission_id')->where('type', '!=', 'Collab');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the characters associated with the submission.
     */
<<<<<<< HEAD
    public function characters() {
        return $this->hasMany(GalleryCharacter::class);
=======
    public function characters()
    {
        return $this->hasMany('App\Models\Gallery\GalleryCharacter', 'gallery_submission_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get any favorites on the submission.
     */
<<<<<<< HEAD
    public function favorites() {
        return $this->hasMany(GalleryFavorite::class);
=======
    public function favorites()
    {
        return $this->hasMany('App\Models\Gallery\GalleryFavorite', 'gallery_submission_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the gallery this submission is in.
     */
<<<<<<< HEAD
    public function gallery() {
        return $this->belongsTo(Gallery::class);
=======
    public function gallery()
    {
        return $this->belongsTo('App\Models\Gallery\Gallery', 'gallery_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the prompt this submission is for if relevant.
     */
<<<<<<< HEAD
    public function prompt() {
        return $this->belongsTo(Prompt::class);
    }

    /**
     * Get comments made on this submission.
     */
    public function comments() {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get the location this submission is for if relevant.
     */
    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
=======
    public function prompt()
    {
        return $this->belongsTo('App\Models\Prompt\Prompt', 'prompt_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include pending submissions.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('status', 'Pending');
    }

    /**
     * Scope a query to only include submissions where all collaborators have approved.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCollaboratorApproved($query) {
        return $query->whereDoesntHave('collaborators', function ($query) {
            $query->where('has_approved', 0);
        })->orWhereDoesntHave('collaborators');
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCollaboratorApproved($query)
    {
        return $query->whereNotIn('id', GalleryCollaborator::where('has_approved', 0)->pluck('gallery_submission_id')->toArray());
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to only include accepted submissions.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAccepted($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAccepted($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('status', 'Accepted');
    }

    /**
     * Scope a query to only include rejected submissions.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRejected($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('status', 'Rejected');
    }

    /**
     * Scope a query to only include submissions that require currency awards.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRequiresAward($query) {
        if (!Settings::get('gallery_submissions_reward_currency')) {
            return $query->whereNull('id');
        }

        return $query->where('status', 'Accepted')->whereIn('gallery_id', Gallery::has('criteria')->pluck('id')->toArray());
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRequiresAward($query)
    {
        if(!Settings::get('gallery_submissions_reward_currency')) return $query->whereNull('id');
        return $query->where('status', 'Accepted')->whereIn('gallery_id', Gallery::where('currency_enabled', 1)->pluck('id')->toArray());
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to only include submissions the user has either submitted or collaborated on.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed                                 $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserSubmissions($query, $user) {
        return $query->where('user_id', $user->id)->orWhereHas('collaborators', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where('type', 'Collab');
        });
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param                                         $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeUserSubmissions($query, $user)
    {
        return $query->where('user_id', $user->id)->orWhereIn('id', GalleryCollaborator::where('user_id', $user->id)->where('type', 'Collab')->pluck('gallery_submission_id')->toArray());
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to only include submissions visible within the gallery.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed|null                            $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query, $user = null) {
        if ($user && $user->hasPower('manage_submissions')) {
            return $query->where('status', 'Accepted');
        }

        return $query->where('status', 'Accepted')->where('is_visible', 1);
    }

    /**
     * Scope a query to sort submissions oldest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query) {
        return $query->orderBy('id');
    }

    /**
     * Scope a query to sort submissions by newest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
        return $query->orderBy('id', 'DESC');
    }

=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query, $user = null)
    {
        if($user && $user->hasPower('manage_submissions')) return $query->where('status', 'Accepted');
        return $query->where('status', 'Accepted')->where('is_visible', 1);
    }

>>>>>>> Cylunny/extension/polls-and-forms
    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Gets the file directory containing the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageDirectoryAttribute() {
=======
    public function getImageDirectoryAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return 'images/gallery/'.floor($this->id / 1000);
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageFileNameAttribute() {
        return $this->id.'_'.$this->hash.'.'.$this->extension;
=======
    public function getImageFileNameAttribute()
    {
        return $this->id . '_'.$this->hash.'.'.$this->extension;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the path to the file directory containing the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImagePathAttribute() {
=======
    public function getImagePathAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return public_path($this->imageDirectory);
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageUrlAttribute() {
        if (!isset($this->hash)) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->imageFileName);
=======
    public function getImageUrlAttribute()
    {
        if(!isset($this->hash)) return null;
        return asset($this->imageDirectory . '/' . $this->imageFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the file name of the model's thumbnail image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getThumbnailFileNameAttribute() {
        return $this->id.'_'.$this->hash.'_th.'.$this->extension;
=======
    public function getThumbnailFileNameAttribute()
    {
        return $this->id . '_'.$this->hash.'_th.'.$this->extension;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the path to the file directory containing the model's thumbnail image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getThumbnailPathAttribute() {
=======
    public function getThumbnailPathAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->imagePath;
    }

    /**
     * Gets the URL of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getThumbnailUrlAttribute() {
        if (!isset($this->hash)) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->thumbnailFileName);
=======
    public function getThumbnailUrlAttribute()
    {
        if(!isset($this->hash)) return null;
        return asset($this->imageDirectory . '/' . $this->thumbnailFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

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

    /**
<<<<<<< HEAD
=======
     * Gets the voting data of the gallery submission.
     *
     * @return string
     */
    public function getVoteDataAttribute()
    {
        return collect(json_decode($this->attributes['vote_data'], true));
    }

    /**
>>>>>>> Cylunny/extension/polls-and-forms
     * Get the title of the submission, with prefix.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayTitleAttribute() {
=======
    public function getDisplayTitleAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->prefix.$this->attributes['title'];
    }

    /**
     * Get the display name of the submission.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'">'.$this->displayTitle.'</a>';
    }

    /**
     * Get the viewing URL of the submission.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('gallery/view/'.$this->id);
    }

    /**
<<<<<<< HEAD
     * Get the prefix for a submission.
     *
     * @return string
     */
    public function getPrefixAttribute() {
        $prefixList = [];
        if ($this->promptSubmissions->count()) {
            foreach ($this->prompts as $prompt) {
                isset($prompt->prefix) ? ($prefixList[] = $prompt->prefix) : null;
            }
        } elseif (isset($this->prompt_id)) {
            isset($this->prompt->prefix) ? $prefixList[] = $this->prompt->prefix : null;
        }
        foreach ($this->participants as $participant) {
            switch ($participant->type) {
=======
     * Checks if all of a submission's collaborators have approved or no.
     *
     * @return string
     */
    public function getPrefixAttribute()
    {
        $currencyName = Currency::find(Settings::get('group_currency'))->abbreviation ? Currency::find(Settings::get('group_currency'))->abbreviation : Currency::find(Settings::get('group_currency'))->name;

        $prefixList = [];
        if($this->promptSubmissions->count()) foreach($this->prompts as $prompt) isset($prompt->prefix) ? ($prefixList[] = $prompt->prefix) : null;
        elseif(isset($this->prompt_id)) isset($this->prompt->prefix) ? $prefixList[] = $this->prompt->prefix : null;
        foreach($this->participants as $participant) {
            switch($participant->type) {
>>>>>>> Cylunny/extension/polls-and-forms
                case 'Collab':
                    $prefixList[] = 'Collab';
                    break;
                case 'Trade':
                    $prefixList[] = 'Trade';
                    break;
                case 'Gift':
                    $prefixList[] = 'Gift';
                    break;
                case 'Comm':
                    $prefixList[] = 'Comm';
                    break;
                case 'Comm (Currency)':
<<<<<<< HEAD
                    $currencyName = Currency::find(Settings::get('group_currency'))->abbreviation ? Currency::find(Settings::get('group_currency'))->abbreviation : Currency::find(Settings::get('group_currency'))->name;

=======
>>>>>>> Cylunny/extension/polls-and-forms
                    $prefixList[] = 'Comm ('.$currencyName.')';
                    break;
            }
        }
<<<<<<< HEAD
        if ($prefixList != null) {
            return '['.implode(' : ', array_unique($prefixList)).'] ';
        }

=======
        if($prefixList != null) return '['.implode(' : ', array_unique($prefixList)).'] ';
>>>>>>> Cylunny/extension/polls-and-forms
        return null;
    }

    /**
     * Get the internal processing URL of the submission.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getQueueUrlAttribute() {
=======
    public function getQueueUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('gallery/queue/'.$this->id);
    }

    /**
     * Get whether or not the submission is generally viewable.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function getIsVisibleAttribute() {
        if ($this->attributes['is_visible'] && $this->status == 'Accepted') {
            return true;
        }
=======
    public function getIsVisibleAttribute()
    {
        if($this->attributes['is_visible'] && $this->status == 'Accepted') return true;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the users responsible for the submission (submitting user or collaborators).
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCreditsAttribute() {
        if ($this->collaborators->count()) {
            foreach ($this->collaborators as $collaborator) {
                $collaboratorList[] = $collaborator->user->displayName;
            }

            return implode(', ', $collaboratorList);
        } else {
            return $this->user->displayName;
        }
=======
    public function getCreditsAttribute()
    {
        if($this->collaborators->count()) {
            foreach($this->collaborators as $count=>$collaborator) {
                $collaboratorList[] = $collaborator->user->displayName;
            }
            return implode(', ', $collaboratorList);
        }
        else return $this->user->displayName;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the users responsible for the submission (submitting user or collaborators).
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCreditsPlainAttribute() {
        if ($this->collaborators->count()) {
            foreach ($this->collaborators as $collaborator) {
                $collaboratorList[] = $collaborator->user->name;
            }

            return implode(', ', $collaboratorList);
        } else {
            return $this->user->name;
        }
=======
    public function getCreditsPlainAttribute()
    {
        if($this->collaborators->count()) {
            foreach($this->collaborators as $count=>$collaborator) {
                $collaboratorList[] = $collaborator->user->name;
            }
            return implode(', ', $collaboratorList);
        }
        else return $this->user->name;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Checks if all of a submission's collaborators have approved or no.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCollaboratorApprovalAttribute() {
        if ($this->collaborators->where('has_approved', 0)->count()) {
            return false;
        }

=======
    public function getCollaboratorApprovedAttribute()
    {
        if($this->collaborators->where('has_approved', 0)->count()) return false;
>>>>>>> Cylunny/extension/polls-and-forms
        return true;
    }

    /**
     * Gets prompt submissions associated with this gallery submission.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getPromptSubmissionsAttribute() {
        // Only returns submissions which are viewable to everyone,
        // but given that this is for the sake of public display, that's fine
        return Submission::viewable()->whereNotNull('prompt_id')->where('url', 'like', '%'.request()->getHost().'/gallery/view/'.$this->id)->get();
=======
    public function getPromptSubmissionsAttribute()
    {
        // Only returns submissions which are viewable to everyone,
        // but given that this is for the sake of public display, that's fine
        return Submission::viewable()->whereNotNull('prompt_id')->where('url', $this->url)->get();
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets prompts associated with this gallery submission.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getPromptsAttribute() {
=======
    public function getPromptsAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        // Only returns submissions which are viewable to everyone,
        // but given that this is for the sake of public display, that's fine
        return Prompt::whereIn('id', $this->promptSubmissions->pluck('prompt_id'))->get();
    }

    /**
<<<<<<< HEAD
     * Gets prompt submissions associated with this gallery submission.
     *
     * @return array
     */
    public function getLocationSubmissionsAttribute() {
        // Only returns submissions which are viewable to everyone,
        // but given that this is for the sake of public display, that's fine
        return Submission::viewable()->whereNotNull('location_id')->where('url', $this->url)->get();
    }

    /**
     * Gets prompts associated with this gallery submission.
     *
     * @return array
     */
    public function getLocationsAttribute() {
        // Only returns submissions which are viewable to everyone,
        // but given that this is for the sake of public display, that's fine
        return Prompt::whereIn('id', $this->promptSubmissions->pluck('location_id'))->get();
    }

    /**
=======
>>>>>>> Cylunny/extension/polls-and-forms
     * Gets the excerpt of text for a literature submission.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getExcerptAttribute() {
        if (!isset($this->parsed_text)) {
            return null;
        } else {
            return strip_tags(substr($this->parsed_text, 0, 500)).(strlen($this->parsed_text) > 500 ? '...' : '');
        }
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

     **********************************************************************************************/

    /**
     * Gets the voting data of the gallery submission and performs preliminary processing.
     *
     * @param bool $withUsers
     *
     * @return array
     */
    public function getVoteData($withUsers = 0) {
        $voteData['raw'] = json_decode($this->attributes['vote_data'], true);

        // Only query users if necessary, and condense to one query per submission
        if ($withUsers) {
            $users = User::whereIn('id', array_keys($voteData['raw']))->select('id', 'name', 'rank_id')->get();
        } else {
            $users = null;
        }

        $voteData['raw'] = collect($voteData['raw'])->mapWithKeys(function ($vote, $id) use ($users) {
            return [$id => [
                'vote' => $vote,
                'user' => $users ? $users->where('id', $id)->first() : $id,
            ]];
        });

        // Tally approve/reject sums for ease
        $voteData['approve'] = $voteData['reject'] = 0;
        foreach ($voteData['raw'] as $vote) {
            switch ($vote['vote']) {
                case 1:
                    $voteData['reject'] += 1;
                    break;
                case 2:
                    $voteData['approve'] += 1;
                    break;
            }
        }

        return $voteData;
    }
=======
    public function getExcerptAttribute()
    {
        if(!isset($this->parsed_text)) return null;
        else return strip_tags(substr($this->parsed_text, 0, 500)).(strlen($this->parsed_text) > 500 ? '...' : '');
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
