<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
