<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Message;
use App\Visit;
use App\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


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
                'result'=> $data,
                'results_number'=> count($data),
            ]);

        } else {

            return response()->json([
                'success'=>true,
                'error'=>'Appartamento non esistente',
                'result'=> '',
                'results_number'=> 0,
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
                'result'=> $data,
                'results_number'=> count($data),
            ]);

        } else {

            return response()->json([
                'success'=>true,
                'error'=>'Appartamento non esistente',
                'result'=> '',
                'results_number'=> 0,
            ]);

        }
    }

    public function search(Request $request){
        $data_search = $request->all();

        $validated_data = Validator::make($data_search,[
            'latitude'=> 'required|numeric',
            'longitude'=> 'required|numeric',
            'radius'=> 'required|numeric',
        ]);

        if ($validated_data->fails()) {
            //se i dati non sono esatti ritorno errore
            return response()->json([
                'success'=>true,
                'error'=> 'Dati inviati non corretti',
                'result'=> '',
                'results_number'=> 0
            ]);
        }

        $radius = $data_search['radius'];
        $lat = $data_search['latitude'];
        $lon = $data_search['longitude'];

        //salvo id servizi
        $services =  [];
        if(isset($data_search['services'])){
            foreach ($data_search['services'] as $service_name){
                $service = Service::where('name', $service_name)->first();
                $services[] = $service->id;
            }
        }

        //se sono presenti servizi uso tabella pivot
        if(count($services) > 0){
            //whereHas fa ricerca su tabella pivot
            $apartments = Apartment::radius($lon, $lat, $radius)->whereHas('services', function ($query) use ($services){
                //whereIn accetta array
                $query->whereIn('services.id', $services);
            })->get();
        }
        //altrimenti ricerco solo per radius
        else{
            $apartments = Apartment::radius($lon, $lat, $radius)->get();
        }

        //salvo dati in array
        $data = [];
        foreach ($apartments as $apartment) {
            $id =  $apartment->id;
            $name = $apartment->title;
            $price = $apartment->price;
            $rooms = $apartment->rooms;
            $beds = $apartment->beds;
            $bathrooms = $apartment->bathrooms;
            $square_meters = $apartment->square_meters;
            $street = $apartment->street;
            $house_number = $apartment->house_number;
            $postal_code = $apartment->postal_code;
            $locality = $apartment->locality;
            $state = $apartment->state;
            $latitude = $apartment->latitude;
            $longitude = $apartment->longitude;
            $image = asset('storage/' .$apartment->image);
            $this_services = $apartment->services;
            $url = route('apartment.show', $id);

            $data_apartment = [
                'id' => $id,
                'name'=>$name,
                'price'=>$price,
                'rooms'=>$rooms,
                'beds'=>$beds,
                'bathrooms'=>$bathrooms,
                'square_meters'=>$square_meters,
                'street'=>$street,
                'house_number'=>$house_number,
                'postal_code'=>$postal_code,
                'locality'=>$locality,
                'state'=>$state,
                'latitude'=>$latitude,
                'longitude'=>$longitude,
                'image'=>$image,
                'services' => $this_services,
                'url' => $url
            ];
            $data[] = $data_apartment;

        }

        //ritorno json
        return response()->json([
            'success'=>true,
            'error'=>'',
            'result'=> $data,
            'results_number'=> count($data),
        ]);
    }

}
