@extends('layout.template')
@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead  class="table-warning text-center">
                            <tr>
                                <th>Código</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th style="width:50px;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                                @foreach ($ventas as $venta)
                                <tr>                                        
                                    <td>{{$venta->id}}</td>
                                    <td>{{\Carbon\Carbon::parse($venta->date)->format('d M Y')}}</td>
                                    <td>{{$venta->total}}</td>
                                    <td class="text-center">
                                        <a href="{{route('print', $venta)}}" class="text-inverse p-r-10" data-toggle="tooltip" title="Imprimir"><i class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                                @endforeach     
                        </tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3 col-sm-5">
        <div class="white-box">
	        <div class="text-center">
		        <span>Total de ingresos: <b> </b></span>
		    <div class="form-group">
		    <strong>S/. {{ number_format($ventas->sum('total'),2) }}</strong>
		</div>
	</div>
	<form action="{{route('ventas.resultados')}}" method="POST">
		@csrf
		    <div class="form-group">
		        <span>Fecha inicial</span>
		        <div class="input-group">
		            <input class="form-control" type="date" name="fecha_ini" id="fecha_ini" min="2022-01-01">
		        </div>
		    </div>
		    <div class="form-group">
		            <span>Fecha final</span>
		            <div class="input-group">
		                <input class="form-control" type="date" name="fecha_fin" id="fecha_fin" min="2022-01-01">
		            </div>
		    </div>
		    <div class="text-center">
		        <div class="form-group">
		            <button type="submit" class="btn btn-primary btn-sm">Consultar</button>
		        </div>
		    </div>
	</form>
    <form action="{{route('ventas.pdf')}}" method="POST">
        @csrf
        <div class="text-center">
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Vista previa</button>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input class="form-control" type="hidden" name="fi" id="fi" min="2022-01-01" value="{{$fi}}">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input class="form-control" type="hidden" name="ff" id="ff" min="2022-01-01" value="{{$ff}}">
            </div>
        </div> 
    </form>   
    </div>
</div> 
@section('scripts')
	<script>
		$(function() {
            $('#myTable').DataTable();
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    "columnDefs": [{
                        "visible": false,
                        "targets": 2
                    }],
                    "order": [
                        [2, 'asc']
                    ],
                    "displayLength": 25,
                    "drawCallback": function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function(group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                                }
                            });
                        }
                    });
                });
            });



    	window.onload = function(){
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = fecha.getDate(); //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
          dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
          mes='0'+mes //agrega cero si el menor de 10
        document.getElementById('fecha_fin').value=ano+"-"+mes+"-"+dia;
      }
	</script>
@endsection
@endsection