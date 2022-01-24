@extends('layout.template')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-8">
        <div class="tile">
            <h3 class="tile-title">Atender Pedido</h3>
            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{ route('buy.update', $buy) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3">{{__('N° Orden')}}</label>
                                <div class="col-md-2">
                                    <input class="form-control" type="text" placeholder="order" name="order_id" required value="{{$buy->order_id}}" readonly>
                                </div>
                            </div>
                        </div>                          
                    </div>  
                    <div class="form-group row">
                                <label class="control-label col-md-3" for="exampleSelect1">Estado</label>
                                <div class="col-md-4">
                                    <select class="form-control" name="state" name="state" value="{{$buy->state}}" required>                                
                                        <option >PENDIENTE</option>
                                        <option >ATENDIDO</option>
                                    </select>
                                </div>
                            </div>                         
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>{{__('Update')}}</button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-danger" href="/buy"><i
                                        class="fa fa-fw fa-lg fa-times-circle"></i>{{__('Cancel')}}</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection