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
                        <h5 class="text-right">Fecha: {{$sale->date}}</h5>
                    </div>
                </div>
                <div class="row invoice-info">
                    <div class="col-4">Negocio
                        <address><strong>Comercial Alex</strong><br>Calle Trujillo 504<br>Chepén, La Libertad <br>
                    Telf. 044-562536                  </div>
                    <div class="col-4">Cliente
                        <address>
                            <strong>{{$sale->client->name.' '.$sale->client->lastname}}</strong>
                            <br>{{$sale->client->address}}
                            <br>Celular: {{$sale->client->telephone}}
                        </address>
                    </div>
                    <div class="col-4">
                        <b>{{$sale->voucher_type->type}} : {{$sale->code}}</b><br><br>
                        <b>Vendedor :</b> {{$sale->user->employee->name.' '.$sale->user->employee->lastname}}<br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Cantidad</th>
                                    <th>Producto</th>
                                    <th>Descripción</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $i)
                                    @foreach ($details as $item)
                                        @if ($item->id == $i->id)
                                            <tr>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->product->name}}</td>
                                                <td>{{$item->product->description}}</td>
                                                <td>S/. {{$item->amount}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                            @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                </div > 
                <div class="col-12 text-center">
                    <br><h5 ><b style="color:red;">TOTAL A PAGAR: <b style="color:black;"> S/. {{$sale->total}}</h5> <p>                   
                </div>                                
                <div class="row d-print-none mt-2">
                    <div class="col-12 text-right">
                        <a class="btn btn-primary" href="{{route('print', $sale)}}"  target="_blank"{{-- onclick="event.preventDefault(); document.getElementById('print').submit();"--}}>
                            <i class="fa fa-print"></i> Imprimir
                        </a>
                        {{-- <form id="print" action="{{ route('print', $sale) }}" method="get" class="d-none">
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