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
                <div class="col-12">
                    <div class="form-control">
                        <select name="year" id="year" v-model="selected"  @change="onChange()">
                            @foreach($years as $year)
                                <option value="{{$year}}" {{($year === $years[count($years) -1]) ? 'selected' : ''}}>{{$year}}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h2>Statistiche  @{{ selected }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="chart" id="chart-visits">
                        <chart-component :chart-data="chartdata" v-if="loaded" :options="options"></chart-component>
                    </div>
                </div>
                <div class="col-6">
                    <div class="chart" id="chart-messages">
                        <chart-component  :chart-data="chartdata" v-if="loaded" :options="options"></chart-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection