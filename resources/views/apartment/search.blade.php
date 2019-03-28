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
          <input type="text" id="radius" name="radius" placeholder="radius here">
        <button id="button-search">Cerca</button>
      </form>
    </div>
  </div>
</div>
@endsection
