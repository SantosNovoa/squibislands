<?php

namespace App\Models\Gallery;

<<<<<<< HEAD
use App\Models\Model;
use Carbon\Carbon;

class Gallery extends Model {
=======
use Settings;
use Config;
use DB;
use Carbon\Carbon;
use App\Models\Model;

class Gallery extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'parent_id', 'name', 'sort', 'description',
        'currency_enabled', 'votes_required', 'submissions_open',
<<<<<<< HEAD
        'start_at', 'end_at', 'hide_before_start', 'prompt_selection',
        'location_selection',
=======
        'start_at', 'end_at', 'hide_before_start', 'prompt_selection'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galleries';
<<<<<<< HEAD
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
        'end_at'   => 'datetime',
    ];
=======

    /**
     * Dates on the model to convert to Carbon instances.
     *
     * @var array
     */
    public $dates = ['start_at', 'end_at'];
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Validation rules for character creation.
     *
     * @var array
     */
    public static $createRules = [
<<<<<<< HEAD
        'name'        => 'required|unique:galleries|between:3,50',
=======
        'name' => 'required|unique:galleries|between:3,50',
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
        'name'        => 'required|between:3,50',
=======
        'name' => 'required|between:3,50',
>>>>>>> Cylunny/extension/polls-and-forms
        'description' => 'nullable',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the parent gallery.
     */
<<<<<<< HEAD
    public function parent() {
        return $this->belongsTo(self::class, 'parent_id');
=======
    public function parent()
    {
        return $this->belongsTo('App\Models\Gallery\Gallery', 'parent_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the child galleries of this gallery.
     */
<<<<<<< HEAD
    public function children() {
        return $this->hasMany(self::class, 'parent_id')->sort();
    }

    /**
     * Get the sibling galleries of this gallery.
     */
    public function siblings() {
        if ($this->parent) {
            return $this->parent->hasMany(self::class, 'parent_id')->sort();
        }

        return null;
    }

    /**
     * Get the avunculi galleries of this gallery.
     */
    public function avunculi() {
        if ($this->parent && $this->parent->siblings()) {
            return $this->parent->siblings()->sort();
        }

        return null;
=======
    public function children()
    {
        return $this->hasMany('App\Models\Gallery\Gallery', 'parent_id')->sort();
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the submissions made to this gallery.
     */
<<<<<<< HEAD
    public function submissions() {
        return $this->hasMany(GallerySubmission::class, 'gallery_id')->visible()->orderBy('created_at', 'DESC');
    }

    /**
     * Get the criteria attached to this gallery.
     */
    public function criteria() {
        return $this->hasMany(GalleryCriterion::class, 'gallery_id');
=======
    public function submissions()
    {
        return $this->hasMany('App\Models\Gallery\GallerySubmission', 'gallery_id')->visible()->orderBy('created_at', 'DESC');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to return galleries sorted first by sort number and then name.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSort($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSort($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderByRaw('ISNULL(sort), sort ASC')->orderBy('name', 'ASC');
    }

    /**
     * Scope a query to only include active galleries.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query
            ->where(function ($query) {
                $query->whereNull('start_at')->orWhere('start_at', '<', Carbon::now())->orWhere(function ($query) {
                    $query->where('start_at', '>=', Carbon::now())->where('hide_before_start', 0);
                });
            })->where(function ($query) {
                $query->whereNull('end_at')->orWhere('end_at', '>', Carbon::now())->orWhere(function ($query) {
                    $query->where('end_at', '<=', Carbon::now());
                });
            });
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query
            ->where(function($query) {
                $query->whereNull('start_at')->orWhere('start_at', '<', Carbon::now())->orWhere(function($query) {
                    $query->where('start_at', '>=', Carbon::now())->where('hide_before_start', 0);
                });
        })->where(function($query) {
                $query->whereNull('end_at')->orWhere('end_at', '>', Carbon::now())->orWhere(function($query) {
                    $query->where('end_at', '<=', Carbon::now());
                });
        });

>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to only include visible galleries.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query) {
        return $query
            ->where(function ($query) {
                $query->whereNull('start_at')->orWhere('start_at', '<', Carbon::now())->orWhere(function ($query) {
                    $query->where('start_at', '>=', Carbon::now())->where('hide_before_start', 0);
                });
            });
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query
            ->where(function($query) {
                $query->whereNull('start_at')->orWhere('start_at', '<', Carbon::now())->orWhere(function($query) {
                    $query->where('start_at', '>=', Carbon::now())->where('hide_before_start', 0);
                });
        });

>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the gallery's display name.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'" class="display-prompt">'.$this->name.'</a>';
    }

    /**
     * Gets the gallery's URL.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('gallery/'.$this->id);
    }

    /**
<<<<<<< HEAD
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/galleries/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
    }

    /**
     * Gets whether or not the user can submit to the gallery.
     *
     * @param bool       $submissionsOpen
     * @param mixed|null $user
     *
     * @return string
     */
    public function canSubmit($submissionsOpen, $user = null) {
        if ($submissionsOpen) {
            if ((isset($this->start_at) && $this->start_at->isFuture()) || (isset($this->end_at) && $this->end_at->isPast())) {
                return false;
            } elseif ($user && $user->hasPower('manage_submissions')) {
                return true;
            } elseif ($this->submissions_open) {
                return true;
            }
        } else {
            return false;
        }
    }
=======
     * Gets whether or not the user can submit to the gallery.
     *
     * @return string
     */
    public function canSubmit($user = null)
    {
        if(Settings::get('gallery_submissions_open')) {
            if((isset($this->start_at) && $this->start_at->isFuture()) || (isset($this->end_at) && $this->end_at->isPast())) return false;
            elseif($user && $user->hasPower('manage_submissions')) return true;
            elseif($this->submissions_open) return true;
        }
        else return false;
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
