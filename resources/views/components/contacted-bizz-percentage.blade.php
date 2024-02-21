<div class="percentage-card">
    <div class="row">
        <div class="col">
            <p class="bg-title">Businesses Contacted</p>
        </div>

        <div class="col">

        </div>

        <div class="col">
            @if ($contactedPercentage!=0)
                @if ($contactedPercentage < 0)
                    <p class="bg-title error-bg">{{is_float($contactedPercentage) ? number_format($contactedPercentage, 2) : number_format($contactedPercentage, 0)}}% <i class="fa-solid fa-arrow-down"></i></p>
                @else
                    <p class="bg-title success-bg">{{is_float($contactedPercentage) ? number_format($contactedPercentage, 2) : number_format($contactedPercentage, 0)}}% <i class="fa-solid fa-arrow-up"></i></p>    
                @endif     
            @endif
        </div>
    </div>
    <div class="row">
        <canvas id="contactedBusinessesPercentageChart"></canvas>
    </div>
</div>

<script>
const contactedBizz = document.getElementById('contactedBusinessesPercentageChart')
const contactedBizzJson = <?php echo json_encode($contactedBizzChart); ?>; 
const contactedPercentage = <?php echo json_encode($contactedPercentage); ?>; 

let bgColor = '#4643e81a'
let color = '#4543E8'

if(contactedPercentage>0) {
  bgColor = 'rgba(42, 247, 42, 0.329)'
  color = 'rgb(13, 143, 13)'
}else if (contactedPercentage<0) {
  bgColor = 'rgb(204, 23, 23, 0.3)'
  color = 'rgb(204, 23, 23)'
}

const contactedBizzData = {
    labels: Object.keys(contactedBizzJson),
    data: Object.values(contactedBizzJson),
}

new Chart(contactedBizz, {
type: 'line',
type: 'line',
data: {
  labels: contactedBizzData.labels,
  datasets: [{
    label: 'Contacted businesses',
    data: contactedBizzData.data,
    borderColor: color,
    borderWidth: 2,
    pointRadius: 2,
    pointStyle: 'none', // Hide the point style (square)
    pointHitRadius: 2,
    pointHoverRadius: 2,
    showLine: true,
    fill: 'origin', // Fill the area underneath the line up to the bottom of the chart
    backgroundColor: bgColor,
  }]
},
options: {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: false
  },
  scales: {
    x: {
      display: true
    },
    y: {
      display: true,
      min: 0
    }
  }
}
});
</script>