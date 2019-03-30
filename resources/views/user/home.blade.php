@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="home__main">
      {{-- TITOLO PAGINA --}}
      <div class="home__main__title">
        <div class="row">
          <div class="col-12">
            <h1>Profilo Utente</h1>
          </div>
        </div>
      </div>
      {{-- ULTIMI APPARTAMENTI --}}
    <div class="home__main__last-apartments">
      <div class="row">
        <div class="col-12">
          <h2>Ultimi Appartamenti</h2>
        </div>
      </div>
      <div class="row">
        @forelse ($apartments as $apartment)
          <div class="col-4 mb-4">
            <div class="card h-100">
              <a href="#"><img class="card-img-top" src="{{asset('storage/' . $apartment->image )}}" alt="{{ $apartment->title }}"></a>
              <div class="card-body">
                <a href="#"><h3 class="card-title">{{ $apartment->title }}</h3></a>
                <p class="card-text"> {{ $apartment->price }}&euro; per notte</p>
                <p>{{ str_limit($apartment->description, 200, ' (...)') }}</p>
              </div>
            </div>
          </div>
        @empty
          <h2>Non ci sono appartamenti</h2>
        @endforelse
      </div>
    </div>
    {{-- ULTIMI MESSAGGI --}}
    <div class="home__main__last-messages">
      <div class="row">
        <div class="col-12">
          <h2>Ultimi messaggi</h2>
        </div>
      </div>
      <div class="row">
        @forelse ($messages as $message)
          <div class="col-sm-3">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">{{ $message->name }}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{ $message->apartment->title }}</h6>
                <p class="card-text">{{ str_limit($message->text, 100, ' (...)') }}</p>
                <h6 class="card-subtitle mb-2 text-muted">{{ DateTime::createFromFormat('Y-m-d H:i:s', $message->created_at )->format('d/m/Y H:i') }}</h6>
              </div>
            </div>
          </div>
        @empty
          <h2>Non hai messaggi</h2>
        @endforelse
      </div>
    </div>
    {{-- APPARTAMENTI SPONSORIZZATI --}}
    <div class="home__main__sponsorized-apartments">
      <div class="row">
        <div class="col-12">
          <h2>Appartamenti sponsorizzati</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">Appartamento</th>
                <th scope="col">Tipo di sponsorizzazione</th>
                <th scope="col">Scade il</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($sponsorships as $apartment_sponsorized)
                <tr>
                  <td>{{ $apartment_sponsorized->apartment->title }}</td>
                  <td>{{ $apartment_sponsorized->sponsorshipsType->name }}</td>
                  <td>{{  DateTime::createFromFormat('Y-m-d H:i:s', $apartment_sponsorized->sponsor_expired )->format('d/m/Y') }}</td>
                </tr>
              @empty
                <h2>Non hai sponsorizzazioni attive</h2>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>      
    </div>
    </div>
  </div>
@endsection
