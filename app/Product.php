<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function file()
    {
        return $this->belongsTo('App\File');
    }
    public function trackItem()
    {
        return $this->hasMany('App\TrackItem');
    }
    public function rating()
    {
        return $this->hasMany('App\Rating');
    }
    
}