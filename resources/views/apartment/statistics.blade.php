@extends('layouts.app')
@section('content')
  <div class="statistics">
    <div class="statistics__title">
      <div class="container">
      <div class="row">
        <div class="col-12">
          <h1>STATISTICHE</h1>
        </div>
      </div>
    </div>
    </div>
    <div class="statistics__graphic">
      <div id="charts">
        <div class="container">
          <div class="statistics__graphic__show-button">
            <div class="row">
                <div class="col-4 offset-8 text-right">
                    <a href="{{ route('apartment.show', $apartment->id) }}" class="btn btn-default"><i class="fas fa-eye"></i>Visualizza Appartamento</a>
                </div>
            </div>
            </div>
            <div class="statistics__graphic__selector">
            <div class="row">
                <div class="col-12">
                  <p><b>Seleziona anno</b></p>
                        <select name="year" id="year" v-model="selected"  @change="onChange()">
                            @foreach($years as $year)
                                <option value="{{$year}}" {{($year === $years[count($years) -1]) ? 'selected' : ''}}>{{$year}}</option>
                            @endforeach
                        </select>
                    </div>
            </div>
            </div>
            <div class="statistics__graphic__main">
            <div class="row">
                <div class="col-6"  v-for="chart in charts" :id="chart.name">
                    <div class="chart" >
                        <chart-component :chart-data="chart.chartdata" v-if="chart.loaded" :options="chart.options" ></chart-component>
                    </div>
                </div>
               {{-- <div class="col-6">
                    <div class="chart" id="chart-messages">
                        <chart-component  :chart-data="chartdata" v-if="loaded" :options="options" ref="messages"></chart-component>
                    </div>
                </div>--}}
            </div>
            </div>
        </div>
        </div>
    </div>
  </div>
@endsection
