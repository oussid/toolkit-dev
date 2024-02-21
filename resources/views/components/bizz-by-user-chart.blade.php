<canvas id="cardUserActivityChart" ></canvas>

<script>
    const bizzByUser = <?php echo json_encode($bizzByUser) ;?>;
    const cardChart = document.getElementById('cardUserActivityChart')
    const cardChartData = {
        labels: Object.keys(bizzByUser),
        data: Object.values(bizzByUser)
    }

    new Chart(cardChart, {
    type: 'doughnut',
    data: {
        labels: cardChartData.labels,
        datasets: [{
        label: "Today's Added Businesses",
        data: cardChartData.data,
        backgroundColor: ['#5f5deb', '#2321DC']
        }]
    },
    });
</script>