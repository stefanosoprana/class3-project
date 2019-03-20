<script>
    import { Bar } from 'vue-chartjs';

    export default {
        extends: Bar,
        mounted() {
            let href = window.location.href.split('/');
            let host = href[2];
            let idApartment = href[href.length - 2];
            let urlApi = '/api/v1/apartment/';

            let url = 'http://'+host+urlApi+idApartment+'/messages';
            let labels = [];
            let messages = [];

            this.axios({
                method:'get',
                url: url,
                headers: {'Authorization': 'Bearer 123_Pippo_Pluto'}
            }).then((response) => {
                let data = response.data.result;
                let messagesData = data.messages;
                console.log(data.messages);
                if(messagesData) {
                    messagesData.labels.forEach(
                        function (element) {
                            labels.push(element);
                        }
                    );
                    messagesData.number.forEach(
                        function (element) {
                            messages.push(element);
                        }
                    );
                    this.renderChart({
                        labels: labels,
                        datasets: [{
                            label: 'Messages',
                            backgroundColor: '#FC2525',
                            data: messages
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