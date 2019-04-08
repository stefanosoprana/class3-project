    import { Bar, mixins } from 'vue-chartjs';
    const { reactiveProp } = mixins;

    export default {
        extends: Bar,
        mixins: [mixins.reactiveProp], //necessario per update dati
        props: {
            chartdata: {
                type: Object,
                default: null
            },
            options: {
                type: Object,
                default: null
            }
        },
        mounted() {
            this.renderChart(this.chartData, this.options)

        }
    }
