@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Modifica l'utente</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <form class="form-group" action="{{ route('Admin.users.update', $user->id) }}" method="post">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="name">Nome</label>
            <input type="text" name="name" class="form-control" placeholder="Inserisci il nome" value="{{ $user->name }}">
          </div>
          <div class="form-group">
            <label for="lastname">Cognome</label>
            <input type="text" name="lastname" class="form-control" placeholder="Inserisci il cognome" value="{{ $user->lastname }}">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" placeholder="Inserisci l'Email" class="form-control" value="{{ $user->email }}">
          </div>
          <div class="form-group">
            <input type="submit" value="Modifica Utente" class="form-control">
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
