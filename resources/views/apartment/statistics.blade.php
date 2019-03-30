@extends('layouts.app')
@section('content')
    <div id="charts">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <h1>Statistiche appartamento: <br>{{$apartment->title}}</h1>
                </div>
                <div class="col-4 text-right">
                    <a href="{{ route('apartment.show', $apartment->id) }}" class="btn btn-primary">Visualizza Appartamento</a>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="chart" id="chart-visits">
                        <chart-component-visits></chart-component-visits>
                    </div>
                </div>
                <div class="col-6">
                    <div class="chart" id="chart-messages">
                        <chart-component-messages></chart-component-messages>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection