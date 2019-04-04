@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h1>Tutti gli Utenti</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Cognome</th>
              <th scope="col">E-mail</th>
              <th scope="col">Modifica</th>
              <th scope="col">Elimina</th>
            </tr>
          </thead>
          <tbody>
            @php
            @endphp
            @foreach ($users as $user)
              @if ($user->id !== Auth::user()->id && Auth::user()->can('modify'))
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->lastname }}</td>
                  <td>{{ $user->email }}</td>
                  <td>
                    <a href="{{ route('Admin.users.edit', $user->id) }}" class="btn btn-default"><i class="fas fa-pen" title="Modifica"></i></a>
                  </td>
                  <td>
                    <form action="{{route('Admin.users.destroy', $user->id)}}" method="post" class="btn-trash">
                      @csrf
                      @method('DELETE')
                      <input class="btn-trash__input btn" type="submit" value="Elimina">
                      <i class="fas fa-trash" title="Elimina"></i>
                    </form>
                  </td>
                </tr>
              @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
