<template>
    <div class="col-12 col-xl-4 col-md-6 mb-4">
        <div class="card" v-bind:class="'card-'+card.sponsorized">
            <div class="card__header">
                <div class="card__img">
                    <a v-bind:href="card.url"  v-bind:style="{backgroundImage: 'url(' + card.image + ')'}" target="_blank"><img v-bind:src="card.image" v-bind:alt="card.name" aria-hidden="false" hidden></a>
                </div>
            </div>
            <div class="card__body">
                <div class="card__super-info">
                    {{card.beds}} letti -
                    <ul class="services">
                        <service-component v-for="service in card.services" v-bind:service="service" :key="service.name"></service-component>
                    </ul>
                </div>
                <div class="card__title">
                    <a class="card__title" v-bind:href="card.url" target="_blank"><h2>{{card.name}}</h2></a>
                </div>
                <div class="card__info">
                    {{card.price}} € a notte
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ServiceComponent from "./ServiceComponent";
    export default {
        components: {ServiceComponent},
        props: {
            card: Object
        },
        mounted() {
            console.log('Component Card mounted.')
        }
    }
</script>

<style lang="scss" scoped>
    .card{
        &__header{
            display: flex;
            justify-content: center;
            width: 100%;
            height: 200px;
            a{
                display: inline-block;
                width: 100%;
                height: 100%;
                background-size: cover;
                background-position: center;
            }
        }
        &__img{
            width: 100%;
            height: 100%;
        }
    }
</style>
