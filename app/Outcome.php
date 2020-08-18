<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    protected $fillable = [
        'name'
    ];

    public function behavior()
    {
        return $this->belongsTo('App\Behavior');
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
