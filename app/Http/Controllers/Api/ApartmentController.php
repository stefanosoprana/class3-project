<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Message;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{

    public function show($id)
    {
        $apartment = Apartment::find($id);

        if(!empty($apartment)){
            $_MONTH = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

            $messages = Message::where('apartment_id', $id)->orderBy('created_at', 'desc')->get();
            $visits = Visit::where('apartment_id', $id)->orderBy('created_at', 'desc')->get();

            $data = [
                'visits'=> [
                    'labels'=> $_MONTH,
                    'number'=> [0,0,0,0,0,0,0,0,0,0,0,0],
                ],
                'messages'=> [
                    'labels'=> $_MONTH,
                    'number'=> [0,0,0,0,0,0,0,0,0,0,0,0],
                ],
            ];

            foreach ($messages as $message){
                $message_created = Carbon::make($message['created_at']);
                $message_month = $message_created->month;
                $data['messages']['number'][$message_month] += 1;
            }

            foreach ($visits as $visit){
                $visit_created = Carbon::make($visit['created_at']);
                $visit_month = $visit_created->month;
                $data['visits']['number'][$visit_month] += 1;
            }

            return response()->json([
                'success'=>true,
                'error'=>'',
                'result'=> $data
            ]);

        } else {

            return response()->json([
                'success'=>true,
                'error'=>'Appartamento non esistente',
                'result'=> ''
            ]);

        }
    }
}
