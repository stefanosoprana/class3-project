<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @yield('scripts')
    <script src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

        @include('partials.header')

        <div class="row">
            <div class="col-12">
                @if( Route::currentRouteName() === 'apartments.search')
                    {{--container for search vue--}}
                    <div class="search" id="search__result">
                        {{--Search Form--}}
                        <form class="control" @submit.prevent="getFormValues">
                @else
                    {{--container without id vue--}}
                    <div class="search">
                        {{--Search Form with get action--}}
                        <form class="control" action="{{ route('apartments.search') }}" method="get">
                        @csrf
                        @method('GET')
                @endif
                        <div id="address-complete">
                            <div class="form-group">
                                <label for="address">Indirizzo</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidonia, RM, Italia" autocomplete="off"  v-model="address">
                            </div>
                            <input id="latitude" name="latitude" type="hidden" data-geo="lat" value="">
                            <input id="longitude" name="longitude" type="hidden"  data-geo="lng" value="">
                        </div>
                        <div class="form-group">
                            <label for="radius">Raggio di ricerca</label>
                            <input type="number" id="radius" name="radius" placeholder="Inserisci il raggio in metri" v-model="radius">
                        </div>
                        <div class="form-group">
                            <label for="beds">Numero minimo di letti</label>
                            <input type="number" id="beds" name="beds" placeholder="Inserisci il numero di letti" v-model="beds">
                        </div>
                        <div class="form-group">
                            <label for="rooms">Numero minimo di stanze</label>
                            <input type="number" id="rooms" name="rooms" placeholder="Inserisci il numero di stanze" v-model="rooms">
                        </div>
                        <div class="form-check form-check-inline">
                            <fieldset id="services">
                                <legend>Servizi</legend>
                                @foreach($services as $service)
                                    <input type="checkbox" name="service" value="{{$service->name}}" class="form-check-input" v-model="services">
                                    <label class="form-check-label" for="{{$service->name}}">{!! $service->icon !!} {{$service->name}}</label>
                                @endforeach
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <button id="button-search">Cerca</button>
                        </div>
                    </form>
                        {{--/Search Form--}}

                        {{--Main--}}
                        <main class="py-4">
                        @if(session('status'))
                            <div class="alert mt-5">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-12 alert-warning">
                                            {{session('status')}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @yield('content')
                    </main>
                    {{--/Main--}}

                </div>
                {{-- /container for vue or generic--}}
            </div>
            {{--/col-12--}}
        </div>
        {{--/row--}}

        @include('partials.footer')

</body>
</html>
