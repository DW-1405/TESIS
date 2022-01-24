@extends('layout.template')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <form action="{{route('buy.store')}}" method="POST">
                    @csrf
                    <div class="row ">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="d-flex flex-wrap align-content-center"
                                    for="order"><strong>{{__(' N° Orden')}}</strong></label>
                                <select class="form-control" name="order" id="order">
                                    @foreach ($orders as $order)
                                    <option value="{{$order->id}}">
                                        {{$order->id}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                          
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-md-3">{{__('Estado')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text"  name="state" value = "PENDIENTE" readonly>
                                </div>
                        </div>
                        <div class="col-md-12">
                            <div class="tile-footer">
                                    <input id="save" class="btn btn-success" type="submit" value="Registrar" >
                                    <a href="{{route('buy')}}" class="btn btn-danger">Volver</a>
                                </div>
                        </div>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript" src="/js/plugins/select2.min.js"></script>
<script type="text/javascript">

    $('#products').select2();
    $('#supplier').select2();
    let index = 0;
    let i = 1;
    let list_Product = [];

    $('#add').click(function (e) {
        e.preventDefault();
        let product = $('#products').val().split('_');
        let quantity = $('#quantity').val();

        if (validate(quantity, product[0], product[3])) {
            let row = '<tr id="row' + index + '"><td><input type="hidden" name="list_products[]" value="' + product[0] + '"><input type="hidden" name="list_quantity[]" value="' + quantity + '">' + i++ + '</td><td>' + product[1] + '</td><td>' + quantity + '</td>'+'<td><button onclick="remove(' + index + ' , ' + (product[2]) + ' )" class="btn btn-danger"><i class="fas fa-minus"></i></button></td></tr>';
            $('#error').removeClass('d-block');
            $('#detalle').append(row);
            list_Product[index] = [product[0]];
            index++;
            $('#quantity').val(1);
            $('#error-exists').removeClass('d-block');
            $('#error-stock').removeClass('d-block');
        }

    });

    function remove(row) {
        $('#row' + row).remove();
        list_Product.splice(row);
        index--;
        i--;
    }

    function validate(units, id) {
        console.log(units);
            if (parseInt(units) != 0) {
                for (let count = 0; count < list_Product.length; count++) {
                    const element = list_Product[count];
                    if (element == id) {
                        $('#error-exists').addClass('d-block');
                        return false;
                    }
                }
                return true;
            } else {
                $('#error').addClass('d-block');
                return false;
            }
       
    }
</script>
@endsection