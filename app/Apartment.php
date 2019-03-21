<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Message;
use App\Service;
use App\Sponsorship;
use App\Scopes\GetRadiusScope;

class Apartment extends Model
{
    public function user(){
      return $this->belongsTo('App\User');
    }

    public function messages(){
      return $this->hasMany('App\Message');
    }

    public function services(){
      return $this->belongsToMany('App\Service');
    }

    public function sponsorship(){
      return $this->hasOne('App\Sponsorship', 'foreign_key');
    }

    public function scopeRadius($query,$latitude,$longitude,$radius){
      return $query->whereRaw("
        ST_DISTANCE_SPHERE(
            POINT($latitude, $longitude),
            POINT(latitude, longitude)) < $radius
         ");
    }
}
