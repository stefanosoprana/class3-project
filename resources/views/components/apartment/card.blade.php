<div class="h-100 card">
    <div class="card__content {{(!$apartment->published) ? 'unpublished' : null}} {{($apartment->sponsorship && \Illuminate\Support\Carbon::create(\App\Sponsorship::find($apartment->sponsorship)->first()->sponsor_expired)->diffInDays(\Illuminate\Support\Carbon::now(), false) <= 0) ? 'sponsorized' : null}}">
        @if(!empty($med_visits))
        <div class="alert-sponsorship">
            Solo {{$med_visits}} {{($med_visits == 1) ? 'visita' : 'visite'}} al mese
        </div>
        @endif
        <div class="card__header">
            <div class="card__img">
                <a href="{{route('apartment.show', $apartment->id)}}" {{(Route::currentRouteName() === 'apartments.search') ? 'target="_blank"' : null}}  style="background-image: url('{{asset('storage/' . $apartment->image)}}')">
                    <img href="{{asset('storage/' . $apartment->image)}}" alt="{{$apartment->title}}" aria-hidden="false" hidden></a>
            </div>
        </div>
        <div class="card__body">
            <div class="card__super-info">
                {{$apartment->beds}} letti
                <ul class="services">
                    @foreach($apartment->services as $service)
                        <li class="services__item" title="{{$service->name}}"><i class=" {{$service->icon}}"> </i><span>{{$service->name}}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="card__title">
                <a href="{{route('apartment.show', $apartment->id)}}" {{(Route::currentRouteName() === 'apartments.search') ? 'target="_blank"' : null}} ><h2>{{$apartment->title}}</h2></a>
            </div>
            <div class="card__info">
                <p class="card__price"><strong>{{$apartment->price}} € </strong>a persona</p>
                @if(!empty(Auth::user()))
                    @if($apartment->user->id !== Auth::user()->id)
                    <p class="card__user">{{$apartment->user->name}}</p>
                     @endif
                @endif
            </div>
        </div>
    </div>
    {{--Bottoni utente autenticato--}}
        @if(!empty(Auth::user()) && $apartment->user->id === Auth::user()->id && empty($med_visits))
            <div class="card__edit-buttons">
                <div class="">
                    <a href="{{ route('sponsorships.index', $apartment->id) }}" class="btn btn-sponsor"><i class="fas fa-certificate" title="Sponsorizza"></i></a>
                    <a href="{{ route('apartment.show', $apartment->id) }}" class="btn btn-default {{(!$apartment->published) ? 'unpublished' : null}}"><i class="fas fa-eye" title="Visualizza"></i></a>
                    <a href="{{ route('apartment.edit', $apartment->id) }}" class="btn btn-default"><i class="fas fa-pen" title="Modifica"></i></a>
                    <a href="{{ route('apartment.statistic', $apartment->id) }}" class="btn btn-default"><i class="fas fa-chart-bar" title="Statistiche"></i></a>
                    <a href="{{ route('messages.index', $apartment->user->id) }}" class="btn btn-default"><i class="fas fa-envelope" title="Messaggi"></i></a>
                </div>
                <form action="{{route('apartment.destroy', $apartment->id)}}" method="post" class="btn-trash">
                    @csrf
                    @method('DELETE')
                        <input class="btn-trash__input btn" type="submit" value="Elimina">
                            <i class="fas fa-trash" title="Elimina"></i>
                </form>
            </div>
        @endif
        @if(!empty(Auth::user()) && !empty($med_visits))
        <div class="card__edit-buttons justify-content-center">
            <div class="">
                <a href="{{ route('sponsorships.index', $apartment->id) }}" class="btn btn-sponsor"><i class="fas fa-certificate" title="Sponsorizza"></i> Sponsorizzalo ora!</a>
            </div>
        </div>
        @endif
    {{--/Bottoni utente autenticato--}}
</div>
