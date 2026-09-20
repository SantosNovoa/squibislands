<?php

namespace App\Models;

<<<<<<< HEAD
use App\Models\User\User;
use App\Traits\Commentable;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class News extends Model implements Feedable {
=======
use Carbon\Carbon;
use Config;
use App\Models\Model;
use Illuminate\Support\Str;

use App\Traits\Commentable;

class News extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    use Commentable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'user_id', 'text', 'parsed_text', 'title', 'is_visible', 'post_at',
=======
        'user_id', 'text', 'parsed_text', 'title', 'is_visible', 'post_at'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';

    /**
<<<<<<< HEAD
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'post_at' => 'datetime',
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
    public $dates = ['post_at'];

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
    ];

=======
        'text' => 'required',
    ];
    
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * Validation rules for updating.
     *
     * @var array
     */
    public static $updateRules = [
        'title' => 'required|between:3,100',
<<<<<<< HEAD
        'text'  => 'required',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the user who created the news post.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    /**********************************************************************************************

=======
        'text' => 'required',
    ];

    /**********************************************************************************************
    
        RELATIONS

    **********************************************************************************************/
    
    /**
     * Get the user who created the news post.
     */
    public function user() 
    {
        return $this->belongsTo('App\Models\User\User');
    }

    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
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
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeVisible($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->where('is_visible', 1);
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
=======
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeShouldBeVisible($query)
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return $query->whereNotNull('post_at')->where('post_at', '<', Carbon::now())->where('is_visible', 0);
    }

    /**********************************************************************************************
<<<<<<< HEAD

=======
    
>>>>>>> Cylunny/extension/polls-and-forms
        ACCESSORS

    **********************************************************************************************/

    /**
     * Get the news slug.
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
     * Displays the news post title, linked to the news post itself.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayNameAttribute() {
=======
    public function getDisplayNameAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return '<a href="'.$this->url.'">'.$this->title.'</a>';
    }

    /**
     * Gets the news post URL.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
        return url('news/'.$this->slug);
    }

    /**
     * Gets the admin edit URL.
     *
     * @return string
     */
    public function getAdminUrlAttribute() {
        return url('admin/news/edit/'.$this->id);
    }

    /**
     * Gets the power required to edit this model.
     *
     * @return string
     */
    public function getAdminPowerAttribute() {
        return 'manage_news';
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
        return FeedItem::create([
            'id'         => '/news/'.$this->id,
            'title'      => $this->title,
            'summary'    => $this->parsed_text,
            'updated'    => $this->updated_at,
            'link'       => $this->url,
            'author'     => $this->user->name,
            'authorName' => $this->user->name,
        ]);
    }
=======
    public function getUrlAttribute()
    {
        return url('news/'.$this->slug);
    }
>>>>>>> Cylunny/extension/polls-and-forms
}
