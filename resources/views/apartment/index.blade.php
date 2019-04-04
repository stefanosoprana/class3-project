@extends('layouts.app')
@section('content')
  {{-- Sponsorized Apartments --}}
    @isset($sponsorships)
        <div class="sponsorships">
            <div class="sponsorships___main">
                <div class="sponsorships__main__title">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h1>In evidenza</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sponsorships__main__content mt-5">
                    <div class="container">
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
            </div>
        </div>
    @endisset
  {{-- END Sponsorized Apartments --}}
@endsection
