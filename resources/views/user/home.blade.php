@extends('layouts.app')

@section('content')
    <div class="home">
        <div class="home__main">
            {{-- TITOLO PAGINA --}}
            <div class="home__main__title">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>Profilo Utente</h1>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ULTIMI MESSAGGI --}}
            <div class="home__main__last-messages">
                <div class="container">
                    <div class="row">
                        <div class="col-8 d-flex align-items-center">
                            <h2 class="title-blue">Ultimi messaggi</h2>
                        </div>
                        <div class="col-4 text-right d-flex justify-content-end align-items-center">
                            <a href="{{route('messages.index', Auth::user()->id)}}" class="btn btn-default"><i class="fas fa-envelope" title="message"></i> Tutti i messaggi</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Appartamento</th>
                                    <th>Da</th>
                                    <th class="table__td-message">Messaggio</th>
                                    <th>Data</th>
                                    <th>Leggi</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($messages as $message)
                                    <tr>
                                        <td>{{ $message->apartment->title }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td class="table__td-message">{{ str_limit($message->text, 30, '(...)') }}</td>
                                        <td>{{ DateTime::createFromFormat('Y-m-d H:i:s', $message->created_at )->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('Admin.messages.show', $message->id) }}" class="btn btn-default"><i class="fas fa-eye"title="Leggi"></i></a>            </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6"><h2>Non ci sono messaggi</h2></td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /ULTIMI MESSAGGI --}}
            {{-- ULTIMI APPARTAMENTI --}}
            <div class="home__main__last-apartments mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-8 d-flex align-items-center">
                            <h2 class="title-blue">Ultimi Appartamenti</h2>
                        </div>
                        <div class="col-4 text-right d-flex justify-content-end align-items-center">
                            <a href="{{route('apartments.index', Auth::user()->id)}}" class="btn btn-default"><i class="fas fa-home" title="home"></i> Tutti gli appartamenti</a>
                        </div>
                    </div>
                        {{-- Cards --}}
                        <div class="row">
                            @foreach($apartments as $apartment)
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    @component('components.apartment.card', ['apartment' => $apartment])
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                        {{-- End Cards --}}
                </div>


                {{-- APPARTAMENTI SPONSORIZZATI --}}
                <div class="home__main__sponsorized-apartments">
                    <div class="container">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <h2 class="title-blue">Appartamenti sponsorizzati</h2>
                            </div>
                            <div class="col-4 text-right d-flex justify-content-end align-items-center">
                                <a href="{{route('apartments.index', Auth::user()->id)}}" class="btn btn-default"><i class="fas fa-home" title="home"></i> Tutti gli appartamenti</a>
                            </div>
                        </div>
                        {{-- Cards --}}
                        <div class="row">
                            @forelse($sponsorships as $apartment_sponsorized)
                                <div class="col-lg-4 col-sm-6 mb-4">
                                    @component('components.apartment.card', ['apartment' => $apartment_sponsorized])
                                    @endcomponent
                                </div>
                            @endforeach
                        </div>
                        {{-- End Cards --}}
                    </div>
                </div>
            </div>
        </div>
@endsection
