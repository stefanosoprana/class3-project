@extends('layouts.app')
@section('scripts')
  <script src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">

      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="" id="search__result">
          <form class="control" @submit.prevent="getFormValues">
            <div id="address-complete">
            <div class="form-group">
              <label for="address">Indirizzo</label>
              <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidonia, RM, Italia" autocomplete="off">
            </div>
              <input id="latitude" name="latitude" type="hidden" data-geo="lat" value="">
              <input id="longitude" name="longitude" type="hidden"  data-geo="lng" value="">
            </div>
            <div class="form-group">
              <label for="radius">Raggio di ricerca</label>
              <input type="number" id="radius" name="radius" placeholder="Inserisci il raggio in metri">
            </div>
            <div class="form-group">
              <label for="beds">Numero minimo di letti</label>
              <input type="number" id="beds" name="beds" placeholder="Inserisci il numero di letti">
            </div>
            <div class="form-group">
              <label for="rooms">Numero minimo di stanze</label>
              <input type="number" id="rooms" name="rooms" placeholder="Inserisci il numero di stanze">
            </div>
            <div class="form-check form-check-inline">
              <fieldset id="services">
                <legend>Servizi</legend>
                @foreach($services as $service)
                  <input type="checkbox" name="service" value="{{$service->name}}" class="form-check-input">
                  <label class="form-check-label" for="{{$service->name}}">{!! $service->icon !!} {{$service->name}}</label>
                @endforeach
              </fieldset>
            </div>
            <div class="form-group">
              <button id="button-search">Cerca</button>
            </div>
          </form>
          <div class="row">
            <div class="col-12">
              <card v-for="card in apartments" v-bind:card="card" :key="card.name"></card>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
