<template>
    <li class="services__item">
        <i v-bind:class="service.icon" v-bind:title="service.name"></i>
    </li>
</template>

<script>
    export default {
        props: {
            service: Object
        },
        mounted() {
            console.log('Service mounted.')
        }
    }
</script>

<style lang="scss" scoped>

</style>