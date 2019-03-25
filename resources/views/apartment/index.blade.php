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
                <div class="row-eq-height row">
                    @foreach($sponsorships as $apartment_sponsorized)
                        <div class="col-4 mb-4">
                            <div class="card h-100">
                                <a href="{{route('apartment.show', $apartment_sponsorized->id)}}"><img class="card-img-top" src="{{$apartment_sponsorized->image}}" alt="{{$apartment_sponsorized->title}}"></a>
                                <div class="card-body">
                                    <a href="{{route('apartment.show', $apartment_sponsorized->id)}}"> <h3 class="card-title">{{$apartment_sponsorized->title}}</h3></a>
                                    <p class="card-text"> {{$apartment_sponsorized->price}} &euro; per notte</p>
                                    <p>{{$apartment_sponsorized->user->name}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Ed Cards --}}

            </div>
        </div>
    @endisset
  {{-- END Sponsorized Apartments --}}
@endsection