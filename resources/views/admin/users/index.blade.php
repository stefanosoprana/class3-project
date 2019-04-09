@extends('layouts.app')
@section('content')
  <div class="users">
    <div class="users__main">
      <div class="users__main__title">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h1>Tutti gli Utenti</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="users__main__content mt-5">
     <div class="container">
      <div class="row">
        <div class="col-12">
          <table class="table">
            <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nome</th>
              <th scope="col">Cognome</th>
              <th scope="col" class="table__td-users">E-mail</th>
              <th scope="col">Modifica</th>
              <th scope="col">Elimina</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($users as $user)
              @if ($user->id !== Auth::user()->id && Auth::user()->can('modify'))
                <tr>
                  <td>{{ $user->id }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->lastname }}</td>
                  <td  class="table__td-users">{{ $user->email }}</td>
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
              @empty
                <tr>
                  <td colspan="6"><h2>Non ci sono utenti</h2></td>
                </tr>
              @endforelse
            </tbody>
          </table>
          {{ $users->links() }}
        </div>
      </div>
    </div>
    </div>
  </div>

@endsection
