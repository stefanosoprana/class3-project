<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Apartment;
use App\SponsorshipType;

class Sponsorship extends Model
{
    public function apartment(){
       return $this->belongsTo('App\Apartment', 'foreign_key');
    }

    public function sponsorshipsType(){
      return $this->hasMany('App\SponsorshipType');
    }
}
