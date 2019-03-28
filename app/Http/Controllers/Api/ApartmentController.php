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

    public function search(Request $request){
        $data_search = $request->all();

        $validated_data = Validator::make($data_search,[
            'latitude'=> 'required|numeric',
            'longitude'=> 'required|numeric',
            'radius'=> 'required|numeric',
        ]);

        if ($validated_data->fails()) {
            dd($validated_data);
            return response()->json([
                'success'=>true,
                'error'=> $validated_data,
                'result'=> ''
            ]);
        }

        $radius = $data_search['radius'];
        $lat = $data_search['latitude'];
        $lon = $data_search['longitude'];

        $services =  [];
        foreach ($data_search['services'] as $service_name){
            $service = Service::where('name', $service_name)->first();
            $services[] = $service->id;
        }

        $data = [];

        //whereHas fa ricerca su tabella pivot
        $apartments = Apartment::radius($lon, $lat, $radius)->whereHas('services', function ($query) use ($services){
            //whereIn accetta array
            $query->whereIn('services.id', $services);
        })->get();

        foreach ($apartments as $apartment) {
            $name = $apartment->title;
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
            $image = $apartment->image;
            $this_services = $apartment->services;

            $data_apartment = [
                'name'=>$name,
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
            ];
            $data[] = $data_apartment;

        }

        return response()->json([
            'success'=>true,
            'error'=>'',
            'result'=> $data
        ]);
    }

}
