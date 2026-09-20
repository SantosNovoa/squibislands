<?php

namespace App\Models\Report;

<<<<<<< HEAD
use App\Models\Model;
use App\Models\User\User;
use App\Traits\Commentable;

class Report extends Model {
=======
use Config;
use DB;
use Carbon\Carbon;
use App\Models\Model;
use App\Traits\Commentable;

class Report extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    use Commentable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'staff_id', 'url',
        'comments', 'staff_comments', 'parsed_staff_comments',
<<<<<<< HEAD
        'status', 'data', 'error_type', 'is_br',
=======
        'status', 'data', 'error_type', 'is_br'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reports';

    /**
     * Whether the model contains timestamps to be saved and updated.
     *
     * @var string
     */
    public $timestamps = true;
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for report creation.
     *
     * @var array
     */
    public static $createRules = [
        'url' => 'required',
    ];
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for report updating.
     *
     * @var array
     */
    public static $updateRules = [
        'url' => 'required',
    ];

    /**********************************************************************************************
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/
    /**
     * Get the user who made the report.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the staff who processed the report.
     */
    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**********************************************************************************************

=======
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User', 'user_id');
    }
    
    /**
     * Get the staff who processed the report.
     */
    public function staff() 
    {
        return $this->belongsTo('App\Models\User\User', 'staff_id');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include pending reports.
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
     * Scope a query to only include reports assigned to a given user.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed                                 $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssignedToMe($query, $user) {
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAssignedToMe($query, $user)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('status', 'Assigned')->where('staff_id', $user->id);
    }

    /**
     * Scope a query to only include viewable reports.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed                                 $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeViewable($query, $user) {
        if ($user && $user->hasPower('manage_reports')) {
            return $query;
        }

        return $query->where(function ($query) use ($user) {
            if ($user) {
                $query->where('user_id', $user->id)->orWhere('error_type', '!=', 'exploit');
            } else {
                $query->where('error_type', '!=', 'exploit');
            }
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeViewable($query, $user)
    {
        if($user && $user->hasPower('manage_reports')) return $query;
        return $query->where(function($query) use ($user) {
            if($user) $query->where('user_id', $user->id)->orWhere('error_type', '!=', 'exploit');
            else $query->where('error_type', '!=', 'exploit');
>>>>>>> Cylunny/extension/polls-and-forms
        });
    }

    /**
<<<<<<< HEAD
     * Scope a query to sort reports by oldest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query) {
        return $query->orderBy('id');
    }

    /**
     * Scope a query to sort reports by newest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
        return $query->orderBy('id', 'DESC');
    }

    /**********************************************************************************************

=======
     * Scope a query to sort reports oldest first.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query)
    {
        return $query->orderBy('id');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

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
     * Get the viewing URL of the report/claim.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getViewUrlAttribute() {
=======
    public function getViewUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('reports/view/'.$this->id);
    }

    /**
     * Get the admin URL (for processing purposes) of the submission/claim.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getAdminUrlAttribute() {
=======
    public function getAdminUrlAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return url('admin/reports/edit/'.$this->id);
    }

    /**
     * Displays the news post title, linked to the news post itself.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
        return '<a href="'.$this->viewurl.'">'.'Report #-'.$this->id.'</a>';
    }
=======
    public function getDisplayNameAttribute()
    {
        return '<a href="'.$this->viewurl.'">'.'Report #-' . $this->id.'</a>';
    }

>>>>>>> Cylunny/extension/polls-and-forms
}
