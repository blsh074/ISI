<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    public function trackItem()
    {
        return $this->hasMany('App\TrackItem');
    }
}
