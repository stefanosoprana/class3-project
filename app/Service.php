<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Apartment;

class Service extends Model
{
    public function apartments()
    {
        return $this->belongsToMany('App\Apartment');
    }
}
