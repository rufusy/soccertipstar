<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'home_team', 
        'away_team',
        'match_date',
        'odd_type',
        'outcome'
    ];
}
