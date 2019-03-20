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

    public function message(){
      return $this->hasMany('App\Message');
    }

    public function services(){
      return $this->belongsToMany('App\Service');
    }

    public function sponsorship(){
      return $this->hasOne('App\Sponsorship', 'foreign_key');
    }
}
