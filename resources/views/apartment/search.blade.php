@extends('layouts.app')
@section('scripts')
  <script src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
@endsection
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <card v-for="card in apartments" v-bind:card="card" :key="card.name"></card>
      </div>
    </div>
  </div>
@endsection
