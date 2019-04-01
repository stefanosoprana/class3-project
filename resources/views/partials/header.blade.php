<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
            <img src="{{asset('img/boolbnb-logo.svg')}}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              @auth
                @if (Auth::user()->can('modify'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('Admin.users.index') }}">Tutti gli Utenti</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('Admin.apartments.index') }}">Tutti gli Appartamenti</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('Admin.messages.index')}}">Tutti i Messaggi</a>
                  </li>
                @endif
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('apartments.user.index', Auth::user()->name) }}">Appartamenti</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('messages.index', Auth::user()->id)}}">Messaggi</a>
                </li>
              @endauth
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>


