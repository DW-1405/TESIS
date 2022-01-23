@extends('layout.template')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">Registrar Categoria</h3>
            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{route('category.store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="control-label col-md-3">{{__('Categoria')}}</label>
                                    <div class="col-md-8">
                                        <input class="form-control" type="text" placeholder="categoria" name="category"
                                            required autofocus>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a
                                    class="btn btn-danger" href="/categorys"><i
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