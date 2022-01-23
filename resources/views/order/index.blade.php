@extends('layout.template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="options-buttons">
            <a class="btn btn-primary" href="{{route('order.create')}}">
                <i class="fas fa-plus"></i>  Nueva orden 
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
                                <th>Fecha de creación</th>
                                <th>Proveedor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($orders as $order)
                            
                            <tr>
                                <td>{{ $order->id}}</td>
                                <td>{{ $order->date}}</td>
                                <td>{{ $order->supplier->company_name}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route('remission', $order)}}"> 
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