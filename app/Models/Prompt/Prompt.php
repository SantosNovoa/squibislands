<?php

namespace App\Models\Prompt;

<<<<<<< HEAD
use App\Models\Model;
use Carbon\Carbon;

class Prompt extends Model {
=======
use Config;
use DB;
use Carbon\Carbon;
use App\Models\Model;
use App\Models\Prompt\PromptCategory;

class Prompt extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'prompt_category_id', 'name', 'summary', 'description', 'parsed_description', 'is_active',
        'start_at', 'end_at', 'hide_before_start', 'hide_after_end', 'has_image', 'prefix',
<<<<<<< HEAD
        'hide_submissions', 'staff_only', 'hash', 'level_req', 'limit', 'limit_period', 'limit_character'
=======
        'hide_submissions'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prompts';
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
        'prompt_category_id' => 'nullable',
<<<<<<< HEAD
        'name'               => 'required|unique:prompts|between:3,100',
        'prefix'             => 'nullable|unique:prompts|between:2,10',
        'summary'            => 'nullable',
        'description'        => 'nullable',
        'image'              => 'mimes:png',
=======
        'name' => 'required|unique:prompts|between:3,100',
        'prefix' => 'nullable|unique:prompts|between:2,10',
        'summary' => 'nullable',
        'description' => 'nullable',
        'image' => 'mimes:png',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * Validation rules for character updating.
     *
     * @var array
     */
    public static $updateRules = [
        'prompt_category_id' => 'nullable',
<<<<<<< HEAD
        'name'               => 'required|between:3,100',
        'prefix'             => 'nullable|between:2,10',
        'summary'            => 'nullable',
        'description'        => 'nullable',
        'image'              => 'mimes:png',
=======
        'name' => 'required|between:3,100',
        'prefix' => 'nullable|between:2,10',
        'summary' => 'nullable',
        'description' => 'nullable',
        'image' => 'mimes:png',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the category the prompt belongs to.
     */
<<<<<<< HEAD
    public function category() {
        return $this->belongsTo(PromptCategory::class, 'prompt_category_id');
=======
    public function category()
    {
        return $this->belongsTo('App\Models\Prompt\PromptCategory', 'prompt_category_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the rewards attached to this prompt.
     */
<<<<<<< HEAD
    public function rewards() {
        return $this->hasMany(PromptReward::class, 'prompt_id');
    }

    /**
     * Get the criteria attached to this prompt.
     */
    public function criteria() {
        return $this->hasMany(PromptCriterion::class, 'prompt_id');
    }
    
    /**
     * Get the skills attached to this prompt.
     */
    public function skills() {
        return $this->hasMany(PromptSkill::class, 'prompt_id');
=======
    public function rewards()
    {
        return $this->hasMany('App\Models\Prompt\PromptReward', 'prompt_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include active prompts.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query) {
        return $query->where('is_active', 1)
            ->where(function ($query) {
                $query->whereNull('start_at')->orWhere('start_at', '<', Carbon::now())->orWhere(function ($query) {
                    $query->where('start_at', '>=', Carbon::now())->where('hide_before_start', 0);
                });
            })->where(function ($query) {
                $query->whereNull('end_at')->orWhere('end_at', '>', Carbon::now())->orWhere(function ($query) {
                    $query->where('end_at', '<=', Carbon::now())->where('hide_after_end', 0);
                });
            });
    }

    /**
     * Scope a query to open or closed prompts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $isOpen
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOpen($query, $isOpen) {
        if ($isOpen) {
            $query->where(function ($query) {
                $query->whereNull('end_at')->where('start_at', '<', Carbon::now());
            })->orWhere(function ($query) {
                $query->whereNull('start_at')->where('end_at', '>', Carbon::now());
            })->orWhere(function ($query) {
                $query->where('start_at', '<', Carbon::now())->where('end_at', '>', Carbon::now());
            })->orWhere(function ($query) {
                $query->whereNull('end_at')->whereNull('start_at');
            });
        } else {
            $query->where(function ($query) {
                $query->whereNull('end_at')->where('start_at', '>', Carbon::now());
            })->orWhere(function ($query) {
                $query->whereNull('start_at')->where('end_at', '<', Carbon::now());
            })->orWhere('start_at', '>', Carbon::now())->orWhere('end_at', '<', Carbon::now());
        }
    }

    /**
     * Scope a query to include or exclude staff-only prompts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\Models\User\User                 $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStaffOnly($query, $user) {
        if ($user && $user->isStaff) {
            return $query;
        }

        return $query->where('staff_only', 0);
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1)
            ->where(function($query) {
                $query->whereNull('start_at')->orWhere('start_at', '<', Carbon::now())->orWhere(function($query) {
                    $query->where('start_at', '>=', Carbon::now())->where('hide_before_start', 0);
                });
        })->where(function($query) {
                $query->whereNull('end_at')->orWhere('end_at', '>', Carbon::now())->orWhere(function($query) {
                    $query->where('end_at', '<=', Carbon::now())->where('hide_after_end', 0);
                });
        });

>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to sort prompts in alphabetical order.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $reverse
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortAlphabetical($query, $reverse = false) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  bool                                   $reverse
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortAlphabetical($query, $reverse = false)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderBy('name', $reverse ? 'DESC' : 'ASC');
    }

    /**
     * Scope a query to sort prompts in category order.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortCategory($query) {
        if (PromptCategory::all()->count()) {
            return $query->orderBy(PromptCategory::select('sort')->whereColumn('prompts.prompt_category_id', 'prompt_categories.id'), 'DESC');
        }

        return $query;
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortCategory($query)
    {
        $ids = PromptCategory::orderBy('sort', 'DESC')->pluck('id')->toArray();
        return count($ids) ? $query->orderByRaw(DB::raw('FIELD(prompt_category_id, '.implode(',', $ids).')')) : $query;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to sort features by newest first.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderBy('id', 'DESC');
    }

    /**
     * Scope a query to sort features oldest first.
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
     * Scope a query to sort prompts by start date.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $reverse
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortStart($query, $reverse = false) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  bool                                   $reverse
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortStart($query, $reverse = false)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderBy('start_at', $reverse ? 'DESC' : 'ASC');
    }

    /**
     * Scope a query to sort prompts by end date.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $reverse
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortEnd($query, $reverse = false) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  bool                                   $reverse
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortEnd($query, $reverse = false)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->orderBy('end_at', $reverse ? 'DESC' : 'ASC');
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Displays the model's name, linked to its encyclopedia page.
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
        return 'images/data/prompts';
    }

    /**
     * Gets the file name of the model's image.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getImageFileNameAttribute() {
        return $this->hash.$this->id.'-image.png';
=======
    public function getImageFileNameAttribute()
    {
        return $this->id . '-image.png';
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
        if (!$this->has_image) {
            return null;
        }

        return asset($this->imageDirectory.'/'.$this->imageFileName);
=======
    public function getImageUrlAttribute()
    {
        if (!$this->has_image) return null;
        return asset($this->imageDirectory . '/' . $this->imageFileName);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Gets the URL of the model's encyclopedia page.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
=======
    public function getUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('prompts/prompts?name='.$this->name);
    }

    /**
<<<<<<< HEAD
     * Gets the URL of the individual prompt's page, by ID.
     *
     * @return string
     */
    public function getIdUrlAttribute() {
        return url('prompts/'.$this->id);
    }

    /**
=======
>>>>>>> Cylunny/extension/polls-and-forms
     * Gets the prompt's asset type for asset management.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getAssetTypeAttribute() {
        return 'prompts';
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/data/prompts/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'edit_data';
    }
=======
    public function getAssetTypeAttribute()
    {
        return 'prompts';
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
