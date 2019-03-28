<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Message;
use App\Visit;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApartmentController extends Controller
{

    public function visits($id)
    {
        $apartment = Apartment::find($id);

        if(!empty($apartment)){
            $_MONTH = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

            $visits = Visit::where('apartment_id', $id)->orderBy('created_at', 'desc')->get();

            $data = [
                'apartment'=> ['apartment_id'=> $apartment->id,'apartment_title'=> $apartment->title],
                'visits'=> [
                    'labels'=> $_MONTH,
                    'number'=> [0,0,0,0,0,0,0,0,0,0,0,0],
                ]
            ];

            foreach ($visits as $visit){
                $visit_created = Carbon::make($visit['created_at']);
                $visit_month = $visit_created->month;
                $data['visits']['number'][$visit_month-1] += 1;
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


    public function messages($id)
    {
        $apartment = Apartment::find($id);

        if(!empty($apartment)){
            $_MONTH = ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'];

            $messages = Message::where('apartment_id', $id)->orderBy('created_at', 'desc')->get();

            $data = [
                'apartment'=> ['apartment_id'=> $apartment->id,'apartment_title'=> $apartment->title],
                'messages'=> [
                    'labels'=> $_MONTH,
                    'number'=> [0,0,0,0,0,0,0,0,0,0,0,0],
                ],
            ];

            foreach ($messages as $message){
                $message_created = Carbon::make($message['created_at']);
                $message_month = $message_created->month;
                $data['messages']['number'][$message_month-1] += 1;
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

    public function search(){
        $services = [1, 2];

      $data = [];

      //whereHas fa ricerca su tabella pivot
      $apartments = Apartment::whereHas('services', function ($query) use ($services){
          //whereIn accetta array
          $query->whereIn('services.id', $services);
      })->get();

        
      $services = Service::all();

      /*l'utente chiede gli apparftamenti che hanno tot servizi
        array di servizi
      */
     /* foreach ($services as $service) {
         $service = $apartments->services()->get();
         dd($service);
       }*/
      //
      //

      // problemi con la many to many relantionship


      foreach ($apartments as $apartment) {
        $rooms = $apartment->rooms;
        $beds = $apartment->beds;
        $latitude = $apartment->latitude;
        $longitude = $apartment->longitude;

        $newData = [
          'apartments' =>[
            'rooms'=>$rooms,
            'beds'=>$beds,
            'latitude'=>$latitude,
            'longitude'=>$longitude,
          ],
          // 'services'=>[
          //   'apartment_service'=>$services
          // ]
        ];

          $data[] = $newData;

      }

      return response()->json([
        'success'=>true,
        'error'=>'',
        'result'=> $data
      ]);
    }

}
