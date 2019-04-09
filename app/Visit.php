<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['ip', 'apartment_id','created_ad', 'updated_at'];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }
}
