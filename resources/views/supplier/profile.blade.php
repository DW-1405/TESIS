@extends('layout.template')

@section('content')
<div class="row user">
    <div class="col-md-12">
        <div class="profile">
            <div class="info col-md-12">
                <img class="user-img" src="">
                <h4>{{$profile->company_name}}</h4>
                <p>PROVEEDOR</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="tile p-0">
            <ul class="nav flex-column nav-tabs user-tabs">
                <li class="nav-item"><a class="nav-link active" href="#user-settings" data-toggle="tab">Datos Generales</a></li>
            </ul>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">            
            <div class="tab-pane active" id="user-settings">
                <div class="tile user-settings">
                    <h4 class="line-head">Información</h4>
                    <form>
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label>Razón Social</label>
                                <input class="form-control" type="text" value="{{$profile->company_name}}" readonly>
                            </div>
                            <div class="col-md-5">
                                <label>Dirección</label>
                                <input class="form-control" type="text" value="{{$profile->address}}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4"> 
                                <label>Correo electrónico</label>
                                <input class="form-control" type="text" value="{{$profile->email}}" readonly>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-3 mb-3">
                                <label>Número de celular</label>
                                <input class="form-control" type="text" value="{{$profile->telephone}}" readonly>
                            </div>
                        </div>

                        {{-- <div class="row mb-10">
                            <div class="col-md-12">
                                <button class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i> Save</button>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
