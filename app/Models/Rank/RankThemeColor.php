<?php

namespace App\Models\Rank;

use App\Models\Model;

class RankThemeColor extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rank_id', 'theme_id', 'color',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rank_theme_colors';
}