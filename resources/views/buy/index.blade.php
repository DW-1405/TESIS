@extends('layout.template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="options-buttons">
            <a class="btn btn-primary" href="{{route('buy.create')}}">
                <i class="fas fa-plus"></i>  Nueva compra
            </a>
        </div>

    </div>
    <div class="col-md-12">
        <div class="tile">  
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bbuyed" id="sampleTable">
                    <thead  class="table-warning text-center">
                            <tr>
                                <th>Código</th>
                                <th>Fecha de actualización</th>
                                <th>Proveedor</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($buys as $buy)
                            
                            <tr>
                                <td>{{ $buy->id}}</td>
                                <td>{{ $buy->updated_at}}</td>
                                <td>{{ $buy->order->supplier->company_name}}</td>
                                <td>{{ $buy->state}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route('buy.edit', $buy)}}">
                                        <i class="fas fa-edit"></i>
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