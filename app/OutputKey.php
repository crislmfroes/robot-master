<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputKey extends Model
{
    protected $fillable = [
        'name', 'value'
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
