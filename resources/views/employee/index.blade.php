@extends('layout.template')

@section('content')
    <div class="row">
    	<div class="col-md-12 my-3">
    		<a class="btn btn-primary" href="/employee/create"><i class="fa fa-plus"></i> Nuevo Registro</a>
    	</div>
        <div class="col-md-12">
          	<div class="tile">
            	<div class="tile-body">
              		<div class="table-responsive">
		                <table class="table table-hover table-bordered" id="sampleTable">
							<thead  class="table-warning text-center">
			                    <tr>
			                        <th>Nombre</th>
			                      	<th>Cargo</th>
				                    <th>Email</th>
				                    <th>Usuario</th>
				                    <th>Acciones</th>
			                    </tr>
		                  	</thead>
							<tbody class="text-center">
		                  		@foreach ($employees as $element)
		                    	</tr>
		                      		<td>{{$element->name.' '.$element->lastname}}</td>
		                      		<td>{{$element->workstation->work}}</td>
		                      		<td>{{$element->email}}</td>
		                      		<td>{{$element->user->name}}</td>
		                      		<td>
		                      			
		                      			<a style="display: inline-flex;" class="btn btn-success flex-wrap align-content-center justify-content-center " href="{{route('employee.edit', $element)}}"><i class="fa fa-edit"></i></a>
		                      			<a style="display: inline-flex;" class="btn btn-danger flex-wrap align-content-center justify-content-center"  href="{{route('employee.destroy', $element)}}"><i class="fa fa-trash"></i></a>

		                      		</td>
		                    	</tr>
		                    	@endforeach
		                  	</tbody>
		                </table>
              		</div>
            	</div>
          	</div>
        </div>
    </div>
@endsection

@section('script')
<script type="text/javascript" src="/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
 <script type="text/javascript"> 

     $('#sampleTable').DataTable( {
    responsive: true
    } );

 </script>	
@endsection