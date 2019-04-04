@extends('layouts.app')
@section('content')
  <div class="apartments">
    <div class="apartments__main">
      {{--Title--}}
      <div class="apartments__main__title">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <h1>Appartamenti di tutti gli utenti</h1>
            </div>
          </div>
        </div>
      </div>
      {{--/Title--}}
    </div>
    <div class="apartments__main__table mt-5">
      <div class="container">
        <table class="table">
          <thead>
            <tr>
              <th>Dati</th>
              <th>Visualizza</th>
              <th>Modifica</th>
              <th>Elimina</th>
            </tr>
          </thead>
          <tbody>
          @forelse ($apartments as $apartment)
            <tr  class="{{(!$apartment->published) ? 'unpublished' : null}}">
              <td>
                <h2>{{ $apartment->title }}</h2>
                <p>{{ $apartment->street}} {{ $apartment->house_number}}, {{ $apartment->locality}}, {{ $apartment->postal_code}}, {{ $apartment->state }}</p>
                <p>Prezzo: {{ $apartment->price }}€</p>
              </td>
              <td>
                <a href="{{ route('apartment.show', $apartment->id) }}" class="btn btn-default"><i class="fas fa-eye" title="Visualizza"></i></a>
              </td>
              @if($apartment->published)
                <td>
                  <a href="{{ route('apartment.edit', $apartment->id) }}" class="btn btn-default"><i class="fas fa-pen" title="Modifica"></i></a>
                </td>
              @endif
              @if(!$apartment->published)
                <td>
                  <a href="{{ route('Admin.apartment.edit', $apartment->id) }}" class="btn btn-default unpublished"><i class="fas fa-pen" title="Modifica"></i></a>
                </td>
              @endif
              <td>
                <form action="{{route('Admin.apartment.destroy', $apartment->id)}}" method="post" class="btn-trash">
                  @csrf
                  @method('DELETE')
                  <input class="btn-trash__input btn" type="submit" value="Elimina">
                  <i class="fas fa-trash" title="Elimina"></i>
                </form>
              </td>
            </tr>
          @empty
            <h2>Non hai appartamenti</h2>
          @endforelse
          </tbody>
        </table>
        {{ $apartments->links() }}
      </div>
    </div>
@endsection
