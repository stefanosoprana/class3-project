@extends('layouts.app')
@section('content')
  <div class="container">
      <div class="row">
          <div class="col-12">
              <h1>Modifica {{ $apartment->title }}</h1>
              <form class="form-group" action="{{ route('apartment.store') }}" method="post">
                  @csrf
                  <div class="form-group">
                      <label for="title">Titolo</label>
                      <input type="text" name="title" class="form-control" placeholder="Inserisci il nome dell'appartamento" value="{{ $apartment->title }}">
                  </div>
                  <div class="form-group">
                      <label for="image">Immagine</label>
                      <input type="text" name="image" placeholder="Inserisci il path dell'immagine" class="form-control" value="{{ $apartment->image }}">
                  </div>
                  <div class="form-group">
                      <label for="price">Prezzo</label>
                      <input type="number" name="price" placeholder="Inserisci il prezzo dell'appartamento" class="form-control" value="{{ $apartment->price }}">
                  </div>
                  <h2>Indirizzo</h2>
                  <div class="form-group">
                      <label for="street">Via</label>
                      <input type="text" name="street" class="form-control" placeholder="Inserisci la via" value="{{ $apartment->street }}">
                  </div>
                  <div class="form-group">
                      <label for="house_number">Numero abitazione</label>
                      <input type="number" name="house_number" placeholder="Inserisci il numero civico" class="form-control" value="{{ $apartment->house_number }}">
                  </div>
                  <div class="form-group">
                      <label for="postal_code">Codice postale</label>
                      <input type="number" name="postal_code" placeholder="Inserisci il codice postale" class="form-control" value="{{ $apartment->postal_code }}">
                  </div>
                  <div class="form-group">
                      <label for="state">Stato</label>
                      <input type="text" name="state" placeholder="Inserisci lo stato" class="form-control" value="{{ $apartment->state }}">
                  </div>
                  <h2>Caratteristiche</h2>
                  <div class="form-group">
                      <label for="square_meters">Dimensioni</label>
                      <input type="number" name="square_meters" placeholder="Inserisci le dimensioni in metri²" class="form-control" value="{{ $apartment->square_meters }}">
                  </div>
                  <div class="form-group">
                      <label for="rooms">Stanze</label>
                      <input type="number" name="rooms" placeholder="Inserisci il numero di stanze" class="form-control" value="{{ $apartment->rooms }}">
                  </div>
                  <div class="form-group">
                    <label for="beds">Letti</label>
                    <input type="number" name="beds" placeholder="Inserisci il numero di letti" class="form-control" value="{{ $apartment->beds }}">
                  </div>
                  <div class="form-group">
                      <label for="bathrooms">Bagni</label>
                      <input type="number" name="bathrooms" placeholder="Inserisci il numero di bagni" class="form-control" value="{{ $apartment->bathrooms }}">
                  </div>
                      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                  <div class="form-group">
                      <input type="submit" value="Modifica l'appartamento" class="form-control">
                  </div>
              </form>
          </div>
      </div>
  </div>
@endsection
