
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

Vue.component('chart-component-visits', require('./components/ChartVisitsComponent.vue').default);
/*Vue.component('chart-component-messages', require('./components/ChartMessagesComponent.js').default);*/
Vue.component('card', require('./components/CardComponent.vue').default);
Vue.component('service-component', require('./components/ServiceComponent.vue').default);

import ChartComponent from './components/ChartMessagesComponent.js';

$(document).ready(function () {
    //search geocomplete
    $('.search #address').geocomplete({
        details: "#address-complete",
        detailsAttribute: "data-geo"
    });

    //apartment add geocomplete
    $('#address_apartment').geocomplete({
        details: "#address_apartment-complete",
        detailsAttribute: "data-geo"
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
                this.loaded = false;
                this.fillData(selected);
            },
            data(){
                return {
                    selected: selected,
                    loaded: false,
                    chartdata: null
                }
            },
            methods: {
                onChange() {
                    this.fillData(this.selected);
                },
                fillData(year) {
                    let href = window.location.href.split('/');
                    let host = href[2];
                    let idApartment = href[href.length - 2];
                    let urlApi = '/api/v1/apartment/';

                    let url = 'http://' + host + urlApi + idApartment + '/messages/'+ year;

                    let labels = [];
                    let messages = [];

                    this.axios({
                        method: 'get',
                        url: url,
                        headers: {'Authorization': 'Bearer 123_Pippo_Pluto'}
                    }).then((response) => {
                        let data = response.data.result;
                        let label = data.labels;
                        let messagesData = data.messages;
                        console.log(messagesData);

                        if (messagesData) {
                            label.forEach(
                                function (element) {
                                    labels.push(element);
                                }
                            );
                            messagesData.forEach(
                                function (element) {
                                    messages.push(element);
                                }
                            );
                            this.chartdata = {
                                labels: labels,
                                datasets: [{
                                    label: 'Messages',
                                    backgroundColor: '#007bff',
                                    data: messages
                                }],

                            };
                            this.options = {
                                responsive: true,
                                    maintainAspectRatio: false
                            };
                            this.loaded = true;
                        } else {
                            console.log('No data');
                        }
                    });
                },
            }

        });
    }

    //vue search
    if($('#search__result').length) {
        const searchResult = new Vue({
            el: '#search__result',
            data: {
                address: '',
                latitude: '',
                longitude: '',
                radius: '',
                beds: '',
                rooms: '',
                services: '',
                apartments: []
            },
            methods: {
                getFormValues: function(submitEvent) {

                    let href = window.location.href.split('/');
                    let host = href[2];
                    let urlApi = '/api/v1/apartments';
                    let url = 'http://'+host+urlApi;

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
                        //console.log(response.data.result);
                        this.apartments = response.data.result;
                    }).catch(error => {
                        console.log(error.response);
                    });
                }
            },
            mounted() {
                //avvio geocomplete

                let uri = window.location.search.substring(1);
                let params = new URLSearchParams(uri);

                this.address = params.get("address");
                this.latitude = params.get("latitude");
                this.longitude = params.get("longitude");
                this.radius = params.get("radius");
                this.beds = params.get("beds") || 1;
                this.rooms = params.get("rooms") || 1;
                this.services = params.getAll("service");

                let href = window.location.href.split('/');
                let host = href[2];
                let urlApi = '/api/v1/apartments';
                let url = 'http://'+host+urlApi;

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
                    //console.log(response.data.result);
                    this.apartments = response.data.result;

                    let vuethis = this;
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
        });
    }
});


