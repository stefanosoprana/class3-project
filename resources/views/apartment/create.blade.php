@extends('layouts.app')
@section('scripts')
    <script src="http://maps.googleapis.com/maps/api/js?key={{config('app.google_api_key')}}&libraries=places"></script>
@endsection
@section('content')
    @isset($data)
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Aggiungi nuovo appartamento</h1>
                    <form class="form-group" action="{{ $data['route'] }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method($data['method'])

                        {{--titolo--}}
                        <div class="form-group">
                            <label for="title">Nome appartamento</label>
                            <input type="text" name="title" class="form-control" placeholder="{{$errors->has('title') ? $errors->first('title') : 'Inserisci il nome dell\'appartamento'}}" value="{{ (isset($data['apartment'])) ? $data['apartment']->title : null}}">
                        </div>
                        {{--/titolo--}}

                        {{--Descrizione--}}
                        <div class="form-group">
                            <div class="alert-warning mb-3">{{$errors->has('description') ? $errors->first('description') : ''}}</div>
                            <label for="title">Descrizione</label>
                            <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                        </div>
                        {{--/Descrizione--}}

                        {{--Immagine--}}

                        @if($data['apartment'] && !empty($data['apartment']->image))
                            <img src="{{asset('storage/' . $data['category']->image)}}" alt="">
                            <div class="form-group">
                                <label for="delete_image">Elimina immagine</label>
                                <input type="checkbox" name="delete_image" id="delete_image" class="form-check" value="{{$data['image']->image}}">
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
                            <input type="number"  step="0.5"  name="price" placeholder="{{$errors->has('price') ? $errors->first('price') : 'Inserisci il prezzo dell\'appartamento'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->price : null}}">
                        </div>
                        {{--/Prezzo--}}

                        {{--Indirizzo--}}
                        <h2>Inserisci l'indirizzo completo</h2>
                        <div class="form-group">
                            <label for="address">Indirizzo</label>
                            @if($errors->has('street') || $errors->has('number') || $errors->has('postal_code') || $errors->has('state') || $errors->has('latitude') || $errors->has('longitude'))
                                <div class="alert-warning mb-3">Indirizzo errato inseriscilo nuovamente</div>
                            @endif
                            <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidoina, RM, Italia" autocomplete="off">
                        </div>
                        <h2>Indirizzo</h2>
                        <div class="" id="address-complete">
                            <div class="form-group">
                                <label for="street">Via</label>
                                <input type="text" id="street" name="street" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->street : null}}"  data-geo="route">
                            </div>
                            <div class="form-group">
                                <label for="house_number">Numero abitazione</label>
                                <input type="number" id="number" name="house_number" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->house_number : null}}"  data-geo="street_number">
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Codice postale</label>
                                <input type="number" id="postal_code" name="postal_code" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->postal_code : null}}"  data-geo="postal_code">
                            </div>
                            <div class="form-group">
                                <label for="state">Stato</label>
                                <input type="text" id="state" name="state"  class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->state : null}}"  data-geo="country">
                                <input name="latitude" type="hidden" value="{{ (isset($data['apartment'])) ? $data['apartment']->latitude : null}}"  data-geo="lat">
                                <input name="longitude" type="hidden" value="{{ (isset($data['apartment'])) ? $data['apartment']->longitude : null}}"  data-geo="lng">
                            </div>
                        </div>
                        {{--Indirizzo--}}

                        {{--Caratteristiche--}}
                        <h2>Caratteristiche</h2>
                        <div class="form-group">
                            <label for="square_meters">Dimensioni</label>
                            <input type="number" name="square_meters" placeholder="{{$errors->has('square_meters') ? $errors->first('square_meters') : 'Inserisci le dimensioni in mq'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->square_meters : null}}">
                        </div>
                        <div class="form-group">
                            <label for="rooms">Stanze</label>
                            <input type="number" name="rooms" placeholder="{{$errors->has('square_meters') ? $errors->first('square_meters') : 'Inserisci il numero di stanze'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->rooms : null}}">
                        </div>
                        <div class="form-group">
                            <label for="beds">Letti</label>
                            <input type="number" name="beds" placeholder="{{$errors->has('bes') ? $errors->first('beds') : 'Inserisci il numero di letti'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->beds : null}}">
                        </div>
                        <div class="form-group">
                            <label for="bathrooms">Bagni</label>
                            <input type="number" name="bathrooms" placeholder="{{$errors->has('bes') ? $errors->first('beds') : 'Inserisci il numero di bagni'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->bathrooms : null}}">
                        </div>
                        {{--/Caratteristiche--}}

                        {{--Hidden--}}
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="published" value="1">
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
