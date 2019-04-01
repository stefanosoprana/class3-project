@extends('layouts.app')
@section('content')
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
                <div id="dropin-container" data-token="{{$client_token}}"  data-action="{{ route('sponsorships.process', $apartment->id) }}" data-sponsorship="{{$sponsorship}}" data-apartment="{{$apartment->id}}" ></div>
                <button id="submit-button">Request payment method</button>
            </div>
        </div>
    </div>

@endsection