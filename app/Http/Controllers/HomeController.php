<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Sponsorship;
use App\Message;
use Illuminate\Support\Facades\Auth;

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

        $messages = Message::where('user_id', $user)->latest()->limit(2)->get();

        $apartments_user = [];

        foreach ($apartments as $apartment) {

          if ( Apartment::where('user_id', $user) ) {
            $apartments_user[] = $apartment->id;
          }
        }

        $sponsorships = Sponsorship::whereIn('apartment_id', $apartments_user)->get();

        return view('user.home', compact('apartments', 'messages', 'sponsorships'));
    }

}
