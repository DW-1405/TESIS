@extends('layout.template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="options-buttons">
            <a class="btn btn-primary" href="{{route('category.create')}}">
                <i class="fas fa-plus"></i>  Nueva Categoria
            </a>
        </div>

    </div>
    <div class="col-md-12">
        <div class="tile">  
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered " id="sampleTable">
                        <thead  class="table-warning text-center">
                            <tr>
                                <th>Categorias</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($categories as $category)
                            
                            <tr>
                                <td>{{ $category->category}}</td>
                                <td>
                                    <a class="btn btn-success" href="{{route('category.edit', $category)}}">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form style="display: inline;" action="{{route('category.destroy', $category)}}" method="POST">
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
        responsive: true,
        autoFill: true  
    } );
    
 </script>	
@endsection