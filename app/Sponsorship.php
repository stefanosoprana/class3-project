<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Apartment;
use App\SponsorshipType;

class Sponsorship extends Model
{
    public function apartment(){
       return $this->belongsTo('App\Apartment');
    }

    public function sponsorshipsType(){
      return $this->belongsTo('App\SponsorshipsType');
    }
}
