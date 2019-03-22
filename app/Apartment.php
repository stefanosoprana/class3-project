<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Message;
use App\Service;
use App\Sponsorship;

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

    protected $fillable = ['title', 'price', 'image', 'street', 'house_number', 'postal_code', 'state', 'square_meters', 'rooms', 'beds', 'bathrooms', 'user_id'];
}
