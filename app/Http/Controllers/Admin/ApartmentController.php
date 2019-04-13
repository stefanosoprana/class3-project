<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Apartment;
use App\Message;
use App\Service;
use App\Sponsorship;
use App\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::paginate(5);
        return view('admin.apartments.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            'route' => route('Admin.apartment.update', $apartment->id),
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
        $data['user_id'] = $apartment->user->id;

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
            'services'=>'nullable|exists:services,name',
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
            $data['image'] = ($apartment->image) ? $apartment->image : null;
        }


        $data['updated_at'] = Carbon::now();

        $apartment->fill($data);
        $apartment->save();

        if(isset($request['services'])){
            $services_all = Service::all();
            $this_services = $services_all->whereIn('name', $request['services'])->pluck('id')->all();
            $apartment->services()->sync($this_services);
        }

        $message = 'Appartamento aggiornato con successo';

        return redirect(route('Admin.apartments.index'))->with('status', $message);
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

        $apartment_title = $apartment->title;
        $messages = $apartment->messages()->get();
        foreach ($messages as $message){
            $message->delete();
        }

        $apartment->delete();

        $message = 'Hai cancellato l\'appartamento ' . $apartment_title;

        return redirect(route('Admin.apartments.index'))->with('status', $message);
    }
}
