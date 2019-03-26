@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>I tuoi appartamenti</h1>
        <a href="{{ route('apartment.create') }}" class="btn btn-primary" style="margin: 10px 0 20px 0;">Aggiungi appartamento</a>
      </div>
    </div>
    <table class="table">
      <tbody>
        @forelse ($apartments as $apartment)
          <tr>
            <td>
              <img src="{{asset('storage/' . $apartment->image)}}" alt="{{ $apartment->title }}">
            </td>
            <td>
              <h3>{{ $apartment->title }}</h3>
              <h5>{{ $apartment->street}} {{ $apartment->house_number}}, {{ $apartment->postal_code}}, {{ $apartment->state }}</h5>
              <h5>Caratteristiche</h5>
              <ul>
                <li>Dimensioni: {{ $apartment->square_meters}}m²</li>
                <li>N° stanze: {{ $apartment->rooms}}</li>
                <li>N° letti: {{ $apartment->beds}}</li>
                <li>N° bagni: {{ $apartment->bathrooms}}</li>
              </ul>
              <h4>Prezzo: {{ $apartment->price }}€</h4>
            </td>
            <td>
              <a href="{{ route('apartment.edit', $apartment->id) }}" class="btn btn-primary">Modifica</a>
            </td>
            <td>
              <a href="#" class="btn btn-danger">Elimina</a>
            </td>
          </tr>
        @empty
          <h2>Non hai appartamenti</h2>
        @endforelse
      </tbody>
    </table>

  </div>
@endsection
