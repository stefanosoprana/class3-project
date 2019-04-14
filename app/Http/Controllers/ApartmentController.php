<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Message;
use App\Service;
use App\Sponsorship;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mapper;

class ApartmentController extends Controller
{

    private $validation;

    public function __construct()
    {
        $this->validation = [
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
            'services'=>'nullable|exists:services,name',
        ];
    }
    // CONTROLLER GUEST

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsorships = Apartment::AllActiveSponsorhips()->get();

        return view('apartment.index', compact('sponsorships'));
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
        $apartments = Apartment::where('user_id', $user)->orderBy('created_at', 'DESC')->get();
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
            'title' => 'Inserisci un appartamento',
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

        $validated_data = Validator::make($data, $this->validation);

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

        if(isset($request['services'])){
            $services_all = Service::all();
            $this_services = $services_all->whereIn('name', $request['services'])->pluck('id')->all();
            $newApartment->services()->sync($this_services);
        }

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

        $validated_data = Validator::make($data, $this->validation);

        if ($validated_data->fails()) {
            return redirect()->back()
                ->withErrors($validated_data)
                ->withInput();
        }

        if(!empty($request['image'])){
            $delete = Storage::disk('public')->delete($apartment->image);
            $image = Storage::disk('public')->put('apartment_image', $request['image']);
            $data['image'] = $image;
        } else if ($apartment->image){
            unset( $data['image']);
        }

        $apartment->fill($data);
        $apartment->save();

        if(isset($request['services'])){
            $services_all = Service::all();
            $this_services = $services_all->whereIn('name', $request['services'])->pluck('id')->all();
            $apartment->services()->sync($this_services);
        }

        $message = 'Appartamento aggiornato con successo';

        return redirect(route('apartment.show', $apartment->id))->with('status', $message);
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

        if (empty($apartment)) {
            abort(404);
        };

        $user = $apartment->user_id;
        $apartment_title = $apartment->title;

        $messages = $apartment->messages;
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
    public function statistics(Apartment $apartment)
    {
        if (empty($apartment)) {
            abort(404);
        };

        if(Auth::user()->id !== $apartment->user_id && !Auth::user()->hasRole('admin')){
            abort(404);
        }

        $visits = Visit::get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y');
        })->toArray();

        $messages = Message::get()->groupBy(function ($val) {
            return Carbon::parse($val->created_at)->format('Y');
        })->toArray();

        $years = array_unique(array_merge(array_keys($visits), array_keys($messages)), SORT_REGULAR);

        $data = [
            'apartment' => $apartment,
            'years' => $years
        ];

        return view('apartment.statistics', $data);
    }

    /**
     *
     * View Search
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function search(Request $request){
        $data = $request->all();
        return view('apartment.search', compact('data'));
    }
}
