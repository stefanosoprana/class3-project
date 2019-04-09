<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BoolBnb') }}</title>

    <!-- Scripts -->
    @yield('scripts')

    <script src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

@include('partials.header')
@if( Route::currentRouteName() === 'apartments.search')
    {{--container for search vue--}}
    <div class="search form" id="search__result">
        @else
            {{--container without id vue--}}
            <div class="search form">
                @endif
                <div class="search__height">
                    <div class="mt-3">
                        @if( Route::currentRouteName() === 'apartments.search')
                            {{--Search Form--}}
                            <form :class="{ 'needs-validation': formNoValidated, 'was-validated': formValidated }" @submit.prevent="getFormValues" id="search__form" novalidate>
                                @else
                                    {{--Search Form with get action--}}
                                    <form class="control needs-validation" action="{{ route('apartments.search') }}" method="get" id="search__form" novalidate>
                                        @csrf
                                        @method('GET')
                                        @endif
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-7 col-12 d-flex align-items-center justify-content-between">
                                                    <div id="address-complete">
                                                        <div class="form-group">
                                                            <label for="address">Indirizzo</label>
                                                            <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidonia, RM, Italia" autocomplete="off"  v-model="address" required>
                                                        </div>
                                                        <input id="latitude" name="latitude" type="hidden" data-geo="lat" value="">
                                                        <input id="longitude" name="longitude" type="hidden"  data-geo="lng" value="">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="radius">Raggio</label>
                                                        <input type="number" id="radius" name="radius" placeholder="Raggio" v-model="radius" min="1" class="form-control">

                                                    </div>
                                                    <div class="form-group search-number">
                                                        <label for="beds">N. letti</label>
                                                        <input type="number" id="beds" name="beds" placeholder="N. letti" v-model="beds" min="0" class="form-control search-number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="rooms">N. stanze</label>
                                                        <input type="number" id="rooms" name="rooms" placeholder="N. stanze" v-model="rooms" min="0" class="form-control search-number">
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-12 d-flex align-items-center justify-content-center mt-3 mt-lg-0">
                                                    <div class="form-check form-check-inline">
                                                        @foreach($services as $service)
                                                            <div class="checkbox-container form-group">
                                                                <input type="checkbox" name="service" value="{{$service->name}}" class="form-check-input" v-model="services" {{ (isset($data['apartment']) && $data['apartment']->services->firstWhere('id', $service->id) !== null) ? 'checked' : null }}>
                                                                <i class="{{ $service->icon }}" title="{{$service->name}}"></i>
                                                            </div>                                         @endforeach
                                                    </div>
                                                    <div class="form-group">
                                                        <button id="button-search" class="btn btn-primary">Cerca</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                            {{--/Search Form--}}
                    </div>
                    {{--/col-12--}}
                </div>
                {{--/row--}}

                {{--Main--}}
                <main>

                    {{--Status--}}
                    @if(session('status'))
                        <div class="status">
                            <p>{{session('status')}}</p>
                        </div>
                    @endif
                    {{--/Status--}}

                    {{--Content--}}
                    @yield('content')
                    {{--/Content--}}
                </main>
                {{--/Main--}}


            </div>
    {{-- /container for vue or generic--}}

    @include('partials.footer')

</body>
</html>
