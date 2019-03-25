<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sponsorship;

class SponsorshipsType extends Model
{
  protected $table = 'sponsorships_type';

  public function sponsorships(){
    return $this->hasMany('App\Sponsorship');
  }
}
