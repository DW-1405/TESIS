@extends('layout.template')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <section class="invoice">
                <div class="row mb-4">
                    <div class="col-6">
                        <h2 class="page-header"><i class="fa fa-globe"></i>{{__(' Comercial Alex')}}</h2>
                    </div>
                    <div class="col-6">
                        <h5 class="text-right">Fecha de Pedido: {{$order->date}}</h5>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-4">Negocio
                        <address><strong>Comercial Alex</strong><br>Calle Trujillo 504<br>Chepén, La Libertad <br>
                    Telf. 044-562536                  </div>
                    <div class="col-4">Proveedor
                        <address>
                            <strong>{{$order->supplier->company_name}}</strong>
                            <br>{{$order->supplier->address}}
                            <br>Celular: {{$order->supplier->telephone}}
                        </address>
                    </div>
                    <div class="col-4">
                        <b>N° Orden : 001 - {{$order->id}}</b><br><br>
                        <b>Gerente :</b> {{$order->user->employee->name.' '.$order->user->employee->lastname}}<br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped ">
                            <thead>
                                <tr>                                   
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $i)
                                    @foreach ($details as $item)
                                        @if ($item->id == $i->id)
                                            <tr>                                               
                                                <td>{{$item->product->name}}</td>
                                                <td>{{$item->product->description}}</td>
                                                <td>{{$item->product_quantity}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                            @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div >                               
                <div class="row d-print-none mt-2">
                    <div class="col-12 text-right">
                        <a class="btn btn-primary" href="{{route('printer', $order)}}"  target="_blank"{{-- onclick="event.preventDefault(); document.getElementById('print').submit();"--}}>
                            <i class="fa fa-print"></i> Imprimir
                        </a>
                        {{-- <form id="print" action="{{ route('printer', $order) }}" method="get" class="d-none">
                            @csrf
                        </form> --}}
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@section('script')

@endsection