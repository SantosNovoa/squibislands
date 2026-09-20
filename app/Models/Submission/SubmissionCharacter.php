<?php

namespace App\Models\Submission;

<<<<<<< HEAD
use App\Models\Character\Character;
use App\Models\Model;

class SubmissionCharacter extends Model {
=======
use Config;
use DB;
use Carbon\Carbon;
use App\Models\Model;

class SubmissionCharacter extends Model
{
>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'submission_id', 'character_id', 'data', 'is_focus',
=======
        'submission_id', 'character_id', 'data'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'submission_characters';

    /**********************************************************************************************

        RELATIONS

    **********************************************************************************************/

    /**
     * Get the submission this is attached to.
     */
<<<<<<< HEAD
    public function submission() {
        return $this->belongsTo(Submission::class, 'submission_id');
=======
    public function submission()
    {
        return $this->belongsTo('App\Models\Submission\Submission', 'submission_id');
>>>>>>> Cylunny/extension/polls-and-forms
    }

    /**
     * Get the character being attached to the submission.
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
=======
    public function getDataAttribute()
    {
>>>>>>> Cylunny/extension/polls-and-forms
        return json_decode($this->attributes['data'], true);
    }

    /**
     * Get the rewards for the character.
     *
     * @return array
     */
<<<<<<< HEAD
    public function getRewardsAttribute() {
        $assets = parseAssetData($this->data);
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

=======
    public function getRewardsAttribute()
    {
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
>>>>>>> Cylunny/extension/polls-and-forms
        return $rewards;
    }
}
