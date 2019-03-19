<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Apartment;

class Sponsorship extends Model
{
    public function apartment(){
       return $this->belongsTo('App\Apartment', 'foreign_key');
    }
}
