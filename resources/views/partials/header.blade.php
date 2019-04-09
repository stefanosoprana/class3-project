<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('img/boolbnb-logo.svg')}}" alt="" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
           <i class="fa fas fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <button class="navbar-close d-block d-md-none
" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <i class="fas fa-times"></i>
            </button>
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              @auth
                @if (Auth::user()->can('modify'))
                  <li class="nav-item authenticated">
                    <a class="nav-link" href="{{ route('Admin.users.index') }}">Tutti gli Utenti</a>
                  </li>
                  <li class="nav-item authenticated">
                    <a class="nav-link" href="{{ route('Admin.apartments.index') }}">Tutti gli Appartamenti</a>
                  </li>
                  <li class="nav-item authenticated">
                    <a class="nav-link" href="{{ route('Admin.messages.index')}}">Tutti i Messaggi</a>
                  </li>
                @endif
                <li class="nav-item authenticated">
                  <a class="nav-link" href="{{ route('apartments.user.index', Auth::user()->name) }}">Appartamenti</a>
                </li>
                <li class="nav-item authenticated">
                  <a class="nav-link" href="{{ route('messages.index', Auth::user()->id)}}">Messaggi</a>
                </li>
              @endauth
                <!-- Authentication Links -->
                @guest
                  @if (Route::has('register'))
                      <li class="nav-item authentication">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Diventa un host') }}</a>
                      </li>
                  @endif
                    <li class="nav-item authentication border-bottom">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{route('profile')}}">Home</a>
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
                  <li class="nav-item d-md-none border-top pt-3"><a href="" class="nav-link">OPPORTUNITÀ DI LAVORO</a></li>
                  <li class="nav-item d-md-none"><a href="" class="nav-link">STAMPA</a></li>
                  <li class="nav-item d-md-none"><a href="" class="nav-link">CONDIZIONI</a></li>
                  <li class="nav-item d-md-none"><a href="" class="nav-link">AIUTO</a></li>
                  <li class="nav-item d-md-none"><a href="" class="nav-link">DIVERSITÀ E APPARTENENZA</a></li>
                  <li class="nav-item d-md-none"><a href="" class="nav-link">INFORMAZIONI DI CONTATTO</a></li>
            </ul>
        </div>
    </div>
</nav>
