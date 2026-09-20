<?php

namespace App\Models\Rank;

use App\Models\Model;

<<<<<<< HEAD
class RankPower extends Model {
=======
class RankPower extends Model
{

>>>>>>> Cylunny/extension/polls-and-forms
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
<<<<<<< HEAD
        'rank_id', 'power',
=======
        'rank_id', 'power'
>>>>>>> Cylunny/extension/polls-and-forms
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rank_powers';
}
