@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div id="dropin-container" data-token="{{$client_token}}"  data-action="{{ route('sponsorships.process', $apartment->id) }}" ></div>
                <button id="submit-button">Request payment method</button>
            </div>
        </div>
    </div>

@endsection