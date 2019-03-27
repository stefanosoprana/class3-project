@extends('layouts.app')
@section('scripts')
    <script src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
@endsection
@section('content')
    @isset($data)
        <div class="container apartment__create">
            <div class="row">
                <div class="col-12">
                    <h1>{{$data['title']}}</h1>
                    <form class="form-group" action="{{ $data['route'] }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($data['method'])
                        {{--Pubblicato--}}
                        <div class="alert-warning mb-3">{{$errors->has('published') ? $errors->first('published') : ''}}</div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="published" id="published" {{ (isset($data['apartment']) && $data['apartment']->published) ? 'checked' : null }} value="1" class="form-check-input">
                            <label class="form-check-label" for="published">Pubblica</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="published" id="published" {{ (isset($data['apartment']) && !$data['apartment']->published) ? 'checked' : null }} value="0" class="form-check-input">
                            <label class="form-check-label" for="published">Sospendi Pubblicazione</label>
                        </div>
                        {{--/Pubblicato--}}

                        {{--titolo--}}
                        <div class="form-group">
                            <label for="title">Nome appartamento</label>
                            <input type="text" name="title" class="form-control" placeholder="{{$errors->has('title') ? $errors->first('title') : 'Inserisci il nome dell\'appartamento'}}" value="{{ (isset($data['apartment'])) ? $data['apartment']->title : old('title')}}">
                        </div>
                        {{--/titolo--}}

                        {{--Descrizione--}}
                        <div class="form-group">
                            <div class="alert-warning mb-3">{{$errors->has('description') ? $errors->first('description') : ''}}</div>
                            <label for="title">Descrizione</label>
                            <textarea name="description" id="description" class="form-control" rows="5">{{ (isset($data['apartment'])) ? $data['apartment']->description : old('description')}}</textarea>
                        </div>
                        {{--/Descrizione--}}

                        {{--Immagine--}}
                        @if(isset($data['apartment']) && !empty($data['apartment']->image))
                            <img src="{{asset('storage/' . $data['apartment']->image)}}" alt="{{$data['apartment']->title}}">
                            <div class="form-group">
                                <label for="delete_image">Elimina immagine</label>
                                <input type="checkbox" name="delete_image" id="delete_image" class="form-check" value="{{$data['apartment']->image}}">
                            </div>
                        @else
                            <div class="alert-warning mb-3">{{ $errors->has('image') ? $errors->first('image') : '' }}</div>
                            <div class="custom-file mt-3 mb-3">
                                <label for="image" class="custom-file-label">Immagine</label>
                                <input type="file" name="image" id="image" class="custom-file-input">
                            </div>
                        @endif
                        {{--/Immagine--}}

                        {{--Prezzo--}}
                        <div class="form-group">
                            <label for="price">Prezzo</label>
                            <input type="number"  step="0.5"  name="price" placeholder="{{$errors->has('price') ? $errors->first('price') : 'Inserisci il prezzo dell\'appartamento'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->price : old('price')}}">
                        </div>
                        {{--/Prezzo--}}

                        {{--Indirizzo--}}
                        <h2>Inserisci l'indirizzo completo</h2>
                        <div class="form-group">
                            <label for="address">Indirizzo</label>
                            @if($errors->has('street') || $errors->has('number') || $errors->has('locality') || $errors->has('postal_code') || $errors->has('state') || $errors->has('latitude') || $errors->has('longitude'))
                                <div class="alert-warning mb-3">Indirizzo errato inseriscilo nuovamente</div>
                            @endif
                            <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidonia, RM, Italia" autocomplete="off">
                        </div>
                        <div class="apartment__create__address-disabled">
                            <h2>Indirizzo</h2>
                            <div class="" id="address-complete">
                                <div class="form-group">
                                    <label for="street">Via</label>
                                    <input type="text" id="street" name="street" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->street : old('street')}}"  data-geo="route">
                                </div>
                                <div class="form-group">
                                    <label for="house_number">Numero abitazione</label>
                                    <input type="number" id="number" name="house_number" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->house_number : old('house_number')}}"  data-geo="street_number">
                                </div>
                                <div class="form-group">
                                    <label for="locality">Citt&agrave;</label>
                                    <input type="text" id="locality" name="locality" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->locality : old('locality')}}"  data-geo="locality">
                                </div><div class="form-group">
                                    <label for="postal_code">Codice postale</label>
                                    <input type="number" id="postal_code" name="postal_code" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->postal_code : old('postal_code')}}"  data-geo="postal_code">
                                </div>
                                <div class="form-group">
                                    <label for="state">Stato</label>
                                    <input type="text" id="state" name="state"  class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->state : old('state')}}"  data-geo="country">
                                    <input name="latitude" type="hidden" value="{{ (isset($data['apartment'])) ? $data['apartment']->latitude : old('latitude')}}"  data-geo="lat">
                                    <input name="longitude" type="hidden" value="{{ (isset($data['apartment'])) ? $data['apartment']->longitude : old('longitude')}}"  data-geo="lng">
                                </div>
                            </div>
                        </div>
                        {{--Indirizzo--}}

                        {{--Caratteristiche--}}
                        <h2>Caratteristiche</h2>
                        <div class="form-group">
                            <label for="square_meters">Dimensioni</label>
                            <input type="number" name="square_meters" placeholder="{{$errors->has('square_meters') ? $errors->first('square_meters') : 'Inserisci le dimensioni in mq'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->square_meters : old('square_meters')}}">
                        </div>
                        <div class="form-group">
                            <label for="rooms">Stanze</label>
                            <input type="number" name="rooms" placeholder="{{$errors->has('square_meters') ? $errors->first('square_meters') : 'Inserisci il numero di stanze'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->rooms : old('rooms')}}">
                        </div>
                        <div class="form-group">
                            <label for="beds">Letti</label>
                            <input type="number" name="beds" placeholder="{{$errors->has('bes') ? $errors->first('beds') : 'Inserisci il numero di letti'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->beds : old('beds')}}">
                        </div>
                        <div class="form-group">
                            <label for="bathrooms">Bagni</label>
                            <input type="number" name="bathrooms" placeholder="{{$errors->has('bes') ? $errors->first('beds') : 'Inserisci il numero di bagni'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->bathrooms : old('bathrooms')}}">
                        </div>
                        {{--/Caratteristiche--}}

                        {{--Hidden--}}
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <input type="submit" value="Salva Nuovo appartamento" class="form-control">
                        </div>
                        {{--Hidden--}}
                    </form>
                </div>
            </div>
        </div>
    @endisset
@endsection
