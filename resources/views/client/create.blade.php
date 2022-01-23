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

			                		<select class="form-control" name="document_type_id" id="document_type_id" onchange="cambiarTipoDocumento()" required>
			                			@foreach ($document_type as $element)
			                			<option value="{{$element->id}}" description="{{$element->document}}">{{$element->document}}</option>
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
			                    <label class="control-label col-md-3" id="lblNombre">Nombre</label>
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

				                    <textarea class="form-control" rows="2" placeholder="Enter your address" name="address" id="address" required></textarea>

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
@section('script')
<script>
    function consultarDocumento() {

        var tipo_documento = $('#document_type_id option:selected').attr('description');
        var tipo_documento_id = $('#document_type_id').val();
        var documento = $('#number_document').val();
        if (tipo_documento === "DNI") {
            if (documento.length === 8) {
                consultarAPI(tipo_documento, documento);
            } else {
                toastr.error('El DNI debe de contar con 8 dígitos', 'Error');
                clearDatosPersona(false);
            }
        } else if (tipo_documento === "RUC") {
            if (documento.length === 11) {
                consultarAPI(tipo_documento, documento);
            } else {
                toastr.error('El RUC debe de contar con 11 dígitos', 'Error');
                clearDatosPersona(false);
            }
        }

        Consultamos nuestra BBDD
        $.ajax({
            dataType: 'json',
            type: 'post',
            url: '',
            data: {
                '_token': $('input[name=_token]').val(),
                'tipo_documento': tipo_documento_id,
                'documento': documento,
                'id': null
            }
        }).done(function(result) {
            if (result.existe) {
                toastr.error('El ' + tipo_documento + ' ingresado ya se encuentra registrado para un cliente',
                    'Error');
                clearDatosPersona(true);
            } else {
                if (tipo_documento === "DNI") {
                    if (documento.length === 8) {
                        consultarAPI(tipo_documento, documento);
                    } else {
                        toastr.error('El DNI debe de contar con 8 dígitos', 'Error');
                        clearDatosPersona(false);
                    }
                } else if (tipo_documento === "RUC") {
                    if (documento.length === 11) {
                        consultarAPI(tipo_documento, documento);
                    } else {
                        toastr.error('El RUC debe de contar con 11 dígitos', 'Error');
                        clearDatosPersona(false);
                    }
                }
            }
        });
    }

    function clearDatosPersona(limpiarDocumento) {
     if (limpiarDocumento)
            $('#number_document').val("");

        $('#name').val("");
        $('#lastname').val("");
    }

    function consultarAPI(tipo_documento, documento) {

        if (tipo_documento === 'DNI' || tipo_documento === 'RUC') {
            var url = (tipo_documento === 'DNI') ? '{{ route('getApidni', ':documento') }}' :
                '{{ route('getApiruc', ':documento') }}';
            url = url.replace(':documento', documento);
            var textAlert = (tipo_documento === 'DNI') ? "¿Desea consultar DNI a RENIEC?" :
                "¿Desea consultar RUC a SUNAT?";
            Swal.fire({
                title: 'Consultar',
                text: textAlert,
                icon: 'question',
                customClass: {
                    container: 'my-swal'
                },
                showCancelButton: true,
                confirmButtonColor: "#1ab394",
                confirmButtonText: 'Si, Confirmar',
                cancelButtonText: "No, Cancelar",
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    return fetch(url)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }

                            return response.json();
                        })
                        .catch(error => {
                            Swal.showValidationMessage(
                                `El documento ingresado es incorrecto`
                            );
                            clearDatosPersona(true);
                        })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.value !== undefined && result.isConfirmed) {
                    $('#documento').removeClass('is-invalid')
                    if (tipo_documento === 'DNI')
                        camposDNI(result);
                    else
                        camposRUC(result);

                    consultaExitosa();
                }
            });
        }
    }

    function cambiarTipoDocumento() {

        setLongitudDocumento();
    }

    function setLongitudDocumento() {
        var tipo_documento = $('#document_type_id option:selected').attr('description');
        console.log(tipo_documento)
        if (tipo_documento !== undefined && tipo_documento !== null && tipo_documento !== "" && tipo_documento.length >
            0) {

            switch (tipo_documento) {
                case 'DNI':
                    $('#entidad').text('Reniec')
                    $('#lblNombre').text('Nombre')
                    $("#number_document").attr('maxlength', 8);
                    break;

                case 'RUC':
                    $('#entidad').text('Sunat')
                    $('#lblNombre').text('Razón social')
                    $("#number_document").attr('maxlength', 11);
                    break;
            }
        }
    }



    function camposDNI(objeto) {
        console.log(objeto);
        if (objeto.value === undefined)
            return;

        if(objeto.value.success)
        {
            var nombres = objeto.value.data.nombres;
            var apellido_paterno = objeto.value.data.apellido_paterno;
            var apellido_materno = objeto.value.data.apellido_materno;
            var codigo_verificacion = objeto.value.data.codigo_verificacion;

            var nombre = "";
            if (nombres !== '-' && nombres !== "NULL") {
                nombre += nombres;
            }
            if (apellido_paterno !== '-' && apellido_paterno !== "NULL") {
                nombre += (nombre.length === 0) ? apellido_paterno : ' ' + apellido_paterno
            }
            if (apellido_materno !== '-' && apellido_materno !== "NULL") {
                nombre += (nombre.length === 0) ? apellido_materno : ' ' + apellido_materno
            }
            $("#name").val(nombre);
        }
        else{
            toastr.error('No se encontraron datos.')
        }
    }

    function camposRUC(objeto) {
        console.log(objeto)
        if (objeto.value === undefined)
            return;
        if(objeto.value.success)
        {
            var razonsocial = objeto.value.data.nombre_o_razon_social;
            var direccion = objeto.value.data.direccion;
            var departamento = objeto.value.data.ubigeo[0];
            var provincia = objeto.value.data.ubigeo[1];
            var distrito = objeto.value.data.ubigeo[2];
            var estado = objeto.value.data.estado;

            if (razonsocial != '-' && razonsocial != "NULL") {
                $('#name').val(razonsocial);
            }

            if (direccion != '-' && direccion != "NULL") {
                $('#address').val(direccion);
            }
        }
        else
        {
            toastr.error('No se encontraron datos.')
        }
    }

    function consultar() {
        var tipo = $('#document_type_id option:selected').attr('description')
        switch (tipo) {
            case 'DNI':
                // $('#entidad').text('Reniec')
                // consultarDocumento()
                break;
            case 'RUC':
                // $('#entidad').text('Sunat')
                // consultarDocumento()
                break;
        }

    }
</script>
@stop
