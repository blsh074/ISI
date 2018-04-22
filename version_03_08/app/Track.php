<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function trackItem()
    {
        return $this->hasMany('App\TrackItem');
    }
    
    public function userdata()
    {
        return $this->hasMany('App\User');
    }
    
}
