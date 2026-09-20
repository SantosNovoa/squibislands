<?php

namespace App\Models\Submission;

<<<<<<< HEAD
use App\Models\Gallery\GallerySubmission;
use App\Models\Model;
use App\Models\Prompt\Prompt;
use App\Models\User\User;
use Carbon\Carbon;

class Submission extends Model {
=======
use Config;
use DB;
use Carbon\Carbon;
use App\Models\Model;

class Submission extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prompt_id', 'user_id', 'staff_id', 'url',
        'comments', 'staff_comments', 'parsed_staff_comments',
<<<<<<< HEAD
        'status', 'data',
=======
        'status', 'data'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'submissions';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;

    /**
     * Validation rules for submission creation.
     *
     * @var array
     */
    public static $createRules = [
        'url' => 'nullable|url',
    ];

    /**
     * Validation rules for submission updating.
     *
     * @var array
     */
    public static $updateRules = [
        'url' => 'nullable|url',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the prompt this submission is for.
     */
<<<<<<< HEAD
    public function prompt() {
        return $this->belongsTo(Prompt::class, 'prompt_id');
=======
    public function prompt()
    {
        return $this->belongsTo('App\Models\Prompt\Prompt', 'prompt_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the user who made the submission.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
=======
    public function user()
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the staff who processed the submission.
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
     * Get the characters attached to the submission.
     */
<<<<<<< HEAD
    public function characters() {
        return $this->hasMany(SubmissionCharacter::class, 'submission_id');
=======
    public function characters()
    {
        return $this->hasMany('App\Models\Submission\SubmissionCharacter', 'submission_id');
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
    public function scopeActive($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('status', 'Pending');
    }

    /**
<<<<<<< HEAD
     * Scope a query to only include drafted submissions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDrafts($query) {
        return $query->where('status', 'Drafts');
    }

    /**
     * Scope a query to only include viewable submissions.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed|null                            $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeViewable($query, $user = null) {
        $forbiddenSubmissions = $this
            ->whereHas('prompt', function ($q) {
                $q->where('hide_submissions', 1)->whereNotNull('end_at')->where('end_at', '>', Carbon::now());
            })
            ->orWhereHas('prompt', function ($q) {
                $q->where('hide_submissions', 2);
            })
            ->orWhere('status', '!=', 'Approved')->pluck('id')->toArray();

        if ($user && $user->hasPower('manage_submissions')) {
            return $query;
        } else {
            return $query->where(function ($query) use ($user, $forbiddenSubmissions) {
                if ($user) {
                    $query->whereNotIn('id', $forbiddenSubmissions)->orWhere('user_id', $user->id);
                } else {
                    $query->whereNotIn('id', $forbiddenSubmissions);
                }
            });
        }
=======
     * Scope a query to only include viewable submissions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeViewable($query, $user = null)
    {
        $forbiddenSubmissions = $this
        ->whereHas('prompt', function($q) {
            $q->where('hide_submissions', 1)->whereNotNull('end_at')->where('end_at', '>', Carbon::now());
        })
        ->orWhereHas('prompt', function($q) {
            $q->where('hide_submissions', 2);
        })
        ->orWhere('status', '!=', 'Approved')->pluck('id')->toArray();

        if($user && $user->hasPower('manage_submissions')) return $query;
        else return $query->where(function($query) use ($user, $forbiddenSubmissions) {
            if($user) $query->whereNotIn('id', $forbiddenSubmissions)->orWhere('user_id', $user->id);
            else $query->whereNotIn('id', $forbiddenSubmissions);
        });
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to sort submissions oldest first.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderBy('id');
    }

    /**
     * Scope a query to sort submissions by newest first.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
        return $query->orderBy('id', 'DESC');
    }

    /**
     * Scope a query to only include user's submissions.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSubmitted($query, $prompt, $user)
    {
        return $query->where('prompt_id', $prompt)->where('status', '!=', 'Rejected')->where('user_id', $user);
    }


=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query)
    {
        return $query->orderBy('id', 'DESC');
    }

>>>>>>> Cylunny/extension/polls-and-forms
    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the data attribute as an associative array.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getDataAttribute() {
        if (!$this->id) {
            return null;
        }

=======
    public function getDataAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return json_decode($this->attributes['data'], true);
    }

    /**
     * Gets the inventory of the user for selection.
     *
<<<<<<< HEAD
     * @param mixed $user
     *
     * @return array
     */
    public function getInventory($user) {
        return $this->data && isset($this->data['user']['user_items']) ? $this->data['user']['user_items'] : [];
=======
     * @return array
     */
    public function getInventory($user)
    {
        return $this->data && isset($this->data['user']['user_items']) ? $this->data['user']['user_items'] : [];
        return $inventory;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the currencies of the given user for selection.
     *
<<<<<<< HEAD
     * @param User $user
     *
     * @return array
     */
    public function getCurrencies($user) {
=======
     * @param  \App\Models\User\User $user
     * @return array
     */
    public function getCurrencies($user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $this->data && isset($this->data['user']) && isset($this->data['user']['currencies']) ? $this->data['user']['currencies'] : [];
    }

    /**
     * Get the viewing URL of the submission/claim.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getViewUrlAttribute() {
        return url(($this->prompt_id ? 'submissions' : 'claims').'/view/'.$this->id);
=======
    public function getViewUrlAttribute()
    {
        return url(($this->prompt_id ? 'submissions' : 'claims') . '/view/'.$this->id);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the admin URL (for processing purposes) of the submission/claim.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getAdminUrlAttribute() {
        return url('admin/'.($this->prompt_id ? 'submissions' : 'claims').'/edit/'.$this->id);
=======
    public function getAdminUrlAttribute()
    {
        return url('admin/' . ($this->prompt_id ? 'submissions' : 'claims') . '/edit/'.$this->id);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the rewards for the submission/claim.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getRewardsAttribute() {
        if (isset($this->data['rewards'])) {
            $assets = parseAssetData($this->data['rewards']);
        } else {
            $assets = parseAssetData($this->data);
        }
        $rewards = [];
        foreach ($assets as $type => $a) {
            $class = getAssetModelString($type, false);
            if ($class == 'Exp' || $class == 'Points') {
                if (isset($a['quantity'])) {
                    $rewards[] = (object) [
                        'rewardable_type' => $class,
                        'rewardable_id'   => 1,
                        'quantity'        => $a['quantity'],
                    ];
                }
            } else {
                foreach ($a as $id => $asset) {
                    $rewards[] = (object) [
                        'rewardable_type' => $class,
                        'rewardable_id'   => $id,
                        'quantity'        => $asset['quantity'],
                    ];
                }
            }
        }

        return $rewards;
    }

    /**
     * Gets the gallery submission (if there is one).
     */
    public function getGallerySubmissionAttribute() {
        if (!config('lorekeeper.settings.allow_gallery_submissions_on_prompts') || !isset($this->data['gallery_submission_id'])) {
            return null;
        }

        return GallerySubmission::find($this->data['gallery_submission_id'] ?? null);
    }
=======
    public function getRewardsAttribute()
    {
        if(isset($this->data['rewards']))
        $assets = parseAssetData($this->data['rewards']);
        else
        $assets = parseAssetData($this->data);
        $rewards = [];
        foreach($assets as $type => $a)
        {
            $class = getAssetModelString($type, false);
            foreach($a as $id => $asset)
            {
                $rewards[] = (object)[
                    'rewardable_type' => $class,
                    'rewardable_id' => $id,
                    'quantity' => $asset['quantity']
                ];
            }
        }
        return $rewards;
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
