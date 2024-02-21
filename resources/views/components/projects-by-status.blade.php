
    <canvas id="cardTotalProjectsChart" ></canvas>


<script>
    const cardProjects = document.getElementById('cardTotalProjectsChart');
    const projectsByStatus = <?php echo json_encode($projectsByStatus) ;?>;

    const cardcardProjectsChartData = {
        labels: Object.keys(projectsByStatus),
        data: Object.values(projectsByStatus)
    }

    new Chart(cardProjects, {
    type: 'doughnut',
    data: {
        labels: cardcardProjectsChartData.labels,
        datasets: [{
        label: '# of Projects',
        data: cardcardProjectsChartData.data,
        backgroundColor: ['#2321DC', '#4543E8', '#6C6AF6', '#8D8BFD']
        }]
    },
    });
</script>