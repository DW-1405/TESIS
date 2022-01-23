@extends('layout.template')

@section('content')
<div class="row">
<div class="col-md-12">
        <div class="options-buttons">
            <a class="btn btn-primary" href="{{route('supplier.create')}}">
                <i class="fas fa-plus"></i>  Nuevo Proveedor
            </a>
        </div>

    </div>
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive ">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead  class="table-warning text-center">
                            <tr>
                                <th>Proveedor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($suppliers as $supplier)
                            
                            <tr >
                                <td>{{ $supplier->company_name}}</td>
                                <td class="col-md-4">
                                    <a class="btn btn-success" href="{{route('supplier.show', $supplier->id)}} ">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form style="display: inline;" action="{{route('supplier.destroy', $supplier)}}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" value="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
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