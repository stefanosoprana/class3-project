@extends('layouts.app')
@section('content')

        <div class="search__results">
            <card v-for="card in apartments" v-bind:card="card" :key="card.name"></card>
            <infinite-loading :identifier="infiniteId" @infinite="infiniteHandler" ></infinite-loading>
        </div>

@endsection
