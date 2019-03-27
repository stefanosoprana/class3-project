@extends('layouts.app')
@section('content')
    <div class="container message">
        <div class="row">
            <div class="col-12">
                <h1 class="message__heading">Messaggio per l'appartamento:</h1>
                <h2 class="message__h2">{{ $message->apartment->title }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
              <p class="message__info">Ricevuto il: {{ DateTime::createFromFormat('Y-m-d H:i:s', $message->created_at )->format('d/m/Y  H:i') }} - Da: {{ $message->name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="message__h3">Testo del messaggio</h3>
                <div class="message__text">
                  <p>{{ $message->text }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h3 class="message__h3">Rispondi a</h3>
                <a href="mailto:{{$message->email}}?subject= Contatto da BoolBnB - Appartamento {{$message->apartment->title}}&body= Gentile {{$message->name}},">{{ $message->email }}</a>
            </div>
        </div>
        <div class="row">
          <div class="col-2 offset-8">
              <a href="{{ route('messages.index', $message->user->id ) }}" class="btn btn-primary">Torna ai messaggi</a>
          </div>
          <div class="col-2">
            <form action="{{ route('message.destroy', $message->id ) }}" method="post">
              @csrf
              @method('DELETE')
              <input class="btn btn-danger" type="submit" value="Elimina">
            </form>
          </div>
        </div>
    </div>
@endsection
