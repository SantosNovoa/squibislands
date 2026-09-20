<?php

namespace App\Models\User;

<<<<<<< HEAD
use App\Models\Model;
use Config;

class UserAlias extends Model {
=======
use Config;
use App\Models\Model;

class UserAlias extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'user_id', 'site', 'alias', 'is_visible', 'is_primary_alias', 'user_snowflake',
=======
        'user_id', 'site', 'alias', 'is_visible', 'is_primary_alias'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_aliases';

    /**********************************************************************************************

        RELATIONS

<<<<<<< HEAD
     **********************************************************************************************/
=======
    **********************************************************************************************/
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Get the user this set of settings belongs to.
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

    /**********************************************************************************************

        SCOPES

<<<<<<< HEAD
     **********************************************************************************************/
=======
    **********************************************************************************************/
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Scope a query to only include visible aliases.
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

    /**********************************************************************************************

        ACCESSORS

<<<<<<< HEAD
     **********************************************************************************************/
=======
    **********************************************************************************************/
>>>>>>> Cylunny/extension/polls-and-forms

    /**
     * Gets the URL for the user's account on a given site.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getUrlAttribute() {
        if ($this->site == 'tumblr') {
            return 'https://'.$this->alias.'.'.config('lorekeeper.sites.tumblr.link');
        } elseif ($this->site == 'discord') {
            return null;
        } else {
            return 'https://'.config('lorekeeper.sites.'.$this->site.'.link').'/'.$this->alias;
        }
=======
    public function getUrlAttribute()
    {
        if($this->site == 'tumblr') return 'https://'.$this->alias.Config::get('lorekeeper.sites.tumblr.link');
        else return 'https://'.Config::get('lorekeeper.sites.'.$this->site.'.link').'/'.$this->alias;
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Displays the user's alias, linked to the appropriate site.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getDisplayAliasAttribute() {
        if ($this->site == 'discord') {
            return '<span>'.$this->alias.'@'.$this->siteDisplayName.'</span>';
        } else {
            return '<a href="'.$this->url.'">'.$this->alias.'@'.$this->siteDisplayName.'</a>';
        }
=======
    public function getDisplayAliasAttribute()
    {
        return '<a href="'.$this->url.'">'.$this->alias.'@'.$this->siteDisplayName.'</a>';
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Retrieves the config data for the site.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getConfigAttribute() {
        return config('lorekeeper.sites.'.$this->site);
=======
    public function getConfigAttribute()
    {
        return Config::get('lorekeeper.sites.' . $this->site);
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Retrieves the display name of the alias's site.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getSiteDisplayNameAttribute() {
        return config('lorekeeper.sites.'.$this->site.'.display_name');
=======
    public function getSiteDisplayNameAttribute()
    {
        return Config::get('lorekeeper.sites.' . $this->site . '.display_name');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Checks if this alias can be made a primary alias.
     *
     * @return string
     */
<<<<<<< HEAD
    public function getCanMakePrimaryAttribute() {
        return config('lorekeeper.sites.'.$this->site.'.primary_alias');
=======
    public function getCanMakePrimaryAttribute()
    {
        return Config::get('lorekeeper.sites.' . $this->site . '.primary_alias');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
