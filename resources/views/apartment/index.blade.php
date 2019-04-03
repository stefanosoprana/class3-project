@extends('layouts.app')
@section('content')
  {{-- Componente Search--}}
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('components.search')
            </div>
        </div>
    </div>
  {{-- End Componente Search--}}

  {{-- Sponsorized Apartments --}}
    @isset($sponsorships)
        <div class="sponsorships mb-5">
            <div class="container">

                {{-- Titolo Evidenza --}}
                <div class="row">
                    <div class="col-12">
                        <h2>In evidenza</h2>
                    </div>
                </div>
                {{-- End Titolo Evidenza --}}

                {{-- Cards --}}
                <div class="row">
                    @foreach($sponsorships as $apartment_sponsorized)
                        <div class="col-lg-4 col-sm-6 mb-4">
                        @component('components.apartment.card', ['apartment' => $apartment_sponsorized])
                        @endcomponent
                        </div>
                    @endforeach
                </div>
                {{-- End Cards --}}

            </div>
        </div>
    @endisset
  {{-- END Sponsorized Apartments --}}
@endsection
