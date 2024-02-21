<div class="dashboard-card full-width">
    <div class="card-section spacebetween">
        <div class="section-block">
            <p class="bg-title">Revenue</p>
        </div>
        <div class="section-block">
            <h2 class="card-counter">£{{number_format($total, 2, '.', ',');}}</h2>
        </div>
        <form action="/" method="GET" class="section-block" id="revYearForm" >
            <select name="rev_year" onchange="submitForm()" >
                @foreach ($years as $year)
                <option {{ (request()->query('rev_year') && request()->query('rev_year')==$year) ? 'selected' : '' }} value="{{$year}}" >{{$year}}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="card-section medium-height">
        <canvas id="cardRevenueChart" width="100%"></canvas>
    </div>

</div>

<script>
const yearForm = document.getElementById('revYearForm')
const cardRevenue = document.getElementById('cardRevenueChart');
let revenue = <?php echo json_encode($revenue) ?> ;

const submitForm = () => {
    if(yearForm) {
        yearForm.submit()
    }
}

new Chart(cardRevenue, {
type: 'line',
data: {
    labels: Object.keys(revenue),
    datasets: [{
        label: 'Revenue',
        data: Object.values(revenue),
        borderWidth: 1,
        borderColor: '#4543E8',
        fill: true,
        backgroundColor: '#4643e81a',
        pointRadius: 2,
        showLine: true,
    }]
},
options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
    y: {
        beginAtZero: true,
        display: true
    },
    x: {
        display: true 
    },
    }
}

});
</script>