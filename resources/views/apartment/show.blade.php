@extends('layouts.app')
@section('content')

  <div class="apartment_header" style="background-image: url('{{ $apartment->image }}');">
    <h1>{{ $apartment->title }}</h1>
    {{--Inserire immagine e nascondere con css--}}
  </div>
  <div class="apartment_main">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>Descrizione</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-8">
          <div class="apartment_main_description">
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
    </div>
  </div>
@endsection
