@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div v-if="apartments.length">
          <card v-for="card in apartments" v-bind:card="card" :key="card.name"></card>
        </div>
        <div v-else class="text-center"><h1> Non sono presenti appartamenti con queste caratteristiche</h1></div>
      </div>
    </div>
  </div>
@endsection
