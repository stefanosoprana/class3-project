@extends('layouts.app')
@section('content')
  <div class="messages">
    <div class="messages__main">
      {{--Title--}}
      <div class="messages__main__title">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h1>MESSAGGI</h1>
            </div>
          </div>
        </div>
      </div>
      {{--/Title--}}
      <div class="messages__main__table">
        <div class="container">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>Nome Mittente</th>
              <th>Appartamento</th>
              <th>Data</th>
              <th>Messaggio</th>
              <th></th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($messages as $message)
              <tr>
                <td>{{ $message->name }}</td>
                <td>{{ $message->apartment->title }}</td>
                <td>{{ DateTime::createFromFormat('Y-m-d H:i:s', $message->created_at )->format('d/m/Y H:i') }}</td>
                <td>{{ str_limit($message->text, 30, '(...)') }}</td>
                <td>
                  <a href="{{ route('Admin.messages.show', $message->id ) }}" class="btn btn-default"><i class="fas fa-eye" title="Leggi"></i></a>
                </td>
                <td>
                  <form action="{{ route('message.destroy', $message->id ) }}" method="post" class="btn-trash">
                    @csrf
                    @method('DELETE')
                    <input class="btn-trash__input btn" type="submit" value="E">
                      <i class="fas fa-trash"></i>
                  </form>
                </td>
              </tr>
            @empty
              <h2>non ci sono post</h2>
            @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
