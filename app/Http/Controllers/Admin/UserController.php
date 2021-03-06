<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Apartment;
use App\Message;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
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
      $user = User::find($id);

      if (empty($user)) {
        abort(404);
      };

      return view('admin.users.edit', compact('user'));
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
        $user = User::find($id);
        $email = $user->email;
        $data = $request->all();

        if($data['email'] === $email ){
            unset($data['email']);
        }

        if(!empty($data['password'])){
            $data['password'] =  \Hash::make($data['password']);
        }
        else{
            $data['password'] = $user->password;
        }

        $validated_data = Validator::make($data,[
            'name'=> 'required|string|max:255',
            'lastname'=> 'required|string|max:255',
            'email'=> 'email|unique:users|max:255',
            'password'=> 'nullable|string|min:8',
        ]);

        if ($validated_data->fails()) {
            return redirect()->back()
                ->withErrors($validated_data)
                ->withInput();
        }

        $user->update($data);

        $message = 'Hai modificato l\'utente ' . $user->name;

        return redirect()->route('Admin.users.index')->with('status', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);

      if (empty($user)) {
          abort(404);
      };

      $user->delete();
      $message = 'Utente con 
      Id ' . $id . ' eliminato';
      return redirect()->back()->with('status', $message);
    }
}
