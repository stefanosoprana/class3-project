<script>
    import { Bar } from 'vue-chartjs';

    export default {
        extends: Bar,
        mounted() {
            let href = window.location.href.split('/');
            let host = href[2];
            let idApartment = href[href.length - 2];
            let urlApi = '/api/v1/apartment/';

            let url = 'http://'+host+urlApi+idApartment+'/visits';
            let labels = [];
            let visits = [];

            this.axios({
                method:'get',
                url: url,
                headers: {'Authorization': 'Bearer 123_Pippo_Pluto'}
            }).then((response) => {
                let data = response.data.result;
                let visitsData = data.visits;
                if(visitsData) {
                    visitsData.labels.forEach(
                        function (element) {
                            labels.push(element);
                        }
                    );
                    visitsData.number.forEach(
                        function (element) {
                            visits.push(element);
                        }
                    );
                    this.renderChart({
                        labels: labels,
                        datasets: [{
                            label: 'Visite',
                            backgroundColor: '#FC2525',
                            data: visits
                        }]
                    }, {
                        responsive: true, maintainAspectRatio: false
                    })
                }
                else {
                    console.log('No data');
                }
            });
        }
    }
</script>