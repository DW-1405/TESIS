@extends('layout.template')
@section('content')
<div class="row">
<div class="col-md-12 ">
       
	</div>
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                <div class="white-box">
	        <div class="text-center">
		        <strong><span>TOP PRODUCTOS MÁS VENDIDOS <b> </b></span></strong>
		    <div class="form-group">
		</div>
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead  class="table-warning text-center">
                            <tr>
                                <th>Código</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                                @foreach ($productosv as $prod)
                                <tr>                       
                                    <td>{{$prod->id}}</td>
                                    <td>{{$prod->nombre}}</td>
                                    <td>{{$prod->cantidad}}</td>
                                </tr>
                                @endforeach   
                        </tbody>
                        </tbody>
                        
                    </table>
                    <form action="{{route('almacen.pdf')}}" method="POST">
                    @csrf
                    <div class="text-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-sm">Vista previa</button>
                        </div>
                    </div>        
                </div>
            </div>
        </div>
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