<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Service;

class ServiceComposer
{
    protected $services;

    public function __construct()
    {
        $this->services = Service::all();
    }

    //compose passa alla view i dati inseriti in construct
    public function compose(View $view){
        //il metodo with passa alla view coppia chiave/valore
        $view->with('services', $this->services);
    }

}