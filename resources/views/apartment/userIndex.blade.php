@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>I tuoi appartamenti</h1>
        <a href="{{ route('apartment.create') }}" class="btn btn-primary" style="margin: 10px 0 20px 0;">Aggiungi appartamento</a>
      </div>
    </div>
    {{-- Cards --}}
    <div class="row-eq-height row">
      @forelse ($apartments as $apartment)
        <div class="col-lg-4 col-sm-6 mb-4">
          @component('components.apartment.card', ['apartment' => $apartment])
          @endcomponent
        </div>
      @empty
        <h2>Non hai appartamenti</h2>
      @endforelse
    </div>
    {{-- End Cards --}}
  </div>
@endsection
