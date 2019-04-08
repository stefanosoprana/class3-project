
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('geocomplete');

window.Vue = require('vue');
Vue.use(VueAxios, axios);

import VueAxios from 'vue-axios';
import axios from 'axios';

//import VueCharts Wrapper
import VueCharts from 'vue-chartjs';
import { Bar, Line } from 'vue-chartjs';


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('card', require('./components/CardComponent.vue').default);
Vue.component('service-component', require('./components/ServiceComponent.vue').default);
//Vue.component('InfiniteLoading', require('vue-infinite-loading'));

import InfiniteLoading from 'vue-infinite-loading';
Vue.use(InfiniteLoading, {
    slots: {
        noMore: 'Non sono presenti altri appartamenti', // you can pass a string value
        noResults: 'Non sono presenti appartamenti con queste caratteristiche', // you can pass a string value
    },
});

import ChartComponent from './components/ChartMessagesComponent.js';

$(document).ready(function () {
    var forms = $('.needs-validation');
    //console.log(forms);
    $(forms).submit(function (event) {
        if(!this.checkValidity()){
            event.preventDefault();
            event.stopPropagation();
        }
        $(this).addClass('was-validated');
    });

    //search geocomplete
    $('.search #address').geocomplete({
        details: "#address-complete",
        detailsAttribute: "data-geo"
    });

    //apartment add geocomplete
    $('#address_apartment').geocomplete({
        details: "#address_apartment-complete",
        detailsAttribute: "data-geo"
    }).bind("geocode:result", function(event, result){
        let $street = $('#street').val();
        let $house_number = $('#house_number').val();
        let $locality = $('#locality').val();
        let $postal_code = $('#postal_code').val();
        let $country = $('#state').val();
        $('#street-fake').html($street);
        $('#house_number-fake').html($house_number);
        $('#locality-fake').html($locality);
        $('#postal_code-fake').html($postal_code);
        $('#country-fake').html($country);
    });

    //vue chart
    if($('#charts').length){
        var selected = $('#year').val();
        const charts = new Vue({
            el: '#charts',
            components:{
                ChartComponent,
            },
            async mounted () {
                //finchè i dati sono sono attivi le chart non sono montate
                this.loaded = false;
                //richiamo funzione per prendere dati da api
                this.fillData(selected);
            },
            data(){
                //ritorna i dati al componente figlio
                return {
                    charts: {
                        visits: {
                            name: 'visits',
                            chartdata: null,
                            options: null,
                            colors:'#FC2525',
                            loaded: false,
                        },
                        messages: {
                            name: 'messages',
                            chartdata: null,
                            options: null,
                            colors:'#007bff',
                            loaded: false,
                        },
                    },
                    //prende e cambia dati per select anni
                    selected: selected,
                }
            },
            methods: {
                //funzione onChange per select
                onChange() {
                    this.fillData(this.selected);
                },
                //funzione che prende dati da Api
                fillData(year) {
                    let href = window.location.href.split('/');
                    let host = href[2];
                    let idApartment = href[href.length - 2];
                    let urlApi = '/api/v1/apartment/';
                    let url = 'http://' + host + urlApi + idApartment + '/';

                    let vm = this;
                    //per ogni chart faccio una chiamata alla api
                    for (let chart in this.charts) {
                        vm.callAxios(chart, url, year);
                    }
                },
                callAxios(typeData, url, year){
                    url += typeData+'/'+ year;

                    let labels = [];
                    let datas = [];

                    this.axios({
                        method: 'get',
                        url: url,
                        headers: {'Authorization': 'Bearer 123_Pippo_Pluto'}
                    }).then((response) => {
                        let data = response.data.result;
                        let label = data.labels;
                        let thisData = data[typeData];

                        if (thisData) {
                            label.forEach(
                                function (element) {
                                    labels.push(element);
                                }
                            );
                            thisData.forEach(
                                function (element) {
                                    datas.push(element);
                                }
                            );
                            this.charts[typeData].chartdata = {
                                labels: labels,
                                datasets: [{
                                    label: typeData,
                                    backgroundColor: this.charts[typeData].colors,
                                    data: datas
                                }],

                            };
                            this.charts[typeData].options = {
                                responsive: true,
                                maintainAspectRatio: false
                            };
                            this.charts[typeData].loaded = true;
                        } else {
                            console.log('No data');
                        }
                    });
                }
            }
        });
    }

    //vue search
    if($('#search__result').length) {
        const searchResult = new Vue({
            el: '#search__result',
            data(){
                return {
                    href: '',
                    host:'',
                    urlApi:'',
                    address: '',
                    latitude: '',
                    longitude: '',
                    radius: '',
                    beds: '',
                    rooms: '',
                    services: '',
                    apartments: [],
                    page: 1,
                    infiniteId: +new Date(),
                    formNoValidated: true,
                    formValidated: false
                }
            },
            methods: {
                formValidate(status){
                    this.formNoValidate = !status;
                    this.formValidated = status;
                    console.log(this.formValidated);
                },
                infiniteHandler($state) {
                    this.formValidate(false);
                    let url = 'http://'+this.host+this.urlApi+this.page;
                    let vuethis = this;
                    axios({
                        method:'post',
                        url: url,
                        headers: {'Authorization': 'Bearer 123_Pippo_Pluto'},
                        data: {
                            latitude: this.latitude,
                            longitude: this.longitude,
                            radius: this.radius,
                            services: this.services,
                            beds: this.beds,
                            rooms: this.rooms,
                        }
                    }).then((response) => {
                        if( Object.keys(response.data.result).length){
                            this.page += 1;
                            $.each(response.data.result, function(key, value) {
                                vuethis.apartments.push(value);
                            });
                            $state.loaded();
                        } else{
                            $state.complete();
                        }


                        $('#address').geocomplete({
                            details: "#address-complete",
                            detailsAttribute: "data-geo"
                        }).bind("geocode:result", function(event, result){
                            vuethis.address =  $('#address').val();
                        });

                    }).catch(error => {
                        console.log(error.response);
                    });


                },
                getFormValues: function(submitEvent) {
                    console.log("loading");
                    console.log(this.page);
                    if(!submitEvent.srcElement.checkValidity()){
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    else{
                        this.latitude = submitEvent.target.elements.latitude.value;
                        this.longitude = submitEvent.target.elements.longitude.value;
                        this.radius = submitEvent.target.elements.radius.value;
                        this.beds = submitEvent.target.elements.beds.value;
                        this.rooms = submitEvent.target.elements.rooms.value;
                        let services = submitEvent.target.elements.service;

                        let arrServices = [];
                        services.forEach(function (service, i) {
                            if(service.checked){
                                arrServices.push(service.value);
                            }
                        });

                        this.services = arrServices;

                        this.page = 1;
                        this.apartments = [];
                        this.infiniteId += 1;
                    }
                    this.formValidate(true);
                }
            },
            mounted() {
                let uri = window.location.search.substring(1);
                let params = new URLSearchParams(uri);
                this.address = params.get("address");
                this.latitude = params.get("latitude");
                this.longitude = params.get("longitude");
                insertParamsLatLon(this.latitude,  this.longitude);

                this.radius = params.get("radius");
                this.beds = params.get("beds") || 1;
                this.rooms = params.get("rooms") || 1;
                this.services = params.getAll("service");

                this.href = window.location.href.split('/');
                this.host = this.href[2];
                this.urlApi = '/api/v1/apartments/';
                console.log('mounted');
            },
        });
    }
    function insertParamsLatLon(lat, lon) {
        $('#latitude').val(lat);
        $('#longitude').val(lon);
    }

    //payment
    if( $('#dropin-container').length){
        let dropin = require('braintree-web-drop-in');
        let $alert =  $('#alert-dropin');

        let $container = $('#dropin-container');
        let $button = $('#submit-button');
        let $success = $('#success-payment');
        let token = $container.data('token');
        let url = $container.data('action');
        let sponsorship = $container.data('sponsorship');
        let apartmentId = $container.data('apartment');
        dropin.create({
            authorization: token,
            container: '#dropin-container',
        }).then(function (instance) {
            $button.click(function () {
                event.preventDefault();
                $alert.removeClass('alert alert-danger').html('');

                instance.requestPaymentMethod().then(function (payload) {
                    // Submit payload.nonce to your server
                    let nonce = payload.nonce;

                    axios({
                        method:'post',
                        url: url,
                        data: {
                            payload: nonce,
                            sponsorship: sponsorship,
                            apartmentId: apartmentId
                        }
                    }).then((response) => {
                        //console.log(response.data);
                        if(response.data.success === true){
                            instance.teardown(function(err) {
                                if (err) { console.error('An error occurred during teardown:', err); }
                            });
                            $button.remove();
                            $success.addClass('alert alert-primary').removeAttr('hidden').prepend('Pagamento avvenuto con successo.');
                        } else {
                            $alert.addClass('alert alert-danger').html(response.data.message);
                        }
                    }).catch(error => {
                        console.log(error.response);
                    });
                }).catch(function (requestPaymentMethodErr) {
                    // No payment method is available.
                    // An appropriate error will be shown in the UI.
                    console.error(requestPaymentMethodErr);
                });
            });
        });
    }

    // STATUS
    setInterval(function(){
        $('.status').remove();
    }, 2000);
});
