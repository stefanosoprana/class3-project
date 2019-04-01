<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Sponsorship;
use App\SponsorshipsType;
use Illuminate\Http\Request;
use Braintree_ClientToken;
use Braintree_Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SponsorshipController extends Controller
{
    //
    public function index($id){
        $apartment = Apartment::find($id);

        return view('payment.index', compact('apartment'));
    }

    public function payment($id, $sponsorship_type_id){
        $apartment = Apartment::find($id);
        $user = Auth::user();
        if($apartment->user_id != $user->id){
            abort('404');
        }

        $client_token = Braintree_ClientToken::generate();

        $data = [
            'apartment' => $apartment,
            'client_token'=> $client_token,
            'sponsorship' => $sponsorship_type_id
        ];

        return view('payment.pay',$data);
    }


    public function process(Request $request)
    {
        $data = $request->all();
        $payload = $data['payload'];
        $sponsorship_id = $data['sponsorship'];
        $sponsorship = SponsorshipsType::find($sponsorship_id);

        $apartment_id = $data['apartmentId'];

        $status = Braintree_Transaction::sale([
            'amount' => $sponsorship->price,
            'paymentMethodNonce' => $payload,
            'options' => [
                'submitForSettlement' => True,
            ]
        ]);

       if($status->transaction->processorResponseType === 'approved'){
            $now = Carbon::now('Europe/Rome');
            $period = $now->addHours($sponsorship["period"]);

            $new_sponsorship = new Sponsorship();
            $new_sponsorship->apartment_id = $apartment_id;
            $new_sponsorship->sponsorships_type_id = $apartment_id;
            $new_sponsorship->sponsor_expired = $period;
            $new_sponsorship->created_at = $now;
            $new_sponsorship->updated_at = $now;
            $new_sponsorship->save();
        }


        return response()->json($status);
    }
}
