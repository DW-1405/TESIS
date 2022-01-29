<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Venta</title>    
    <body>  
        <div >
            <canvas id="venta_M" height="150"></canvas>
        </div> 
    </body>        
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script src="/js/chart/Chart.min.js"></script>
<script src="/js/chart/dashboard.js"></script>
<script type="text/javascript">

    new Chart(document.getElementById("venta_M"),
	        {
	            type: 'line',
	                data: {
	                    labels: [<?php foreach ($ventas as $reg)
	                        { 
	                    echo '"'.\Carbon\Carbon::parse($reg->date)->format('d-m-Y').'",';} ?>],
	                    datasets: [{
	                        label: 'Ventas',
	                        data: [<?php foreach ($ventas as $reg)
	                            {echo ''.number_format($reg->total,2).',';} ?>],
	                        "borderColor":"rgb(83, 230, 157)",
	                        "fill":false,
	                        "lineTension":0.1
	                    }]
	                },
	                options: {
	                    scales: {
	                        yAxes: [{
	                            ticks: {
	                                beginAtZero:false
	                            }
	                        }]
	                    }
	                }
	            });
</script>