<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Venta</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                color: black;
            }

            .cabecera{
                width: 100%;
                position: relative;
                height: 100px;
                max-height: 150px;
            }

            .logo {
                width: 25%;
                position: absolute;
                left: 0%;
            }

            .logo .logo-img
            {
                position: relative;
                width: 95%;
                margin-right: 5%;
                height: 90px;
            }

            .img-fluid {
                width: 100%;
                height: 100%;
            }

            .empresa {
                width: 45%;
                position: absolute;
                left: 25%;
            }

            .empresa .empresa-info {
                position: relative;
                width: 100%;
            }

            .nombre-empresa {
                font-size: 16px;
            }

            .ruc-empresa {
                font-size: 15px;
            }

            .direccion-empresa {
                font-size: 12px;
            }

            .text-info-empresa {
                font-size: 12px;
            }

            .comprobante {
                width: 30%;
                position: absolute;
                left: 70%;
            }

            .comprobante .comprobante-info {
                position: relative;
                width: 100%;
                display: flex;
                align-content: center;
                align-items: center;
                text-align: center;
            }

            .numero-sale {
                margin: 1px;
                padding-top: 20px;
                padding-bottom: 20px;
                border: 1px solid #8f8f8f;
                font-size: 14px;
            }

            .informacion{
                width: 100%;
                position: relative;
            }

            .tbl-informacion {
                width: 100%;
                font-size: 12px;
            }

            .cuerpo{
                width: 100%;
                position: relative;
            }

            .tbl-detalles {
                width: 100%;
                font-size: 12px;
            }

            .tbl-detalles thead{
                border-top: 1px solid;
                background-color: rgb(241, 239, 239);
            }

            .tbl-detalles tbody{
                border-top: 1px solid;
                border-bottom: 1px solid;
            }

            .text-cuerpo{
                font-size: 12px
            }

            .tbl-qr {
                width: 100%;
            }
            /---------------------------------------------/

            .m-0{
                margin:0;
            }

            .text-uppercase {
                text-transform: uppercase;
            }

            .p-0{
                padding:0;
            }
        </style>
    </head>

    <body>
        <div class="cabecera">
            <div class="logo">
                <div class="logo-img">
                    <img src="../public/img/com-alex.png" class="img-fluid">                    
                </div>
            </div>
            <div class="empresa">
                <div class="empresa-info">
                    <p class="m-0 p-0 text-uppercase nombre-empresa">{{__(' COMERCIAL ALEX')}}</p>
                    <p class="m-0 p-0 text-uppercase ruc-empresa">R.U.C: 20481359512</p>
                    <p class="m-0 p-0 text-uppercase direccion-empresa">Calle Trujillo 504</p>

                    <p class="m-0 p-0 text-info-empresa">Telf. 044-562536 </p>
                </div>
            </div>
            <div class="comprobante">
                <div class="comprobante-info">
                    <div class="numero-sale">
                        <p class="m-0 p-0 text-uppercase">{{$sale->voucher_type->type}} DE VENTA</p>
                        <p class="m-0 p-0 text-uppercase">{{$sale->voucher_type->serie." - ".$sale->id}}</p>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="informacion">
            <table class="tbl-informacion">
                <tr>
                    <td>FECHA DE EMISIÓN</td>
                    <td>:</td>
                    <td>{{$sale->date}}</td>
                </tr>
                <tr>
                    <td>CLIENTE</td>
                    <td>:</td>
                    <td> {{$sale->client->name.' '.$sale->client->lastname}}</td>
                </tr>
                <tr>
                    <td class="text-uppercase">D.N.I</td>
                    <td>:</td>
                    <td>{{$sale->client->number_document}}</td>
                </tr>
                <tr>
                    <td>EMPLEADO</td>
                    <td>:</td>
                    <td>{{$sale->user->employee->name.' '.$sale->user->employee->lastname}}</td>
                </tr>                
            </table>
        </div><br>
        <div class="cuerpo">
            <table class="tbl-detalles text-uppercase" cellpadding="5" cellspacing="0">
                <thead>
                    <tr >
                        <th style="text-align: left; width: 10%;">CANT</th>
                        <th style="text-align: left;  width: 35%;">PRODUCTO</th>
                        <th style="text-align: left;  width: 35%;">DESCRIPCION</th>
                        <th style="text-align: left;  width: 10%;">P. UNIT.</th>
                        <th style="text-align: right;  width: 10%;">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($data as $i)
                        @foreach ($details as $item)
                        @if ($item->id == $i->id)
                        <tr>
                            <td style="text-align: left">{{$item->quantity}}</td>
                            <td style="text-align: left">{{$item->product->name}}</td>
                            <td style="text-align: left">{{$item->product->description}}</td>
                            <td style="text-align: left">S/. {{$item->product->unit_price}}</td>
                            <td style="text-align: right;">S/. {{$item->amount}}</td>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                  
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" style="text-align:right">Total a pagar: S/.</th>
                        <th colspan="2" style="text-align:right"> {{$sale->total}}</th>
                    </tr>                   
                </tfoot>
            </table>   
            <br>
            <p class="p-0 m-0 text-uppercase text-cuerpo">SON: <b>{{ $legends[0]['value'] }}</b></p>
            <br>     
            <table class="tbl-qr">
                <tr>
                    <td style="width: 60%">
                       
                    </td>
                    <td style="text-align: right;">
                        @if($sale->ruta_qr)
                            <img src="{{ base_path() . '/storage/app/'.$sale->ruta_qr }}">
                        @endif
                        @if($sale->hash)
                            <p class="m-0 p-0" style="font-size: 9px;">Código Hash: {{ $sale->hash }}</p>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>