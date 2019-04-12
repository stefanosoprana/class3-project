@extends('layouts.app')
@section('scripts')

@endsection
@section('content')
    @isset($data)
        <div class="apartments">
            <div class="apartments__main">
                <div class="apartments__main__title">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h1>{{$data['title']}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="apartments__main__create mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form class="needs-validation " action="{{ $data['route'] }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf
                                @method($data['method'])
                                {{--Pubblicato--}}
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert-warning mb-3">{{$errors->has('published') ? $errors->first('published') : ''}}</div>
                                        <div class="form-check form-check-inline">
                                          <div class="checkbox-container">
                                            <div class="checkbox-container__background"></div>
                                            @if(isset($data['apartment']) && $data['apartment']->published === 1)
                                              <input type="radio" name="published" id="published" checked  value="1" class="form-check-input" required>
                                            @elseif(!isset($data['apartment']))
                                              <input type="radio" name="published" id="published" checked  value="1" class="form-check-input" required>
                                            @endif
                                            <i class="fas fa-eye btn btn-default"></i>
                                          </div>
                                          <label class="form-check-label" for="published">Pubblica</label>
                                          <div class="valid-feedback">
                                            Campo valido
                                          </div>
                                          <div class="invalid-feedback">
                                            L'articolo deve essere pubblicato?
                                          </div>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <div class="checkbox-container">
                                            <input type="radio" name="published" id="published" {{ (isset($data['apartment']) && !$data['apartment']->published === 0) ? 'checked' : null }} value="0" class="form-check-input">
                                            <i class="fas fa-eye  btn btn-default unpublished"></i>
                                          </div>
                                          <label class="form-check-label" for="published">Sospendi Pubblicazione</label>
                                          <div class="valid-feedback">
                                            Campo valido
                                          </div>
                                          <div class="invalid-feedback">
                                            O deve essere privato?
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                {{--/Pubblicato--}}

                                {{--titolo--}}
                                <div class="row">
                                    <div class="form-group mt-5 col-12">
                                        <h3 class="title-purple">Generalit&agrave;</h3>
                                        <label for="title">Nome appartamento</label>
                                        <input type="text" name="title" class="form-control" placeholder="{{$errors->has('title') ? $errors->first('title') : 'Inserisci il nome dell\'appartamento'}}" value="{{ (isset($data['apartment'])) ? $data['apartment']->title : old('title')}}" required minlength="10" maxlength="50">
                                        <div class="valid-feedback">
                                            Campo valido
                                        </div>
                                        <div class="invalid-feedback">
                                            Scrivi un titolo valido. Almeno 10 caratteri, massimo 50.
                                        </div>
                                    </div>
                                </div>
                                {{--/titolo--}}

                                {{--Descrizione--}}
                                <div class="row">
                                    <div class="form-group col-12">
                                        <div class="alert-warning mb-3">{{$errors->has('description') ? $errors->first('description') : ''}}</div>
                                        <label for="title">Descrizione</label>
                                        <textarea name="description" id="description" class="form-control" rows="5" required  minlength="20" maxlength="1000">{{ (isset($data['apartment'])) ? $data['apartment']->description : old('description')}}</textarea>
                                        <div class="valid-feedback">
                                            Descrizione valida
                                        </div>
                                        <div class="invalid-feedback">
                                            Inserisci una descrizione valida. Almeno 20 caratteri, massimo 1000.
                                        </div>
                                    </div>
                                </div>
                                {{--/Descrizione--}}

                                {{--Immagine--}}
                                <div class="row">
                                    <div class="col-12">
                                        @if(isset($data['apartment']) && !empty($data['apartment']->image))
                                            <div class="row">
                                            <div class="col-lg-4 col-sm-12">
                                                <p>Immagine Caricata</p>
                                                <div class="apartments__thumbnail">
                                                    <img src="{{asset('storage/' . $data['apartment']->image)}}" alt="{{$data['apartment']->title}}" class="img-fluid">
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-sm-12 apartments__browse">
                                                    <label>Sostituisci con una nuova immagine</label>
                                                    @endif
                                                    {{--/Immagine--}}
                                                    <div class="alert-warning mb-2">{{ $errors->has('image') ? $errors->first('image') : '' }}</div>
                                                    <div class="custom-file mb-3">
                                                        <label for="image" class="custom-file-label">Immagine</label>
                                                        <input type="file" name="image" id="image" class="custom-file-input">
                                                    </div>

                                            @if(isset($data['apartment']) && !empty($data['apartment']->image))
                                            </div>
                                            </div>
                                            @endif
                                    </div>
                                </div>

                                {{--Prezzo--}}
                                <div class="row">
                                    <div class="form-group col-lg-2 col-sm-12 mt-3">
                                        <label for="price">Prezzo</label>
                                        <input type="number" min="1" step="0.10"  name="price" placeholder="{{$errors->has('price') ? $errors->first('price') : 'es. 25,50'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->price : old('price')}}" required>
                                        <div class="valid-feedback">
                                            Campo valido
                                        </div>
                                        <div class="invalid-feedback">
                                            Inserisci un prezzo valido.
                                        </div>
                                    </div>
                                </div>
                                {{--/Prezzo--}}

                                {{--Indirizzo--}}
                                <div class="row">
                                    <div class="form-group mt-5 col-12">
                                        <h3 class="title-purple">Inserisci l'indirizzo completo</h3>
                                        <label for="address" hidden aria-hidden="false">Indirizzo</label>
                                        @if($errors->has('street') || $errors->has('number') || $errors->has('locality') || $errors->has('postal_code') || $errors->has('state') || $errors->has('latitude') || $errors->has('longitude'))
                                            <div class="alert-warning mb-3">Indirizzo errato inseriscilo nuovamente</div>
                                        @endif
                                        <input type="text" id="address_apartment" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidonia, RM, Italia" autocomplete="off" required  value="{{ (isset($data['apartment'])) ?  $data['apartment']->street .', '.  $data['apartment']->house_number .', '. $data['apartment']->locality  .', '. $data['apartment']->state : ''}}" >
                                        <div class="valid-feedback">
                                            Campo valido
                                        </div>
                                        <div class="invalid-feedback">
                                            Inserisci un indirizzo completo di strada, numero civico, città, stato.
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="apartments__main__create__address-fake container">
                                                <div class="row mt-5">
                                                    <div class="col-8">
                                                        <div id="street-fake"></div>
                                                    </div>
                                                    <div class="col-4 ">
                                                        <div id="house_number-fake"></div>
                                                    </div>
                                                </div>
                                                <div class="row mt-2">
                                                    <div class="col-3 ">
                                                        <div id="locality-fake"></div>
                                                    </div>
                                                    <div class="col-2 ">
                                                        <div id="postal_code-fake"></div>
                                                    </div>
                                                    <div class="col-2 ">
                                                        <div id="country-fake"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="apartments__main__create__address-disabled">
                                        <div class="" id="address_apartment-complete">
                                            <div class="form-group">
                                                <label for="street">Via</label>
                                                <input type="text" id="street" name="street" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->street : old('street')}}"  data-geo="route">
                                            </div>
                                            <div class="form-group">
                                                <label for="house_number">Numero abitazione</label>
                                                <input type="number" id="house_number" name="house_number" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->house_number : old('house_number')}}"  data-geo="street_number">
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
                                </div>
                                {{--Indirizzo--}}

                                {{--Caratteristiche--}}
                                <div class="row mt-5">
                                    <div class="col-12">
                                        <h3 class="title-purple">Caratteristiche</h3>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="form-group col-3">
                                                <label for="square_meters">Dimensioni</label>
                                                <input type="number" name="square_meters" placeholder="{{$errors->has('square_meters') ? $errors->first('square_meters') : 'Inserisci mq'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->square_meters : old('square_meters')}}" required min="1">
                                                <div class="valid-feedback">
                                                    Campo valido
                                                </div>
                                                <div class="invalid-feedback">
                                                    Inserisci i mq
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="rooms">Stanze</label>
                                                <input type="number" name="rooms" placeholder="{{$errors->has('square_meters') ? $errors->first('square_meters') : 'Inserisci il n. di stanze'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->rooms : old('rooms')}}" required min="1">
                                                <div class="valid-feedback">
                                                    Campo valido
                                                </div>
                                                <div class="invalid-feedback">
                                                    Inserisci le stanze
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="beds">Letti</label>
                                                <input type="number" name="beds" placeholder="{{$errors->has('bes') ? $errors->first('beds') : 'Inserisci il n. di letti'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->beds : old('beds')}}" required min="1">
                                                <div class="valid-feedback">
                                                    Campo valido
                                                </div>
                                                <div class="invalid-feedback">
                                                    Inserisci i letti
                                                </div>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="bathrooms">Bagni</label>
                                                <input type="number" name="bathrooms" placeholder="{{$errors->has('bathrooms') ? $errors->first('bathrooms') : 'Inserisci il n. di bagni'}}" class="form-control" value="{{ (isset($data['apartment'])) ? $data['apartment']->bathrooms : old('bathrooms')}}" required min="1">
                                                <div class="valid-feedback">
                                                    Campo valido
                                                </div>
                                                <div class="invalid-feedback">
                                                    Inserisci i bagni.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--/Caratteristiche--}}

                                {{--Servizi--}}
                                <div class="row mt-5">
                                    <div class="col-sm-12 col-lg-6">
                                        <div class="form-check form-check-inline">
                                            <fieldset id="services">
                                                <legend><h3 class="title-purple">Servizi</h3>
                                                </legend>
                                                <div class="row">
                                                    @foreach($services as $service)
                                                        <div class="col-6">
                                                            <div class="checkbox-container">
                                                                <input type="checkbox" name="services[]" value="{{$service->name}}"  {{ (isset($data['apartment']) && $data['apartment']->services->firstWhere('id', $service->id) !== null) ? 'checked' : null }}>
                                                                <i class="{{ $service->icon }}"></i>
                                                                <label class="form-check-label" for="{{$service->name}}">{{$service->name}}</label>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            </fieldset>
                                        </div>

                                    </div>
                                </div>
                                {{--/Servizi--}}

                                {{--Hidden--}}
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="form-group mt-5">
                                    <button class="btn btn-primary">Salva</button>
                                </div>
                                {{--Hidden--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection
