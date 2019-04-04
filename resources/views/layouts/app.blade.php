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
    <div class="search" id="search__result">
        @else
            {{--container without id vue--}}
            <div class="search form">
                @endif
                <div class="row">
                    <div class="col-12">
                        @if( Route::currentRouteName() === 'apartments.search')
                            {{--Search Form--}}
                            <form  class="control needs-validation" @submit.prevent="getFormValues" id="search__form" novalidate>
                                @else
                                    {{--Search Form with get action--}}
                                    <form class="control needs-validation" action="{{ route('apartments.search') }}" method="get" id="search__form" novalidate>
                                        @csrf
                                        @method('GET')
                                        @endif



                                        <div id="address-complete" >
                                            <div class="form-group col-3 search">
                                                <label for="address">Indirizzo</label>
                                                <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidonia, RM, Italia" autocomplete="off"  v-model="address" required>
                                            </div>
                                            <input id="latitude" name="latitude" type="hidden" data-geo="lat" value="">
                                            <input id="longitude" name="longitude" type="hidden"  data-geo="lng" value="">
                                        </div>
                                        <div class="form-group search">
                                            <label for="radius">Raggio di ricerca</label>
                                            <input type="number" id="radius" name="radius" placeholder="Inserisci il raggio in metri" v-model="radius" min="1" class="form-control">

                                        </div>
                                        <div class="form-group search">
                                            <label for="beds">Numero minimo di letti</label>
                                            <input type="number" id="beds" name="beds" placeholder="Inserisci il numero di letti" v-model="beds" min="0" class="form-control">
                                        </div>
                                        <div class="form-group search">
                                            <label for="rooms">Numero minimo di stanze</label>
                                            <input type="number" id="rooms" name="rooms" placeholder="Inserisci il numero di stanze" v-model="rooms" min="0" class="form-control">
                                        </div>
                                        <div class="form-check">
                                                <legend>Servizi</legend>
                                                @foreach($services as $service)
                                                    <div class="checkbox-container">
                                                        <input type="checkbox" name="services[]" value="{{$service->name}}"  {{ (isset($data['apartment']) && $data['apartment']->services->firstWhere('id', $service->id) !== null) ? 'checked' : null }}>
                                                        <i class="{{ $service->icon }}" title="{{$service->name}}"></i>
                                                    </div>
                                                @endforeach
                                        </div>

                                    </form>
                            {{--/Search Form--}}
                    </div>
                    {{--/col-12--}}
                </div>
                {{--/row--}}

                {{--Main--}}
                <main class="py-4">
                    {{--Status--}}
                    {{-- @if(session('status'))
                      <div class="status">
                        <div class="row">
                          <div class="col-12">
                            <div class="alert mt-5">
                              <div class="container">
                                <div class="row">
                                  <div class="col-12 alert-warning">
                                    {{session('status')}}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif --}}
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
