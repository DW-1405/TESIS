@extends('layout.template')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">Registrar Producto</h3>
            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{route('product.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">{{__('Nombre')}}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" placeholder="names" name="name"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3">{{__('Descripción')}}</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control" rows="2" placeholder="Enter the description"
                                            name="description" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3"
                                        for="exampleSelect1">{{__('Categoria')}}</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="exampleSelect1" name="product_categories_id"
                                            required>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-md-3">{{__('Precio unitario')}}</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="text" placeholder="0.00" name="unit_price" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-md-3" for="exampleSelect1">{{__('Marca')}}</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="exampleSelect1" name="brand_id" required>
                                        @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->brand}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="from-group row">
                                <label class="control-label col-md-3" for="">{{__('Cantidad')}}</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="number" placeholder="0" name="stock" min="1" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-danger" href="/products"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection