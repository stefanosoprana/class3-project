<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Apartment;

class Message extends Model
{
   // use SoftDeletes;

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function apartment(){
      return $this->belongsTo('App\Apartment');
    }
}
