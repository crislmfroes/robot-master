<?php

namespace App;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class Behavior extends Model
{
    protected $fillable = [
        'name', 'description', 'className'
    ];

    public function setName($name)
    {
        $this->name = $name;
        $this->className = 'get'.Str::replaceArray(' ', [''], mb_convert_case($this->name, MB_CASE_UPPER)).'Machine';
    }

    public function robot()
    {
        return $this->belongsTo('App\Robot');
    }

    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function containedBehaviors()
    {
        return $this->belongsToMany('App\Behavior', 'behavior_behavior', 'parent_behavior_id', 'child_behavior_id')->withPivot('state_param_id');
    }

    public function containedStates()
    {
        return $this->belongsToMany('App\State')->withPivot('state_param_id');
    }

    public function availableParams()
    {
        return $this->hasMany('App\StateParam');
    }

    public function transitions()
    {
        return $this->hasMany('App\Transition');
    }

    public function outputKeys()
    {
        return $this->hasMany('App\OutputKey');
    }

    public function inputKeys()
    {
        return $this->hasMany('App\InputKey');
    }

    public function outcomes()
    {
        return $this->hasMany('App\Outcome');
    }

}
