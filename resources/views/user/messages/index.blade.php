@extends('layouts.app')
@section('content')

  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Nome utente</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <h1>I tuoi messaggi</h1>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Appartamento</th>
          <th>Nome</th>
          <th>Messaggio</th>
          <th>Data</th>
          <th>Visualizza</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($messages as $message)
          <tr>
            <td>{{ $message->apartment->title }}</td>
            <td>{{ $message->user->name }}</td>
            <td>{{ str_limit($message->text, 30, '(...)') }}</td>
            <td>{{ DateTime::createFromFormat('Y-m-d H:i:s', $message->date )->format('d/m/Y H:i') }}</td>
            <td>
              <a href="{{ route('message.show', $message->id ) }}" class="btn btn-primary">View</a>
            </td>
          </tr>
        @empty
          <h2>non ci sono post</h2>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
