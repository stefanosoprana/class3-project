@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Sponsorizza l'appartamento {{$apartment->title}}</h1>
            </div>
        </div>
        <div class="sponsorships">
            <div class="row">
                @foreach($sponsorships_type as $sponsorship_type)
                    <div class="col-4">
                        <div class="sponsorships__button text-center">
                            <p>{{$sponsorship_type->name}} a</p>
                            <p> <a href="{{route('sponsorships.payment', [$apartment->id, $sponsorship_type->id])}}" class="btn btn-primary">{{$sponsorship_type->price}} €</a></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
