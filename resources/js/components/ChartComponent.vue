<script>
    import { Bar } from 'vue-chartjs';

    export default {
        extends: Bar,
        mounted() {
            //test
            console.log("mounted");
            let url = 'http://localhost:8000/api/v1/apartment/1/visits';
            let labels = [];
            let visits = [];

            this.axios({
                method:'get',
                url: url,
                headers: {'Authorization': 'Bearer 123_Pippo_Pluto'}
            }).then((response) => {
                let data = response.data.result;
                console.log(data.visits);
                if(data.visits) {
                    data.visits.labels.forEach(
                        function (element) {
                            labels.push(element);
                        }
                    );
                    data.visits.number.forEach(
                        function (element) {
                            visits.push(element);
                        }
                    );
                    this.renderChart({
                        labels: labels,
                        datasets: [{
                            label: 'Visite',
                            backgroundColor: '#FC2525',
                            data: Visits
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