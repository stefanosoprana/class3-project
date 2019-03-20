<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sponsorship;

class SponsorshipsType extends Model
{
  protected $table = 'sponsorships_type';

  public function sponsorship(){
    return $this->belongsTo('App\Sponsorship');
  }
}
