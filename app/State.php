<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class State extends Model
{
    protected $fillable = [
        'name', 'className', 'description'
    ];

    public function setName($name)
    {
        $this->name = $name;
        $this->className = Str::replaceArray(' ', [''], mb_convert_case($this->name, MB_CASE_UPPER)) . 'State';
    }

    public function availableParams()
    {
        return $this->hasMany('App\StateParam');
    }

    public function transitions()
    {
        return $this->hasMany('App\Transition');
    }

    public function outcomes()
    {
        return $this->hasMany('App\Outcome');
    }

    public function outputKeys()
    {
        return $this->hasMany('App\OutputKey');
    }

    public function inputKeys()
    {
        return $this->hasMany('App\InputKey');
    }

    public function parentBehaviors()
    {
        return $this->belongsToMany('App\Behavior');
    }

    public function robot()
    {
        return $this->belongsTo('App\Robot');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }
}
