
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
Vue.component('chart-component-messages', require('./components/ChartMessagesComponent.vue').default);
Vue.component('card', require('./components/CardComponent.vue').default);
Vue.component('service-component', require('./components/ServiceComponent.vue').default);


$(document).ready(function () {
    $('#address').geocomplete({
        details: "#address-complete",
        detailsAttribute: "data-geo"
    });

    if($('#charts').length){
        const charts = new Vue({
            el: '#charts'
        });
    }

    if($('#search__result').length) {
        const searchResult = new Vue({
            el: '#search__result',
            data: {
                latitude: '',
                longitude: '',
                radius: '',
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
                    let services = submitEvent.target.elements.service;
                    this.beds = submitEvent.target.elements.beds.value;
                    this.rooms = submitEvent.target.elements.rooms.value;
                    
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
                        console.log(response.data.result);
                        this.apartments = response.data.result;
                    }).catch(error => {
                        console.log(error.response)
                    });
                }
            },
            mounted() {
                //avvio geocomplete
                $('#address').geocomplete({
                    details: "#address-complete",
                    detailsAttribute: "data-geo"
                });
            },
        });
    }
});


