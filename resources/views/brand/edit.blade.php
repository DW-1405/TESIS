@extends('layout.template')

@section('content')

<div class="row d-flex justify-content-center">
    <div class="col-8">
        <div class="tile">
            <h3 class="tile-title">Editar Marca</h3>
            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{ route('brand.update', $brand) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="control-label col-md-3">{{__('Marca')}}</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="marca" name="brand" required value="{{$brand->brand}}">
                                </div>
                            </div>
                        </div>                          
                    </div>                          
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>{{__('Update')}}</button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-danger" href="/brands"><i
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