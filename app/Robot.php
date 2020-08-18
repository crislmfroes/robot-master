<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Robot extends Model
{
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_robot');
    }

    public function behaviors()
    {
        return $this->hasMany('App\Behavior');
    }

    public function states()
    {
        return $this->hasMany('App\State');
    }
}
