@extends('layouts.app')
@section('content')
    <div class="container">
            <div class="search__results row">
                <card v-for="card in apartments" v-bind:card="card" :key="card.name"></card>
                <infinite-loading :identifier="infiniteId" @infinite="infiniteHandler" @distance="1" force-use-infinite-wrapper="true"></infinite-loading>
            </div>
    </div>
@endsection
