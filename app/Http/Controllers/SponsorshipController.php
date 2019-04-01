<?php

namespace App\Http\Controllers;

use App\Apartment;
use Illuminate\Http\Request;
use Braintree_ClientToken;
use Braintree_Transaction;
use Illuminate\Support\Facades\Auth;

class SponsorshipController extends Controller
{
    //
    public function index($id){
        $apartment = Apartment::find($id);

        return view('payment.index', compact('apartment'));
    }

    public function payment($id){
        $apartment = Apartment::find($id);
        $client_token = Braintree_ClientToken::generate();
        $data = [
            'apartment' => $apartment,
            'client_token'=> $client_token
        ];
        return view('payment.pay',$data);
    }


    public function process(Request $request)
    {
        $data = $request->all();
        $payload = $data['payload'];

        $status = Braintree_Transaction::sale([
            'amount' => '10.00',
            'paymentMethodNonce' => $payload,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);

        return response()->json($status);
    }
}
