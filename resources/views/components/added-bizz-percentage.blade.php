<div class="percentage-card">
    <div class="row">
        <div class="col">
            <p class="bg-title">Businesses Added</p>
        </div>

        <div class="col">

        </div>

        <div class="col">
            @if ($addedPercentage!=0)
                @if ($addedPercentage < 0)
                    <p class="bg-title error-bg">{{ is_float($addedPercentage) ? number_format($addedPercentage, 2) : number_format($addedPercentage, 0)}}% <i class="fa-solid fa-arrow-down"></i></p>
                @else
                    <p class="bg-title success-bg">{{is_float($addedPercentage) ? number_format($addedPercentage, 2) : number_format($addedPercentage, 0)}}% <i class="fa-solid fa-arrow-up"></i></p>    
                @endif     
            @endif
            
        </div>
    </div>
    <div class="row">
        <canvas id="addedBusinessesPercentageChart"></canvas>
    </div>
</div>

<script>
const addedBizz = document.getElementById('addedBusinessesPercentageChart');
const addedBizzJson = <?php echo json_encode($addedBizzChart); ?>; 
const addedPercentage = <?php echo $addedPercentage; ?>; 

const addedBizzData = {
    labels: Object.keys(addedBizzJson),
    data: Object.values(addedBizzJson)
}

let bgColorAdded = '#4643e81a'
let colorAdded = '#4543E8'

if(addedPercentage>0) {
  bgColorAdded = 'rgba(42, 247, 42, 0.329)'
  colorAdded = 'rgb(13, 143, 13)'
}else if (addedPercentage<0) {
  bgColorAdded = 'rgb(204, 23, 23, 0.3)'
  colorAdded = 'rgb(204, 23, 23)'
}

new Chart(addedBizz, {
type: 'line',
type: 'line',
data: {
  labels: addedBizzData.labels,
  datasets: [{
    label: 'Added businesses',
    data: addedBizzData.data,
    borderColor: colorAdded,
    borderWidth: 2,
    pointRadius: 2,
    pointStyle: 'none', // Hide the point style (square)
    pointHitRadius: 2,
    pointHoverRadius: 2,
    showLine: true,
    fill: 'origin', // Fill the area underneath the line up to the bottom of the chart
    backgroundColor: bgColorAdded,
  }]
},
options: {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    legend: false
  },
  scales: {
    
    y: {
        min:0
    }
  }
}
});
</script>