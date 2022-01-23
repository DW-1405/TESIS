@extends('layout.template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="sampleTable">
                        <thead  class="table-warning text-center">
                            <tr>
                                <th>Usuario</th>
                                <th>Cargo</th>
                                <th>Correo electrónico</th>

                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($data as $us)
                            <tr>
                                <td>{{ $us->name}}</td>
                                <td>{{ $us->employee->workstation->work}}</td>
                                <td>{{ $us->employee->email}}</td>
                                {{-- <td>
                                    <a class="btn btn-success" href="#">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form style="display: inline;" action="#" method="POST">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" value="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td> --}}

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