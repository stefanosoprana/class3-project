<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Message;
use App\Service;
use App\Sponsorship;

class Apartment extends Model
{
    protected $fillable = ['title','price', 'street', 'house_number', 'postal_code', 'state', 'latitude', 'longitude', 'image', 'square_meters', 'rooms', 'beds', 'bathrooms', 'user_id', 'published' ];

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
      return $this->hasOne('App\Sponsorship');
    }

    /*
     * Uso scope Apartment::radius($longitude, $latitude, $radius)->where(...)->get();
     * $radius è in metri quindi 40000 per 40km
    */
    public function scopeRadius($query, $longitude, $latitude, $radius){
      return $query->whereRaw("
        ST_DISTANCE_SPHERE(
            POINT($longitude, $latitude),
            POINT(longitude, latitude)) < $radius
         ");
    }

}
