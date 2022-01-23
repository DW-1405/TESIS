@extends('layout.template')

@section('content')
<div class="row">
	<div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Registrar Cliente</h3>
            <div class="tile-body">

              	<form class="form-horizontal" method="POST" action="{{ route('client.store') }}">
              		@csrf

              		<div class="row">
	              		<div class="col-md-6">
                            <div class="form-group row">
			                	<label class="control-label col-md-3">Tipo de documento</label>
			                	<div class="form-group col-md-8">

			                		<select class="form-control" name="document_type_id" required>
			                			@foreach ($document_type as $element)
			                			<option value="{{$element->id}}">{{$element->document}}</option>
			                			@endforeach
			                		</select>
			                	</div>
			                </div>
			                <div class="form-group row">
				                <label class="control-label col-md-3">Número de documento</label>
				                <div class="col-md-8">
                                    <div class="input-group">
                                        <input id="number_document" class="form-control" type="text" placeholder="Enter number document" name="number_document" required>
                                        <span class="input-group-append"><a style="color:white" class="btn btn-primary" onclick="consultarDocumento()"><i class="fa fa-search"></i> <span
                                                    id="entidad">Entidad</span></a></span>


                                    </div>
				                </div>
			                </div>
			                <div class="form-group row">
			                    <label class="control-label col-md-3">Nombre</label>
			                  	<div class="col-md-8">

			                    	<input id="name" class="form-control" type="text" placeholder="Enter names" name="name" required>


			                  	</div>
			                </div>
			                <div class="form-group row">
				                <label class="control-label col-md-3">Apellidos</label>
				                <div class="col-md-8">

				                    <input class="form-control" type="text" placeholder="Enter lastnames" name="lastname" required>



				                </div>
			                </div>

			            </div>
		                <div class="col-md-6" >

			                <div class="form-group row">
				                <label class="control-label col-md-3">Número de celular</label>
				                <div class="col-md-8">

				                    <input class="form-control" type="text" placeholder="Enter number telephone" name="telephone" required>



				                </div>
			                </div>
		                	<div class="form-group row">
		                  		<label class="control-label col-md-3">Dirección</label>
				                <div class="col-md-8">

				                    <textarea class="form-control" rows="2" placeholder="Enter your address" name="address" required></textarea>

				                </div>
		                	</div>

			            </div>
			        </div>
					<div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-danger" href="/clients"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </div>
                    </div>
              </form>
            </div>

          </div>
        </div>
</div>
@endsection
