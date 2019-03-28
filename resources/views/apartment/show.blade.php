@extends('layouts.app')
@section('content')
  <div class="apartment">

    <div class="apartment__header" style="background-image: url('{{asset('storage/' . $apartment->image)}}');">
      <img hidden src="{{ $apartment->image }}">
      <h1>{{ $apartment->title }}</h1>
    </div>
    <div class="apartment__main">
      <div class="container">

        {{--modifica--}}
        @if(isset(Auth::user()->id) && ($apartment->user_id === Auth::user()->id || Auth::user()->hasRole('admin')))
        <div class="row">
          <div class="col-12">
            <div class="alert-info p-3 text-center">
                <a href="{{ route('apartment.edit', $apartment->id) }}" class="btn btn-primary">Modifica</a>
              <a href="{{ route('apartment.statistic', $apartment->id) }}" class="btn btn-primary">Visualizza statistiche</a>
            </div>
          </div>
        </div>
        @endif
        {{--/modifica--}}

        {{--scheda--}}

        {{--intestazione--}}
        <div class="row">
          <div class="col-8">
            <h2 class="apartment__heading">Descrizione</h2>
          </div>
          <div class="col-4">
            <div class="apartment__main__price">
              <p><strong>Prezzo:</strong> <span>{{ $apartment->price }} €</span> a notte</p>
            </div>
          </div>
        </div>
        {{--/intestazione--}}

        <div class="row">
          {{--Descrizione--}}
          <div class="col-8">
            <div class="apartment__main__description">
              {{ $apartment->description }}
            </div>
            <div class="apartment__main__address">
              <h3>Indirizzo</h3>
              <p>{{ $apartment->street }} {{ $apartment->house_number }}, {{ $apartment->locality }}, {{ $apartment->postal_code }}, {{ $apartment->state }}</p>
            </div>
          </div>
          {{--Descrizione--}}

          {{--caratteristiche--}}
          <div class="col-4">
            <h3>Caratteristiche</h3>
            <ul>
              <li><b>Camere:</b> {{ $apartment->rooms }}</li>
              <li><b>Letti:</b> {{ $apartment->beds }}</li>
              <li><b>Bagni:</b> {{ $apartment->bathrooms }}</li>
              <li><b>Dimensioni:</b> {{ $apartment->square_meters }} mq</li>
            </ul>
            <h3>Servizi</h3>
            <ul class="services">
              @foreach($apartment->services as $service)
                <li class="services_item">{!! $service->icon !!} {{$service->name}}</li>
              @endforeach
            </ul>
          </div>
          {{--/caratteristiche--}}
        </div>
        {{--/scheda--}}

        <div class="row">
          <div class="col-6">
            {{--mappa--}}
            <div class="apartment__main__map">
              {!! Mapper::render() !!}
            </div>
            {{--/mappa--}}
          </div>
          <div class="col-6">
            {{--messaggio--}}
            <div class="apartment__main__message">
              <h3>Scrivi al proprietario</h3>
              <form class="form-group" action="{{ route('apartment.message.store') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="name">Nome</label>
                  <input type="text" name="name" class="form-control" placeholder="Inserisci il nome">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Inserisci la email">
                </div>
                <div class="form-group">
                  <label for="text">Testo</label>
                  <textarea class="form-control" name="text" rows="3" placeholder="Inserisci il testo"></textarea>
                </div>
                <input type="hidden" name="user_id" value="{{ $apartment->user_id }}">
                <input type="hidden" name="apartment_id" value="{{ $apartment->id }}">
                <div class="form-group">
                  <input type="submit" value="Invia" class="form-control">
                </div>
              </form>
            </div>
            {{--/messaggio--}}

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
