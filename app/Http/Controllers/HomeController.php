<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Sponsorship;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user()->id;
        $apartments = Apartment::where('user_id', $user)->latest()->limit(3)->get();
        $messages = Message::where('user_id', $user)->latest()->limit(4)->get();
        $apartments_user = [];

        foreach ($apartments as $apartment) {
          if ( Apartment::where('user_id', $user) ) {
            $apartments_user[] = $apartment->id;
          }
        }

        $now = Carbon::now();
        $sponsorships = [];

        foreach ($apartments as $apartment_sponsorized){
            // se esiste la sponsorship
            if($apartment_sponsorized->sponsorship){
                //seleziono la sponsorhip con apartment id corrispondente
                $sponsorship = Sponsorship::where('apartment_id', $apartment_sponsorized->id)->first();
                //salvo data di fine in formato carbon
                $sponsorship_expire = Carbon::create($sponsorship['sponsor_expired']);
                //controllo differenza tra oggi e la data
                $diff = $sponsorship_expire->diffInDays($now, false);
                //se è minore o uguale a 0 è ancora attiva e la salvo nell'array
                if($diff <= 0){
                    $sponsorships[] = $apartment_sponsorized;
                }
            }
        }

        $data = [
            'apartments' => $apartments,
            'messages' => $messages,
            'sponsorships' => $sponsorships
        ];

        return view('user.home', $data);
    }

}
