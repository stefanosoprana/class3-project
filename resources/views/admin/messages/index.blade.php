@extends('layouts.app')
@section('content')
  <div class="messages">
    <div class="messages__main">
      <div class="messages__main__title">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h1>Messaggi Ricevuti</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="messages__main__content mt-5">
    <div class="container">
      <table class="table">
        <thead>
        <tr>
          <th>Appartamento</th>
          <th>Da</th>
          <th>A</th>
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
            <td>{{ $message->user->name }}</td>
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
      {{ $messages->links() }}

    </div>
  </div>

@endsection


