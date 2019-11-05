<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'league_id'
    ];

    
    public function league()
    {
        return $this->belongsTo(League::class);
    }
   
}
