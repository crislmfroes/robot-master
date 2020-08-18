<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remapping extends Model
{
    public function fromKey()
    {
        return $this->hasOne('App\OutputKey');
    }

    public function toKey()
    {
        return $this->hasOne('App\InputKey');
    }
}
