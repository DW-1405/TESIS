@extends('layout.template')

@section('content')
<div class="row">
	<div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Registrar Proveedor</h3>
            <div class="tile-body">

              	<form class="form-horizontal" method="POST" action="{{ route('supplier.store') }}">
              		@csrf

              		<div class="row">
	              		<div class="col-md-6">
			                <div class="form-group row">
			                    <label class="control-label col-md-3">Razón social</label>
			                  	<div class="col-md-8">

			                    	<input id="company_name" class="form-control" type="text" placeholder="Enter company name" name="company_name" required>


			                  	</div>
			                </div>
			                
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

				                    <input id="number_document" class="form-control" type="text" placeholder="Enter number document" name="number_document" required>

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

							<div class="form-group row">
		                  		<label class="control-label col-md-3">Correo electrónico</label>
				                <div class="col-md-8">

				                    <textarea class="form-control" rows="2" placeholder="Enter your email" name="email" required></textarea>

				                </div>
		                	</div>
			            </div>
			        </div>
					<div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-danger" href="/supplier"><i
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
