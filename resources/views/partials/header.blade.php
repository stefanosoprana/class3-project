<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a class="nav-link">
                  <img src="{{ asset('public/boolbnb-logo.svg') }}" alt="">
                 </a>
              </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              @auth
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('apartments.user.index', Auth::user()->name) }}">Appartamenti</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('messages.index', Auth::user()->id)}}">Messaggi</a>
                </li>
                {{-- <li class="nav-item">
                  <a class="nav-link" href="#">Statistiche</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Sponsorizza</a>
                </li> --}}
              @endauth
                <!-- Authentication Links -->
                @guest
                  @if (Route::has('register'))
                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('register') }}">{{ __('Diventa un host') }}</a>
                      </li>
                  @endif

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Accedi') }}</a>
                    </li>

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

<div class="header-bottom">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <form>
          <div class="form-row align-items-center">
            <div class="col-8">
              <label class="sr-only" for="inlineFormInput">Cerca</label>
              <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Cerca: Via Clanio 8 ,Caserta">
            </div>
            <div class="icons">
                <i class="fas fa-wifi"></i>
                <i class="fas fa-snowflake"></i>
                <i class="fas fa-wheelchair"></i>
                <i class="fas fa-utensils"></i>
                <i class="fas fa-swimming-pool"></i>
            </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-primary mb-2">Cerca</button>
          </div>
        </div>
      </form>
      </div>
    </div>


  </div>

</div>
