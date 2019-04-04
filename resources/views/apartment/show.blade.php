@extends('layouts.app')
@section('content')
  <div class="apartment">

    <div class="apartment__header" style="background-image: url('{{asset('storage/' . $apartment->image)}}');">
      <img hidden src="{{ $apartment->image }}">
      <div class="apartment__header__title">
        <div class="container">
          <h1 class="col-8">{{ $apartment->title }}</h1>
        </div>
      </div>
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

        <div class="row">
          <div class="col-8">
            <div class="container">
              <div class="row">
                {{--descrizione--}}
                <div class="col-12">
                  <div class="apartment__main__description">
                    <h3>Descrizione</h3>
                    <p>{{ $apartment->description }}</p>
                  </div>
                  <div class="apartment__main__address">
                  </div>
                  <h3>Indirizzo</h3>
                  <p>{{ $apartment->street }} {{ $apartment->house_number }}, {{ $apartment->locality }}, {{ $apartment->postal_code }}, {{ $apartment->state }}</p>
                </div>
                {{--/descrizione--}}
                {{--mappa--}}
                <div class="col-12">
                  <div class="apartment__main__map">
                    {!! Mapper::render() !!}
                  </div>
                </div>
                {{--/mappa--}}
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="container">
              <div class="row">
                {{--caratteristiche--}}
                <div class="col-12">
                  <div class="apartment__main__price">
                    <h2>{{ $apartment->price }}€ a persona</h2>
                  </div>
                  <div class="apartment__main__specific">
                    <h3>Caratteristiche</h3>
                    <ul>
                      <li>Camere: {{ $apartment->rooms }}</li>
                      <li>Letti: {{ $apartment->beds }}</li>
                      <li>Bagni: {{ $apartment->bathrooms }}</li>
                      <li>Dimensioni: {{ $apartment->square_meters }} mq</li>
                    </ul>
                    <h3>Servizi</h3>
                    <ul class="services">
                      @foreach($apartment->services as $service)
                        <li class="services_item"><i class="{{$service->icon}}"></i> {{$service->name}}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                {{--/caratteristiche--}}
                {{--messaggio--}}
                <div class="col-12">
                  @component('components.message.form',['apartment' => $apartment])
                  @endcomponent
                </div>
                {{--/messaggio--}}
              </div>
            </div>
          </div>
        </div>
        {{--/scheda--}}
      </div>
    </div>
  </div>
@endsection
