@extends('layout.template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="options-buttons">
            <a class="btn btn-primary" href="{{route('sale.create')}}">
                <i class="fas fa-plus"></i>  Nueva venta
            </a>
        </div>

    </div>
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                    <thead  class="table-warning text-center">
                            <tr>
                                <th>Código</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Comprobante</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($sales as $sale)

                            <tr>
                                <td>{{ $sale->code}}</td>
                                <td>{{ $sale->date}}</td>
                                <td>{{ $sale->client->name.' '. $sale->client->lastname}}</td>
                                <td>{{ $sale->user->name}}</td>
                                <td>{{ $sale->voucher_type->type}}</td>
                                <td>{{ $sale->total}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route('invoice', $sale)}}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($sale->sunat == '0')
                                    <a class="btn btn-primary" href="#" onclick="enviarSunat({{$sale->id}})">
                                        <i class="fa fa-send"></i>
                                        Sunat
                                    </a>
                                    @endif
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
 <script>

    @if(!empty($sunat_exito))
        Swal.fire({
            icon: 'success',
            title: '{{$id_sunat}}',
            text: '{{$descripcion_sunat}}',
            showConfirmButton: false,
            timer: 2500
        })
    @endif

    @if(!empty($sunat_error))
        Swal.fire({
            icon: 'error',
            title: '{{$id_sunat}}',
            text: '{{$descripcion_sunat}}',
            showConfirmButton: false,
            timer: 5500
        })
    @endif

    $('#sampleTable').DataTable( {
        responsive: true
    } );

    function enviarSunat(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger',
            },
            buttonsStyling: false
        })

        Swal.fire({
            title: "Opción Enviar a Sunat",
            text: "¿Seguro que desea enviar documento de venta a Sunat?",
            showCancelButton: true,
            icon: 'info',
            confirmButtonColor: "#1ab394",
            confirmButtonText: 'Si, Confirmar',
            cancelButtonText: "No, Cancelar",
            // showLoaderOnConfirm: true,
        }).then((result) => {
            if (result.value) {

                var url = '{{ route("sale.sunat", ":id")}}';
                url = url.replace(':id',id);

                window.location.href = url

                Swal.fire({
                    title: '¡Cargando!',
                    type: 'info',
                    text: 'Enviando documento de venta a Sunat',
                    showConfirmButton: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    }
                })

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'La Solicitud se ha cancelado.',
                    'error'
                )
            }
        })

    }

 </script>
@endsection
