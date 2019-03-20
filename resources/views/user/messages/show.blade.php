@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
              <h1>{{ $message->user->name }} è interessato al tuo appartamento</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
              <h2>{{ $message->apartment->title }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
              <h3>{{ DateTime::createFromFormat('Y-m-d H:i:s', $message->date )->format('d/m/Y  H:i') }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
              <p>{{ $message->text }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
              <h3>Rispondi a {{ $message->email }}</h3>
            </div>
        </div>
        <div class="row">
          <div class="col-2 offset-8">
            <div class="btn btn-primary">
              <a href="{{ route('messages.index', 1 ) }}" style="color:white;">Torna alla Homepage</a>
            </div>
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
