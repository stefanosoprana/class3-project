@extends('layouts.app')
@section('content')
    <div class="apartments">
        <div class="apartments__main">
            {{--Title--}}
            <div class="apartments__main__title">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>I tuoi appartamenti</h1>
                        </div>
                    </div>
                </div>
            </div>
            {{--/Title--}}
            {{-- Button aggiungi appartamento --}}
            <div class="apartments__main__button">
              <div class="row">
                  <div class="col-4 offset-8">
                      <a href="{{ route('apartment.create') }}" class="btn btn-default"><i class="fas fa-plus"></i>AGGIUNGI UN APPARTAMENTO</a>
                  </div>
              </div>
            </div>
            {{-- /Button aggiungi appartamento --}}
            <div class="apartments__main__content mt-5">
                <div class="container">
                    {{-- Cards --}}
                    <div class="row">
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
            </div>
        </div>
    </div>
@endsection
