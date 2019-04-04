{{--Search Form--}}
<form  class="control needs-validation search__form" @submit.prevent="getFormValues" novalidate>
    {{-- <form  class="control needs-validation" @submit.prevent="getFormValues" id="search__form" novalidate>--}}
    @else
        {{--Search Form with get action--}}
        <form class="control needs-validation" action="{{ route('apartments.search') }}" method="get" id="search__form" novalidate>
            @csrf
            @method('GET')
            @endif
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center">
                    <div id="address-complete" class="address">
                        <div class="form-group search">
                            <label for="address">Indirizzo</label>
                            <input type="text" id="address" name="address" class="form-control" placeholder="es. via Plutarco, 31 , Guidonia, RM, Italia" autocomplete="off"  v-model="address" required>
                        </div>
                        <input id="latitude" name="latitude" type="hidden" data-geo="lat" value="">
                        <input id="longitude" name="longitude" type="hidden"  data-geo="lng" value="">
                    </div>

                    <div class="form-group search-number">
                        <label for="radius">Raggio</label>
                        <input type="number" id="radius" name="radius" placeholder="Raggio" v-model="radius" min="1" class="form-control">

                    </div>
                    <div class="form-group search-number">
                        <label for="beds">N. letti</label>
                        <input type="number" id="beds" name="beds" placeholder="N.  letti" v-model="beds" min="0" class="form-control">
                    </div>
                    <div class="form-group search-number">
                        <label for="rooms">N. stanze</label>
                        <input type="number" id="rooms" name="rooms" placeholder="N. stanze" v-model="rooms" min="0" class="form-control">
                    </div>
                    @foreach($services as $service)
                        <div class="checkbox-container form-group">
                            <input type="checkbox" v-model="services" name="services[]" value="{{$service->name}}"  {{ (isset($data['apartment']) && $data['apartment']->services->firstWhere('id', $service->id) !== null) ? 'checked' : null }}>
                            <i class="{{ $service->icon }}" title="{{$service->name}}"></i>
                        </div>
                    @endforeach
                    <div class="search-submit">
                        <input id="button-search" type="submit" value="Cerca" class="btn btn-primary">
                    </div>
                </div>
            </div>
        </form>
{{--/Search Form--}}