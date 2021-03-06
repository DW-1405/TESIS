<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REPORTE DE COMPRAS</title>    
	<style>
        * {
            padding: 0;
            margin: 0;
            text-align: center;
            
        }
        .invoice{
            margin-top: 50px;
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
                
                <h2 >{{__(' REPORTE DE COMPRAS')}}</h2>
				<h3>del  {{$fi}} al {{$ff}} </h3>   
                   
        </div>
        _____________________________________________________________________________
        <div class="invoice-info" style="margin-top:10px  ">  
                <b>FECHA DE EMISION : {{\Carbon\Carbon::today('America/Lima')->format('d/m/Y')}} <br>
                <b class="text-uppercase">GENERADO POR : {{$user->name}}</b><br>   
        </div>
        
        
    </div>
    _____________________________________________________________________________
    <div style="margin-left: 70px;   line-height: 2;  " >
    
        <table class="table" >
            <thead >
                <tr> 
					<th class="spaceqty">ID</th>                  
                    <th class="spaceproduct">FECHA DE VENTA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $item)
                <tr>                    
					<td>{{$item->id}}</td>
                    <td>{{\Carbon\Carbon::parse($item->date)->format('d M y h:i a')}}</td>
                </tr>
                @endforeach                
            </tbody>
        </table> 
           
    </div>       
    _____________________________________________________________________________  
    <div style="width:650px; margin-left: 40px; margin-top:50px; margin-bottom:20px; " >
        Gr??fico de compras     
        <canvas id="venta_M" height="100" ></canvas>
    </div> 
    **Interpretaci??n: Las compras entre las fechas del reporte, se hicieron {{ number_format($compras->count()) }} pedidos.
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
	                    labels: [<?php foreach ($compras as $reg)
	                        { 
	                    echo '"'.\Carbon\Carbon::parse($reg->date)->format('M').'",';} ?>],
	                    datasets: [{
	                        label: 'compras',
	                        data: [<?php foreach ($compras as $reg)
	                            {echo ''.number_format($reg->count()).',';} ?>],
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