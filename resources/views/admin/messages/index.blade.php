@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Messaggi Ricevuti</h1>
      </div>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Appartamento</th>
          <th>Da</th>
          <th>A</th>
          <th>Messaggio</th>
          <th>Data</th>
          <th>Visualizza</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($messages as $message)
          <tr>
            <td>{{ $message->apartment->title }}</td>
            <td>{{ $message->name }}</td>
            <td>{{ $message->user->name }}</td>
            <td>{{ str_limit($message->text, 30, '(...)') }}</td>
            <td>{{ DateTime::createFromFormat('Y-m-d H:i:s', $message->created_at )->format('d/m/Y H:i') }}</td>
            <td>
              <a href="{{ route('Admin.messages.show', $message->id ) }}" class="btn btn-primary">Leggi</a>
            </td>
          </tr>
        @empty
          <h2>non ci sono post</h2>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
