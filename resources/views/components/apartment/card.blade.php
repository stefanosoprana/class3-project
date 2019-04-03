<div class="h-100 card">
    <div class="card__content {{(!$apartment->published) ? 'unpublished' : null}} {{($apartment->sponsorship && \Illuminate\Support\Carbon::create(\App\Sponsorship::find($apartment->sponsorship)->first()->sponsor_expired)->diffInDays(\Illuminate\Support\Carbon::now(), false) <= 0) ? 'sponsorized' : null}}">
        <div class="card__header">
            <div class="card__img">
                <a href="{{route('apartment.show', $apartment->id)}}"  style="background-image: url('{{asset('storage/' . $apartment->image)}}')">
                    <img href="{{asset('storage/' . $apartment->image)}}" alt="{{$apartment->title}}" aria-hidden="false" hidden></a>
            </div>
        </div>
        <div class="card__body">
            <div class="card__super-info">
                {{$apartment->beds}} letti
                <ul class="services">
                    @foreach($apartment->services as $service)
                        <li class="services__item" title="{{$service->name}}">{!! $service->icon !!} <span>{{$service->name}}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="card__title">
                <a href="{{route('apartment.show', $apartment->id)}}" target="_blank"><h2>{{$apartment->title}}</h2></a>
            </div>
            <div class="card__info">
                <p class="card__price"><strong>{{$apartment->price}} € </strong>a persona</p>
                @if($apartment->user->id !== Auth::user()->id)
                    <p class="card__user">{{$apartment->user->name}}</p>
                @endif
            </div>
        </div>
    </div>
    {{--Bottoni utente autenticato--}}
    @if($apartment->user->id === Auth::user()->id)
        <div class="card__edit-buttons">
            <a href="{{ route('apartment.show', $apartment->id) }}" class="btn btn-info">Visualizza</a>
            <a href="{{ route('sponsorships.index', $apartment->id) }}" class="btn btn-primary">Sponsorizza</a>
            <a href="{{ route('apartment.edit', $apartment->id) }}" class="btn btn-primary">Modifica</a>
            <form action="{{route('apartment.destroy', $apartment->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Elimina</button>
            </form>
        </div>
    @endif
    {{--/Bottoni utente autenticato--}}
</div>