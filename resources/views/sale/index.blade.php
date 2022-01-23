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