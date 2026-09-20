<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Models\Feature\Feature;
use App\Models\Model;

class CharacterFeature extends Model {
=======
use Config;
use DB;
use App\Models\Model;
use App\Models\Character\CharacterCategory;

class CharacterFeature extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'character_image_id', 'feature_id', 'data', 'character_type',
=======
        'character_image_id', 'feature_id', 'data', 'character_type'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
<<<<<<< HEAD
    protected $table = 'character_features';

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['feature'];

    /**********************************************************************************************

=======
    protected $table = 'character_features';    
    
    /**********************************************************************************************
    
>>>>>>> Cylunny/extension/polls-and-forms
        RELATIONS

    **********************************************************************************************/

    /**
     * Get the image associated with this record.
     */
<<<<<<< HEAD
    public function image() {
        return $this->belongsTo(CharacterImage::class, 'character_image_id');
    }

    /**
     * Get the feature (character trait) associated with this record.
     */
    public function feature() {
        return $this->belongsTo(Feature::class, 'feature_id');
=======
    public function image() 
    {
        return $this->belongsTo('App\Models\Character\CharacterImage', 'character_image_id');
    }
    
    /**
     * Get the feature (character trait) associated with this record.
     */
    public function feature() 
    {
        return $this->belongsTo('App\Models\Feature\Feature', 'feature_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
