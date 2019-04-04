@extends('layouts.app')
@section('content')
  <div class="message__title">
    <div class="container">
      <div class="row">
        <div class="col-8">
          <h1>MESSAGGI</h1>
        </div>
      </div>
    </div>
  </div>
    <div class="container message">
        <div class="row">
            <div class="col-8">
                <h2 class="message__heading">Messaggio per: <span>{{ $message->apartment->title }}</span></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
              <p class="message__info">Ricevuto il: {{ DateTime::createFromFormat('Y-m-d H:i:s', $message->created_at )->format('d/m/Y  H:i') }} <br> da <b>{{ $message->name }}</b></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="message__text">
                  <p>{{ $message->text }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <h3 class="message__h3">Rispondi a: </h3>
                <a href="mailto:{{$message->email}}?subject= Contatto da BoolBnB - Appartamento {{$message->apartment->title}}&body= Gentile {{$message->name}},">{{ $message->email }}</a>
            </div>
        </div>
        <div class="row">
          <div class="col-2 offset-6">
              <a href="{{ route('Admin.messages.index', $message->user->id ) }}" class="btn btn-default"><i class="fas fa-envelope"></i></a>
            <form action="{{ route('message.destroy', $message->id ) }}" method="post" class="btn-trash">
              @csrf
              @method('DELETE')
              <input class="btn-trash__input btn" type="submit" value="Elimina">
              <i class="fas fa-trash" title="Elimina"></i>
            </form>
          </div>
          </div>
    </div>
@endsection
