<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE DE VENTAS</title>    
	<style>
        * {
            padding: 0;
            margin: 0;
            text-align: center;
            
        }
        .invoice{
            padding: 50px;
            line-height: 1.5;
        }
        }
        .table, th, td{
            line-height: 4;      
        }
        .spaceqty
        {
            width: 180px;
        }
        .spaceproduct
        {
            width: 220px;
        }
        .spacedescription
        {
            width: 320px;
        }
        .total
        {
            text-align: center;
        }
        .imagen
        {
            width:175px; 
            height:125px;"
        }
    </style>
</head>

<body style="border: 1px;">

    <div class="invoice">
        <div class="invoice-title" style="margin-top: -20px;">               
                
                <h2 >{{__(' REPORTE DE VENTAS')}}</h2>
				<h3>del  {{$fi}} al {{$ff}} </h3>
        _________________________________________________________________________________             
        </div>
        <div class="invoice-info" style="margin-top:10px  ">  
                <b>FECHA DE EMISION : {{\Carbon\Carbon::today('America/Lima')->format('d/m/Y')}} <br>
                <b class="text-uppercase">GENERADO POR : {{$user->name}}</b><br>   
                <span>TOTAL DE INGRESOS: <strong>S/. {{ number_format($ventas->sum('total'),2) }}</strong> <b> </b></span> 
        </div>
        _________________________________________________________________________________
        
    </div>
    <div style="margin-left: 290px; margin-top:-50px;  line-height: 2;  " >
        <table class="table" >
            <thead >
                <tr> 
					<th class="spaceqty">ID</th>                  
                    <th class="spaceproduct">FECHA DE VENTA</th>
                    <th class="spaceproduct">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $item)
                <tr>                    
					<td>{{$item->id}}</td>
                    <td>{{\Carbon\Carbon::parse($item->date)->format('d M y h:i a')}}</td>
                    <td>{{$item->total}}</td>
                </tr>
                @endforeach                
            </tbody>
        </table>       
    </div>
    _________________________________________________________________________________

    <div style="width:900px; margin-left:180px; margin-top:10px; margin-bottom:10px; " >
            <canvas id="venta_M" height="80" ></canvas>
    </div> 
    **Interpretación: Las ventas entre las fechas del reporte, alcanzó un total de S/. {{ number_format($ventas->sum('total'),2) }}
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