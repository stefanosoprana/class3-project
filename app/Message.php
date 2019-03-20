<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use App\User;
use App\Apartment;

class Message extends Model
{

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function apartments(){
      return $this->belongsTo('App\Apartment');
    }
}
