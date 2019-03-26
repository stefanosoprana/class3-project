@extends('layouts.app')
@section('content')
  <div class="apartment">
    <div class="apartment__header" style="background-image: url('{{ $apartment->image }}');">
      <img hidden src="{{ $apartment->image }}">
      <h1>{{ $apartment->title }}</h1>
    </div>
      <div class="apartment__main">
        <div class="container">
        <div class="row">
          <div class="col-12">
            <h2>Descrizione</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="apartment__main__description">
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
              <h2>Prezzo: <b>{{ $apartment->price }}€</b></h2>
            </div>
          </div>
          <div class="col-4">
            <h3>Indirizzo</h3>
            <p>{{ $apartment->street }} {{ $apartment->house_number }}, {{ $apartment->postal_code }}, {{ $apartment->state }}</p>
            <h3>Caratteristiche</h3>
            <ul>
              <li><b>Camere:</b> {{ $apartment->rooms }}</li>
              <li><b>Letti:</b> {{ $apartment->beds }}</li>
              <li><b>Bagni:</b> {{ $apartment->bathrooms }}</li>
              <li><b>Dimensioni:</b> {{ $apartment->square_meters }}m²</li>
            </ul>
          </div>
        </div>
      <div class="row">
        <div class="col-6">
          <div class="apartment__main__map">
            {!! Mapper::render() !!}
          </div>
      </div>
      <div class="col-6">
        <div class="apartment__main__message">
          <h3>Scrivi al proprietario</h3>
          <form class="form-group" action="{{ route('apartment.message.store') }}" method="post">
              @csrf
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" name="name" class="form-control" placeholder="Inserisci il nome">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Inserisci la email">
            </div>
            <div class="form-group">
              <label for="text">Testo</label>
              <textarea class="form-control" name="text" rows="3" placeholder="Inserisci il testo"></textarea>
            </div>
            <input type="hidden" name="user_id" value="{{ $apartment->user_id }}">
            <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
            <div class="form-group">
                <input type="submit" value="Invia" class="form-control">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

    </div>

  </div>
@endsection
