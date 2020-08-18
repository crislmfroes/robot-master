<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transition extends Model
{
    public function fromOutcome()
    {
        return $this->hasOne('App\Outcome');
    }

    public function toState()
    {
        return $this->hasOne('App\State');
    }
}
