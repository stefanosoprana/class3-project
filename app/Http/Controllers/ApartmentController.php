<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Sponsorship;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('apartment.create');
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

      $newApartment = new Apartment();
      $newApartment->fill($data);
      $newApartment->save();

      return redirect()->back();
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

      return view('apartment.edit', compact('apartment'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
