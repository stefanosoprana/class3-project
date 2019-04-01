<template>
    <li class="services_item">
        <span v-html="service.icon"></span> {{service.name}}
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