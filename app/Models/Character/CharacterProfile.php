<?php

namespace App\Models\Character;

<<<<<<< HEAD
use App\Models\Model;

class CharacterProfile extends Model {
=======
use Config;
use DB;
use App\Models\Model;
use App\Models\Character\CharacterCategory;

class CharacterProfile extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'character_id', 'text', 'parsed_text', 'link', 'items_tab_order', 'info_tab_order',
=======
        'character_id', 'text', 'parsed_text', 'link'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'character_profiles';
<<<<<<< HEAD
=======

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The primary key of the model.
     *
     * @var string
     */
    public $primaryKey = 'character_id';

    /**
     * Validation rules for character profile updating.
     *
     * @var array
     */
    public static $rules = [
<<<<<<< HEAD
        'link' => 'url|nullable',
    ];

    protected $casts = [
        'items_tab_order' => 'array',
        'info_tab_order'  => 'array',
=======
        'link' => 'url|nullable'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the character this profile belongs to.
     */
<<<<<<< HEAD
    public function character() {
        return $this->belongsTo(Character::class, 'character_id');
=======
    public function character()
    {
        return $this->belongsTo('App\Models\Character\Character', 'character_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }
}
