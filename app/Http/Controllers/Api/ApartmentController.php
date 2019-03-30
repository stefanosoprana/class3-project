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
            'beds'=> 'nullable|numeric',
            'rooms'=> 'nullable|numeric',
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
        $beds = (isset($data_search['beds'])) ? $data_search['beds'] : null;
        $rooms = (isset($data_search['rooms'])) ? $data_search['rooms'] : null;

        //salvo id servizi
        $services =  [];
        if(isset($data_search['services'])){
            foreach ($data_search['services'] as $service_name){
                $service = Service::where('name', $service_name)->first();
                $services[] = $service->id;
            }
        }

        $apartments_query = Apartment::radius($lon, $lat, $radius);
        $apartments_query->where('published', '=', 1);

        //se sono presenti servizi uso tabella pivot
        if(count($services) > 0){
            //whereHas fa ricerca su tabella pivot
            $apartments_query->whereHas('services', function ($query) use ($services){
                //whereIn accetta array
                $query->whereIn('services.id', $services);
            });
        }

        //se è presente il numero di letti
        if($beds){
            //dd($beds);
            $apartments_query->where('beds', '>=', $beds);
        }
        //se è presente il numero di stanze
        if($rooms){
            // dd($rooms);
            $apartments_query->where('rooms', '>=', $rooms);
        }
        //duplico query prendo solo appartamenti sponsorizzati
        $apartments_sponsorized_query =  clone $apartments_query;

        //elimino sponsorizzati
        $apartments_query->doesnthave('sponsorship');
        //get su apartmenti
        $apartments = $apartments_query->get();

        //get su apartmenti sponsorizzati
        $apartments_sponsorized = $apartments_sponsorized_query->has('sponsorship')->get();
        //dd($apartments);
        //salvo dati appartamenti sponsorizzati in array
        $data = [];
        foreach ($apartments_sponsorized as $apartment) {
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
                'sponsorized' => 'sponsorized',
                'url' => $url
            ];
            $data[] = $data_apartment;
        }

        //salvo dati appartamenti normali in array
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
                'sponsorized' => '',
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
