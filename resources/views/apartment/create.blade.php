@extends('layouts.app')
@section('scripts')
    <script src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
@endsection
@section('content')
  <div class="container">
      <div class="row">
          <div class="col-12">
              <h1>Aggiungi nuovo appartamento</h1>
              <form class="form-group" action="{{ $data['route'] }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method($data['method'])
                  <div class="form-group">
                      <label for="title">Nome appartamento</label>
                      <input type="text" name="title" class="form-control" placeholder="Inserisci il nome dell'appartamento">
                  </div>
                  <div class="custom-file mt-3 mb-3">
                      <label for="image" class="custom-file-label">Immagine</label>
                      <input type="file" name="image" id="image" class="custom-file-input">
                  </div>
                  <div class="form-group">
                      <label for="price">Prezzo</label>
                      <input type="number" name="price" placeholder="Inserisci il prezzo dell'appartamento" class="form-control">
                  </div>
                  <h2>Inserisci l'indirizzo completo</h2>
                  <div class="form-group">
                      <label for="address">Indirizzo</label>
                      <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidoina, RM, Italia" autocomplete="off">
                  </div>
                  <h2>Indirizzo</h2>
                  <div class="" id="address-complete">
                      <div class="form-group">
                          <label for="street">Via</label>
                          <input type="text" id="street" name="street" class="form-control" disabled  data-geo="route">
                      </div>
                      <div class="form-group">
                          <label for="house_number">Numero abitazione</label>
                          <input type="number" id="number" name="house_number" class="form-control" disabled  data-geo="street_number">
                      </div>
                      <div class="form-group">
                          <label for="postal_code">Codice postale</label>
                          <input type="number" id="postal_code" name="postal_code" class="form-control" disabled  data-geo="postal_code">
                      </div>
                      <div class="form-group">
                          <label for="state">Stato</label>
                          <input type="text" id="state" name="state"  class="form-control" disabled data-geo="country">
                          <input name="latitude" type="hidden"  disabled data-geo="lat">
                          <input name="longitude" type="hidden"  disabled data-geo="lng">
                      </div>
                  </div>
                  <h2>Caratteristiche</h2>
                  <div class="form-group">
                      <label for="square_meters">Dimensioni</label>
                      <input type="number" name="square_meters" placeholder="Inserisci le dimensioni in metri²" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="rooms">Stanze</label>
                      <input type="number" name="rooms" placeholder="Inserisci il numero di stanze" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="beds">Letti</label>
                    <input type="number" name="beds" placeholder="Inserisci il numero di letti" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="bathrooms">Bagni</label>
                      <input type="number" name="bathrooms" placeholder="Inserisci il numero di bagni" class="form-control">
                  </div>
                      <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                  <div class="form-group">
                      <input type="submit" value="Salva Nuovo appartamento" class="form-control">
                  </div>
              </form>
          </div>
      </div>
  </div>
@endsection
