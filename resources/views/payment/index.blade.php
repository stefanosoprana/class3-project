@extends('layouts.app')
@section('content')
    <div class="pay">
        <div class="pay__main">
            <div class="pay__main__title">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h1>Sponsorizza {{$apartment->title}}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pay__main__content mt-5">
                <div class="container">
                    <div class="sponsorships">
                        <div class="row">
                            @foreach($sponsorships_type as $sponsorship_type)
                                <div class="col-4">
                                    <div class="sponsorships__button text-center">
                                        <h4 class="title-blue">{{$sponsorship_type->name}} a</h4>
                                        <p> <a href="{{route('sponsorships.payment', [$apartment->id, $sponsorship_type->id])}}" class="btn btn-primary">{{$sponsorship_type->price}} €</a></p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
