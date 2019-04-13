<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Message;
use App\Service;
use App\Sponsorship;
use Illuminate\Support\Carbon;


class Apartment extends Model
{
    protected $fillable = ['title', 'description', 'price', 'street', 'house_number', 'locality', 'postal_code', 'state', 'latitude', 'longitude', 'image', 'square_meters', 'rooms', 'beds', 'bathrooms', 'user_id', 'published' ];

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

    public function visits(){
        return $this->hasMany('App\Visit');
    }

    /*
     * Uso scope Apartment::radius($longitude, $latitude, $radius)->where(...)->get();
     * $radius è in metri quindi 40000 per 40km
    */
    public function scopeRadius($query, $longitude, $latitude, $radius){
      return $query->selectRaw("*, ST_DISTANCE_SPHERE(
            POINT($longitude, $latitude),
            POINT(longitude, latitude)) as distance")->whereRaw("
        ST_DISTANCE_SPHERE(
            POINT($longitude, $latitude),
            POINT(longitude, latitude)) < $radius")->orderBy('distance', 'desc');
    }

    public function scopeAllActiveSponsorhips($query){
        $now = Carbon::now();
        return $query->where('published', true)->whereHas('sponsorship', function ($query) use ($now) {
            $query->whereDate('sponsor_expired', '>=' ,$now)->orderBy('created_at', 'ASC');
        })->get();
    }

}
