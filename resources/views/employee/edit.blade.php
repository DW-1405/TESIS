@extends('layout.template')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="tile">
            <h3 class="tile-title">Actualizar Empleado</h3>
            <div class="tile-body">
                <form class="form-horizontal" method="POST" action="{{ route('employee.update', $employee) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Nombre</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="text" placeholder="names" name="name" value="{{$employee->name}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Apellidos</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="type" placeholder="lastnames" name="lastname" value="{{$employee->lastname}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3" for="exampleSelect1">Tipo de documento</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="exampleSelect1" name="document_type_id" required>
                                        <option value="0">Select document type</option>
                                        @foreach($documentType as $document)
                                        <option value="{{$document->id}}" @if($employee->document_type->id == $document->id)
                                            selected ="selected"
                                            @endif
                                            >{{$document->document}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Número de documento</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="type" placeholder="Number document" name="number_document" value="{{$employee->number_document}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Fecha de nacimiento</label>
                                <div class="col-md-8">
                                    <input class="form-control" id="demoDate" type="date" placeholder="Select Date" name="date_birth" value="{{$employee->date_birth}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="control-label col-md-3">Correo electrónico</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="email" placeholder="Exemple@exemple.com" name="email" value="{{$employee->email}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Número de celular</label>
                                <div class="col-md-8">
                                    <input class="form-control" type="type" placeholder="telephone" name="telephone" value="{{$employee->telephone}}" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3" for="exampleSelect1">Cargo</label>
                                <div class="col-md-8">
                                    <select class="form-control" id="exampleSelect1" name="workstation_id" required>
                                        @foreach($workstation as $work)
                                        <option value="{{$work->id}}" @if($employee->workstation->id == $work->id)
                                            selected="selected"
                                            @endif
                                            >{{$work->work}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3">Dirección</label>
                                <div class="col-md-8">
                                    <textarea class="form-control" rows="2" placeholder="Enter your address" name="address"required>{{$employee->address}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-3">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="/employee"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
