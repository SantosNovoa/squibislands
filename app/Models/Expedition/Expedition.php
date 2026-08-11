<?php

namespace App\Models\Expedition;

use App\Models\Model;

class Expedition extends Model
{
    /**
     * 
     *
     * @var array
     */
    protected $fillable = [
        'name', 'difficulty', 'duration_hours', 'success_rate', 'max_characters', 'description', 'is_active', 'has_image',
    ];

    /**
     * 
     *
     * @var string
     */
    protected $table = 'expeditions';

    /**
     * 
     *
     * @var array
     */
    public static $createRules = [
        'name'            => 'required|unique:expeditions|between:3,100',
        'difficulty'      => 'required|in:Easy,Medium,Hard,Extreme',
        'duration_hours'  => 'required|integer|min:1',
        'success_rate'    => 'required|numeric|min:0|max:100',
        'max_characters'  => 'required|integer|min:1',
        'description'     => 'nullable',
    ];

    /**
     * 
     *
     * @var array
     */
    public static $updateRules = [
        'name'            => 'required|between:3,100',
        'difficulty'      => 'required|in:Easy,Medium,Hard,Extreme',
        'duration_hours'  => 'required|integer|min:1',
        'success_rate'    => 'required|numeric|min:0|max:100',
        'max_characters'  => 'required|integer|min:1',
        'description'     => 'nullable',
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * 
     */
    public function logs()
    {
        return $this->hasMany('App\Models\Expedition\ExpeditionLog', 'expedition_id');
    }

    public function rewards()
    {
        return $this->hasMany('App\Models\Expedition\ExpeditionReward', 'expedition_id');
    }

    /**********************************************************************************************

        ACCESSORS

    **********************************************************************************************/


    /**
     * 
     *
     * @return string
     */
    public function getImageDirectoryAttribute()
    {
        return 'images/data/expeditions';
    }

    /**
     * 
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return url('expeditions/'.$this->id);
    }

    /**
     * 
     *
     * @return string
     */
    public function getExpeditionImageFileNameAttribute()
    {
        return $this->id . '-image.png';
    }

    /**
     * 
     *
     * @return string
     */
    public function getExpeditionImagePathAttribute()
    {
        return public_path($this->imageDirectory);
    }

    /**
     * 
     *
     * @return string
     */
    public function getExpeditionImageUrlAttribute()
    {
        if (!$this->has_image) return null;
        return asset($this->imageDirectory . '/' . $this->expeditionImageFileName);
    }
}