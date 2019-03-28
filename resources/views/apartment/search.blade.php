@extends('layouts.app')
@section('scripts')
  <script src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
@endsection
@section('content')
<div class="container">
  <div class="row">
    <div class="col-8">
      <form class="control">
        <div class="" id="address-complete">
          <div class="form-group">
            <label for="address">Indirizzo</label>
            <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidonia, RM, Italia" autocomplete="off">
          </div>
          <input id="latitude" name="latitude" type="hidden" data-geo="lat">
          <input id="longitude" name="longitude" type="hidden"  data-geo="lng">
        </div>
          <input type="text" id="radius" name="radius" placeholder="Inserisci il raggio in metri">
          <div class="form-check form-check-inline">
            <fieldset id="services">
              <legend>Servizi</legend>
              @foreach($services as $service)
                <input type="checkbox" name="service" value="{{$service->name}}" class="form-check-input">
                <label class="form-check-label" for="{{$service->name}}">{{$service->name}}</label>
              @endforeach
            </fieldset>
          </div>
        <div class="form-group">
        <button id="button-search">Cerca</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
