<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function robots()
    {
        return $this->belongsToMany('App\Robot', 'user_robot');
    }

    public function behaviors()
    {
        return $this->hasMany('App\Behavior');
    }

    public function states()
    {
        return $this->hasMany('App\State');
    }

    public function hasRobot(Robot $robot) {
        return $this->robots->contains($robot);
    }
}
