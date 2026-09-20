<?php

namespace App\Models\Sales;

<<<<<<< HEAD
use App\Models\Model;
use App\Models\User\User;
use App\Traits\Commentable;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Sales extends Model implements Feedable {
=======
use Carbon\Carbon;
use Config;
use App\Models\Model;
use App\Traits\Commentable;
use Illuminate\Support\Str;

class Sales extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    use Commentable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'text', 'parsed_text', 'title', 'is_visible', 'post_at',
<<<<<<< HEAD
        'is_open', 'comments_open_at',
=======
        'is_open', 'comments_open_at'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sales';

    /**
<<<<<<< HEAD
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'post_at'          => 'datetime',
        'comments_open_at' => 'datetime',
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
<<<<<<< HEAD
=======
     * Dates on the model to convert to Carbon instances.
     *
     * @var array
     */
    public $dates = ['post_at', 'comments_open_at'];

    /**
>>>>>>> Cylunny/extension/polls-and-forms
     * Validation rules for creation.
     *
     * @var array
     */
    public static $createRules = [
        'title' => 'required|between:3,100',
<<<<<<< HEAD
        'text'  => 'required',
=======
        'text' => 'required',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'title' => 'required|between:3,100',
<<<<<<< HEAD
        'text'  => 'required',
=======
        'text' => 'required',
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who created the Sales post.
     */
<<<<<<< HEAD
    public function user() {
        return $this->belongsTo(User::class);
=======
    public function user()
    {
        return $this->belongsTo('App\Models\User\User');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the characters associated with the sales post.
     */
<<<<<<< HEAD
    public function characters() {
        return $this->hasMany(SalesCharacter::class, 'sales_id');
=======
    public function characters()
    {
        return $this->hasMany('App\Models\Sales\SalesCharacter', 'sales_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**********************************************************************************************

        SCOPES

    **********************************************************************************************/

    /**
     * Scope a query to only include visible posts.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query) {
        return $query->where('is_visible', 1);
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
        return $query->orderBy('updated_at', 'DESC')->where('is_visible', 1);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Scope a query to only include posts that are scheduled to be posted and are ready to post.
     *
<<<<<<< HEAD
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShouldBeVisible($query) {
        return $query->whereNotNull('post_at')->where('post_at', '<', Carbon::now())->where('is_visible', 0);
    }

    /**
     * Scope a query to sort sales in alphabetical order.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $reverse
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortAlphabetical($query, $reverse = false) {
        return $query->orderBy('title', $reverse ? 'DESC' : 'ASC');
    }

    /**
     * Scope a query to sort sales by newest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortNewest($query) {
        return $query->orderBy('id', 'DESC');
    }

    /**
     * Scope a query to sort sales oldest first.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortOldest($query) {
        return $query->orderBy('id');
    }

    /**
     * Scope a query to sort sales by bump date.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param bool                                  $reverse
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSortBump($query, $reverse = false) {
        return $query->orderBy('updated_at', $reverse ? 'DESC' : 'ASC');
    }

=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShouldBeVisible($query)
    {
        return $query->whereNotNull('post_at')->where('post_at', '<', Carbon::now())->where('is_visible', 0);
    }

>>>>>>> Cylunny/extension/polls-and-forms
    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the Sales slug.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function getSlugAttribute() {
        return $this->id.'.'.Str::slug($this->title);
=======
    public function getSlugAttribute()
    {
        return $this->id . '.' . Str::slug($this->title);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Displays the Sales post title, linked to the Sales post itself.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'"> ['.($this->is_open ? (isset($this->comments_open_at) && $this->comments_open_at > Carbon::now() ? 'Preview' : 'Open') : 'Closed').'] '.$this->title.'</a>';
    }

    /**
     * Gets the Sales post URL.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
        return url('sales/'.$this->slug);
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/sales/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'manage_sales';
    }

    /**********************************************************************************************

        OTHER FUNCTIONS

    **********************************************************************************************/

    /**
     * Returns all feed items.
     */
    public static function getFeedItems() {
        return self::visible()->get();
    }

    /**
     * Generates feed item information.
     *
     * @return /Spatie/Feed/FeedItem;
     */
    public function toFeedItem(): FeedItem {
        $summary = ($this->characters->count() ? $this->characters->count().' character'.($this->characters->count() > 1 ? 's are' : ' is').' associated with this sale. Click through to read more.<hr/>' : '').$this->parsed_text;

        return FeedItem::create([
            'id'         => '/sales/'.$this->id,
            'title'      => $this->title,
            'summary'    => $summary,
            'updated'    => $this->updated_at,
            'link'       => $this->url,
            'author'     => $this->user->name,
            'authorName' => $this->user->name,
        ]);
    }
=======
    public function getUrlAttribute()
    {
        return url('sales/'.$this->slug);
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
