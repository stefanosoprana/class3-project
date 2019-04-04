@extends('layouts.app')
@section('content')
    <div class="apartments">
        <div class="apartments__main">
            <div class="apartments__main__title">

            </div>
            <div class="apartments__main__content">
              <div class="container">

                {{-- Titolo Evidenza --}}
                <div class="row">
                    <div class="col-12">
                        <h2 class="title">La tua ricerca</h2>
                    </div>
                </div>
                {{-- End Titolo Evidenza --}}

                <div class="container mt-5">
                    <div class="search__results row">
                        <card v-for="card in apartments" v-bind:card="card" :key="card.name"></card>
                        <infinite-loading :identifier="infiniteId" @infinite="infiniteHandler" @distance="1" force-use-infinite-wrapper="true"></infinite-loading>
                    </div>
                </div>
            </div>
            </div>
        </div>

    </div>
@endsection
