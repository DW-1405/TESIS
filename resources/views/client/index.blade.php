@extends('layout.template')

@section('content')
<div class="row">
<div class="col-md-12">
        <div class="options-buttons">
            <a class="btn btn-primary" href="{{route('client.create')}}">
                <i class="fas fa-plus"></i>  Nuevo cliente
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
                                <th>Cliente</th>
                                <th>Celular</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($clients as $client)
                            
                            <tr >
                                <td>{{ $client->name.' '.$client->lastname}}</td>
                                <td>{{ $client->telephone}}</td>
                                <td>{{ $client->address}}</td>
                                <td class="col-md-2">
                                    <a class="btn btn-success" {{-- href="{{route('client.show', $client)}} "--}}>
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if ($user->workstation->work == "ADMINISTRATOR")
                                    <form style="display: inline;" action="{{route('client.destroy', $client)}}" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" value="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
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
 <script type="text/javascript"> 

     $('#sampleTable').DataTable( {
    responsive: true
    } );

 </script>	
@endsection