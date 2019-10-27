<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResultDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'result_detail';
    protected $fillable = [
        'action',
        'time_takes_place',
        'player_id',
        'match_id',
        'note'
    ];
}
