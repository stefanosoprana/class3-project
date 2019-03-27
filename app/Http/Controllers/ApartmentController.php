<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Sponsorship;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mapper;

class ApartmentController extends Controller
{

    // CONTROLLER GUEST

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::where('published', true)->get();
        $data =[
            'apartments' => [],
            'sponsorships' => []
        ];

        $now = Carbon::now();
        foreach ($apartments as $apartment){
            // se esiste la sponsorship
            if($apartment->sponsorship){
                //seleziono la sponsorhip con apartment id corrispondente
                $sponsorship = Sponsorship::where('apartment_id', $apartment->id)->first();
                //salvo data di fine in formato carbon
                $sponsorship_expire = Carbon::create($sponsorship['sponsor_expired']);
                //controllo differenza tra oggi e la data
                $diff = $sponsorship_expire->diffInDays($now, false);
                //se è minore o uguale a 0 è ancora attiva e la salvo nell'array
                if($diff <= 0){
                    $data['sponsorships'][] = $apartment;
                }
            }
            else{
                $data['apartments'][] = $apartment;
            }
        }
        return view('apartment.index',$data);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
      $apartment = Apartment::find($id);

      Mapper::map($apartment->latitude, $apartment->longitude);

      return view('apartment.show', compact('apartment'));
    }

    //CONTROLLER USER-ADMIN

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userIndex()
    {
        $user = Auth::user()->id;
        $apartments = Apartment::where('user_id', $user)->get();
        return view('apartment.userIndex', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Aggiungi un nuovo appartamento',
            'method' => 'POST',
            'route' => route('apartment.store'),
        ];

        return view('apartment.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validated_data = Validator::make($data,[
            'title'=> 'required',
            'description'=> 'required|string',
            'price'=> 'required|numeric',
            'street'=> 'required|string',
            'house_number'=> 'required|numeric',
            'locality'=> 'required|string',
            'postal_code'=> 'required|numeric',
            'state'=> 'required|string',
            'latitude'=> 'required|numeric',
            'longitude'=> 'required|numeric',
            'image'=>'nullable|image',
            'square_meters'=>'required|numeric',
            'rooms'=>'required|numeric',
            'beds'=>'required|numeric',
            'bathrooms'=>'required|numeric',
            'user_id'=>'exists:users,id',
            'published'=>'required|boolean',
        ]);

        //dd($data);
        if ($validated_data->fails()) {
            return redirect()->back()
                ->withErrors($validated_data)
                ->withInput();
        }

        if(!empty($request['image'])){
            $image = Storage::disk('public')->put('apartment_image', $request['image']);
            $data['image'] = $image;
        } else {
            $data['image'] = null;
        }

        $newApartment = new Apartment();
        $newApartment->fill($data);
        $newApartment->save();

        $message = 'Appartamento creato con successo';

        return redirect(route('apartments.user.index', $data['user_id']))->with('status', $message);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $apartment = Apartment::find($id);

      if (empty($apartment)) {
        abort(404);
      };

      $data = [
            'title' => 'Modifica l\'appartamento '.$apartment->title,
            'method' => 'PATCH',
            'route' => route('apartment.update', $apartment->id),
            'apartment' => $apartment
      ];

      return view('apartment.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $apartment = Apartment::find($id);
        $data = $request->all();

        if (empty($apartment)) {
            abort(404);
        };

        if($request['delete_image']){
            $delete = Storage::disk('public')->delete($request['delete_image']);
            $data['image'] = null;
        }


        $validated_data = Validator::make($data,[
            'title'=> 'required',
            'description'=> 'required|string',
            'price'=> 'required|numeric',
            'street'=> 'required|string',
            'house_number'=> 'required|numeric',
            'locality'=> 'required|string',
            'postal_code'=> 'required|numeric',
            'state'=> 'required|string',
            'latitude'=> 'required|numeric',
            'longitude'=> 'required|numeric',
            'image'=>'nullable|image',
            'square_meters'=>'required|numeric',
            'rooms'=>'required|numeric',
            'beds'=>'required|numeric',
            'bathrooms'=>'required|numeric',
            'user_id'=>'exists:users,id',
            'published'=>'required|boolean',
        ]);

        if ($validated_data->fails()) {
            return redirect()->back()
                ->withErrors($validated_data)
                ->withInput();
        }

        if(!empty($request['image'])){
            $image = Storage::disk('public')->put('apartment_image', $request['image']);
            $data['image'] = $image;
        } else {
            $data['image'] = null;
        }

        $data['updated_at'] = Carbon::now();

        $apartment->fill($data);
        $apartment->save();

        $message = 'Appartamento aggiornato con successo';

        return redirect(route('apartments.user.index', $data['user_id']))->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);
        $user = $apartment->user_id;
        $apartment_title = $apartment->title;

        if (empty($apartment)) {
            abort(404);
        };

        $messages = $apartment->messages()->get();
        foreach ($messages as $message){
            $message->delete();
        }

        $apartment->delete();

        $message = 'Hai cancellato l\'appartamento ' . $apartment_title;

        return redirect(route('apartments.user.index', $user))->with('status', $message);
    }

    /**
     *
     * View Statistics
     *
     */
    public function statistics($id)
    {
        $apartment = Apartment::find($id)->first();
        return view('apartment.statistics', compact('apartment'));
    }
}
