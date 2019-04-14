<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Apartment;
use App\SponsorshipType;
use Carbon\Carbon;


class Sponsorship extends Model
{
    public function apartment(){
       return $this->belongsTo('App\Apartment');
    }

    public function sponsorshipsType(){
      return $this->belongsTo('App\SponsorshipsType');
    }

    public function scopeIsActiveSponsorship($query, $apartment_id){
        $now = Carbon::now();
        if($query->where('apartment_id',$apartment_id)->whereDate('sponsor_expired', '>=' ,$now)->first()){
            return true;
        }
        return false;
    }

}
