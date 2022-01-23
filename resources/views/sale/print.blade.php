<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Venta</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            text-align:center;
        }
        .invoice{
            padding: 70px;
            line-height: 1.5;
        }
        }
        .table, th, td{
            text-align: center;
            margin-left: 70px;
            margin-top: -50px;
            line-height: 2;           
        }
        .spaceqty
        {
            width: 70px;
        }
        .spaceproduct
        {
            width: 160px;
        }
        .spacedescription
        {
            width: 220px;
        }
        .spacesubtotal
        {
            width: 90px;
        }    
        .spaceunitprice
        {
            width: 90px;
        }    
        .left
        {
            width: 340px; 
            text-align: right;
            margin-top: 15px;
        }
        .right
        {
            width: 300px; 
            margin-top:-100px;
            margin-left: 350px;
            text-align: left;
        }
        .total
        {
            text-align: center;
        }
        .imagen
        {
            width:175px; 
            height:125px;"
        }
    </style>
</head>

<body>

    <div class="invoice">
        <img class="imagen" src="../public/img/com-alex.png" alt="">
        <div class="invoice-title" style="margin-top: -20px;">               
                
                <h2 >{{__(' COMERCIAL ALEX')}}</h2>
                <address>
                    Calle Trujillo 504<br>
                    La Libertad, Chepén, Chepén<br>
                    R.U.C: 20481359512<br>
                    Telf. 044-562536 
                </address>  
        _________________________________________________________________________________             
        </div>
        
        <div style="margin-top: 15px">
            <h3>{{$sale->voucher_type->type}} DE VENTA <br> N°. {{$sale->code}}</h3>            
        </div>
        _________________________________________________________________________________
        <div class="invoice-info">           
            <div class="left">
                <b>FECHA DE EMISION :<br>
                <b>CLIENTE :</b><br>
                <b>D.N.I. :</b><br>
                <b>VENDEDOR :</b><br>
            </div>   
            <div class="right">
                {{$sale->date}}<br>
                {{$sale->client->name.' '.$sale->client->lastname}}<br>
                {{$sale->client->number_document}}<br>
                {{$sale->user->employee->name.' '.$sale->user->employee->lastname}}                 
           
            </div>          
        </div>
        _________________________________________________________________________________
        
    </div>
    <div >
        <table class="table" >
            <thead >
                <tr>
                    <th class="spaceqty">Cantidad</th>
                    <th class="spaceproduct">Producto</th>
                    <th class="spacedescription">Descripción</th>
                    <th class="spaceunitprice">Precio Unitario</th>
                    <th class="spacesubtotal">Subtotal</th>
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
                    <td>S/. {{$item->product->unit_price}}</td>
                    <td>S/. {{$item->amount}}</td>
                </tr>
                @endif
                @endforeach
                @endforeach
                
            </tbody>
            
            <div class="total">   
            _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _
                <br><h4>TOTAL A PAGAR: S/. {{$sale->total}}</h4>
            </div>
        </table>
       
    </div>
    _________________________________________________________________________________
    <div>
            <h3 style="margin-top:15px" >CONDICIONES: <br></h3>            
    </div> 
    <div>
            <p style="margin-top:10px">En electrodomésticos <br>
                - Garantía de 6 meses.  <br>
                - Garantía de accesorios de 7 dias.  <br>
                - Electrodoméstico de fábrica, nuevo y con sus accesorios.                
            </p> <br>   
            <b>¡Precios más bajos siempre!    
    </div>
                        
</body>

</html>