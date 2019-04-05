@extends('layouts.app')
@section('content')
    <div class="pay">
        <div class="pay__main">
            <div class="pay__main__title">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>Effetua il pagamento</h1>
                        </div>
                    </div>
                </div>
            </div>
        <div class="pay__main__content mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div id="alert-dropin">

                        </div>
                        <div id="success-payment" hidden>
                            <a href="{{route('apartments.user.index', Auth::user())}}">Torna agli appartamenti</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div id="dropin-container" data-token="{{$client_token}}"  data-action="{{ route('sponsorships.process', $apartment->id) }}" data-sponsorship="{{$sponsorship}}" data-apartment="{{$apartment->id}}"></div>
                        <button id="submit-button">Request payment method</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection