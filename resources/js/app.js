
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
    $('#button-search').click(function () {
        event.preventDefault();
        let href = window.location.href.split('/');
        let host = href[2];
        let urlApi = '/api/v1/apartments';

        let url = 'http://'+host+urlApi;
        let lat = $('#latitude').val();
        let lon = $('#longitude').val();
        let radius = $('#radius').val() | 20;
        let $services = $('#services input:checked');
        let services = [];

        for(var i = 0, lenght = $services.length; i < lenght; i++){
            services.push($($services[i]).val());
        }

        radius = radius * 1000;

        axios({
            method:'post',
            url: url,
            headers: {'Authorization': 'Bearer 123_Pippo_Pluto'},
            data: {
                latitude: lat,
                longitude: lon,
                radius: radius,
                services: services,
            }
        }).then((response) => {
            console.log(response.data);
        }).catch(error => {
            console.log(error.response)
        });
    });
});
