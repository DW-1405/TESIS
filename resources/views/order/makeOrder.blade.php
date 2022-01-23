@extends('layout.template')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <form action="{{route('order.store')}}" method="POST">
                    @csrf
                    <div class="row ">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="d-flex flex-wrap align-content-center"
                                    for="suppliers"><strong>{{__('Proveedor')}}</strong></label>
                                <select class="form-control" name="supplier" id="supplier">
                                    @foreach ($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">
                                        {{$supplier->company_name.'  --  '.$supplier->number_document}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="d-flex flex-wrap align-content-center"
                                    for="exampleSelect1"><strong>{{__('Producto')}}</strong></label>
                                <select class="form-control" id="products">
                                    @foreach ($categories as $category)
                                    <optgroup label="{{$category->category}}">
                                        @foreach ($products as $product)
                                        @if ($product->product_categories->id == $category->id)
                                        <option
                                            value="{{$product->id}}_{{$product->name}}">
                                            {{$product->name}}</option>
                                        @endif
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="d-flex flex-wrap align-content-center"
                                    for="quantiy"><strong>{{__('Cantidad')}}</strong></label>
                                <input class="form-control" type="number" id="quantity" placeholder="0" min="1" value="1">
                                <p id="error" class="text-danger font-weight-bold d-none">Cantidad requerida</p>
                            </div>
                        </div>
                        <div class="col-md-2 mt-1 pt-1 d-flex flex-wrap align-content-center">
                            <button class="btn btn-primary btn-block" id="add"> <i class="fas fa-plus"></i><span
                                    class="pl-2">{{__('Agregar')}}</span></button>
                        </div>
                        <div class="ml-3 col-md-5 d-none alert alert-danger" role="alert" id="error-exists">
                            <strong>Este producto ya está agregado</strong></div>
                        <div class="col-md-12">                           

                                <table id="detalle" class="table table-striped">

                                    <tr>
                                        <th>#</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Quitar</th>
                                    </tr>
                                </table>

                            </div>
                            <div class="tile-footer">
                                <input id="save" class="btn btn-success" type="submit" value="Registrar" >
                                <a href="{{route('order')}}" class="btn btn-danger">Volver</a>
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