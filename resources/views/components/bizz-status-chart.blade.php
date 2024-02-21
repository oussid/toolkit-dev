
    <canvas id="cardTotalBusinessesChart" ></canvas>


<script>
    const buisnessesByStatus = <?php echo json_encode($businessesByStatus); ?>;
    const cardBusinesses = document.getElementById('cardTotalBusinessesChart')

    const cardBusinessesChartData = {
        labels: Object.keys(buisnessesByStatus),
        data: Object.values(buisnessesByStatus)
    }

    new Chart(cardBusinesses, {
    type: 'doughnut',
    data: {
        labels: cardBusinessesChartData.labels,
        datasets: [{
        label: '# of Businesses',
        data: cardBusinessesChartData.data,
        backgroundColor: ['#2321DC', '#6C6AF6'],
        minBarLength: 5,
        }]
    },
    });
</script>