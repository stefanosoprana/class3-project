@extends('layouts.app')
@section('content')
    <div id="charts">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="chart" id="chart-visits">
                        <chart-component></chart-component>
                    </div>
                </div>
                <div class="col-6">
                    <div class="chart" id="chart-messages">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection