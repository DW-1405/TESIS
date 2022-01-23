@extends('layout.template')

@section('content')
<div class="row">
    @if ($user->workstation->work == "ADMINISTRADOR")
    <div class="col-md-12">
        <div class="options-buttons">
            <a class="btn btn-primary" href="{{route('product.create')}}">
                <i class="fas fa-plus"></i> Nuevo Producto
            </a>
        </div>   
    </div>
    @endif
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead  class="table-warning text-center">
                            <tr>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Categoria</th>
                                <th>Precio Unitario</th>
                                <th>Cantidad</th>
                                @if ($user->workstation->work == "ADMINISTRADOR")
                                <th>Acciones</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($products as $product)
                            
                            <tr>
                                <td>{{ $product->name}}</td>
                                <td>{{ $product->brand->brand}}</td>
                                <td>{{ $product->product_categories->category}}</td>
                                <td>{{ $product->unit_price}}</td>
                                <td>{{ $product->stock}}</td>
                                @if ($user->workstation->work == "ADMINISTRADOR")
                                <td>
                                    <a class="btn btn-success" href="{{route('product.edit', $product)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form style="display: inline;" action="{{route('product.destroy', $product)}}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" value="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                @endif
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