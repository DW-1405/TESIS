<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Pedido </title>
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
            width: 100px;
        }
        .spaceproduct
        {
            width: 220px;
        }
        .spacedescription
        {
            width: 320px;
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
            <h3>ORDEN DE PEDIDO <br> N°. 001 - {{$order->id}}</h3>            
        </div>
        _________________________________________________________________________________
        <div class="invoice-info">           
            <div class="left">
                <b>FECHA DE EMISION :<br>
                <b>PROVEEDOR :</b><br>
                <b>IDENTIFICACIÓN:</b><br>
            </div>   
            <div class="right">
                {{$order->date}}<br>
                {{$order->supplier->company_name}}<br>
                {{$order->supplier->number_document}}<br>              
           
            </div>          
        </div>
        _________________________________________________________________________________
        
    </div>
    <div >
        <table class="table" >
            <thead >
                <tr>                   
                    <th class="spaceproduct">Producto</th>
                    <th class="spacedescription">Descripción</th>
                    <th class="spaceqty">Cantidad</th>
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
    _________________________________________________________________________________
    <div>
         <h3 style="margin-top:100px;" >
                __________________________<br>
         </h3>   
         <h3 style="margin-top:15px;" > 
                {{$order->user->employee->name.' '.$order->user->employee->lastname}}<br>
                {{$order->user->employee->workstation->work}}
         </h3>            
    </div> 
               
</body>

</html>