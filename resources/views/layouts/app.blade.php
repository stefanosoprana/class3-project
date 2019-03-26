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
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

    <div id="app">
        @include('partials.header')
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
        @include('partials.footer')
    </div>
</body>
</html>
