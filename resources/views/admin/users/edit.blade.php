@extends('layouts.app')
@section('content')
  <div class="users">
    <div class="users__main">
      <div class="users__main__title">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h1>Modifica l'utente</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="users__main__create mt-5">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <form class="form-group needs-validation" action="{{ route('Admin.users.update', $user->id) }}" method="post" novalidate>
              @method('PUT')
              @csrf
              <div class="form-group">
                @if($errors->has('name'))
                  <div class="alert alert-danger">
                    <p>{{$errors->first('name')}}</p>
                  </div>
                @endif
                <label for="name">Nome</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                <div class="valid-feedback">
                  Campo valido
                </div>
                <div class="invalid-feedback">
                  Scrivi il nome.
                </div>
              </div>
              <div class="form-group">
                @if($errors->has('lastname'))
                  <div class="alert alert-danger">
                    <p>{{$errors->first('lastname')}}</p>
                  </div>
                @endif
                <label for="lastname">Cognome</label>
                <input type="text" name="lastname" class="form-control" value="{{ $user->lastname }}">
                <div class="valid-feedback">
                  Campo valido
                </div>
                <div class="invalid-feedback">
                  Scrivi il cognome.
                </div>
              </div>
              <div class="form-group">
                @if($errors->has('email'))
                  <div class="alert alert-danger">
                    <p>{{$errors->first('email')}}</p>
                  </div>
                @endif
                <label for="email">Email</label>
                <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                <div class="valid-feedback">
                  Campo valido
                </div>
                <div class="invalid-feedback">
                  Scrivi una password valida.
                </div>
              </div>
              <div class="form-group">
                @if($errors->has('password'))
                  <div class="alert alert-danger">
                    <p>{{$errors->first('password')}}</p>
                  </div>
                @endif
                <label for="email">Password</label>
                <input type="password" name="password" placeholder="{{$errors->has('password') ? $errors->first('password') : 'Inserisci la nuova password'}}" class="form-control" value="">
              </div>
              <div class="form-group">
                <input type="submit" value="Modifica Utente" class="form-control">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
