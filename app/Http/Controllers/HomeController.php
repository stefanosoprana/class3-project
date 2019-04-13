<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apartment;
use App\Sponsorship;
use App\Message;
use App\Visit;
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
        //ultimi 3 appartamenti
        $apartments = Apartment::where('user_id', $user)->latest()->limit(3)->get();
        //ultimi 4 messaggi
        $messages = Message::where('user_id', $user)->latest()->limit(4)->get();
        //tutti fli appartamenti dell'utente
        $apartments_all = Apartment::where('user_id', $user)->get();
        //tutte le sponsorizzazioni attive
        $sponsorships = Apartment::UserActiveSponsorhips($user)->toArray();

        if(count($sponsorships) === 0){
            $suggestion_sponsorships = [];
            $i = 0;

            while($i < count($apartments_all) && $i < 2){

                $visits = Visit::where('apartment_id', $apartments_all[$i]->id)->orderBy('created_at', 'desc')->get();

                $data = [
                    'year' => Carbon::now()->year,
                    'visits'=> [0,0,0,0,0,0,0,0,0,0,0,0],
                ];

                foreach ($visits as $visit){
                    $visit_created = Carbon::make($visit['created_at']);
                    $visit_month = $visit_created->month;
                    $visit_year = $visit_created->year;

                    if($data['year'] === $visit_year){
                        $data['visits'][$visit_month-1] += 1;
                    }
                }

                $med_visits = ceil(array_sum ($data['visits']) / 12);

                if($med_visits < 100){
                    $suggestion_sponsorships[$i]['apartment'] = $apartments_all[$i];
                    $suggestion_sponsorships[$i]['med_visits'] = $med_visits;
                }

                $i++;
            }
        }

        $data = [
            'apartments' => $apartments,
            'messages' => $messages,
            'sponsorships' => $sponsorships,
            'suggestion_sponsorships' =>  (isset($suggestion_sponsorships)) ? $suggestion_sponsorships : null
        ];

        return view('user.home', $data);
    }

}
