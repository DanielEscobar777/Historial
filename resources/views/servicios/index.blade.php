@extends('layouts.header')

@section('content')

<div class="col-12">
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a class="text-danger">SERVICIO</a></li>
        <li class="breadcrumb-item"><a>TABLERO</a></li>
    </ol>
    <h1 class="page-header mb-3 text-danger">SERVICIO</h1>
</div>
<div class="col-md-5 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b> AGREGAR NUEVO SERVICIO </b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <form class="needs-validation" action="{{ route('servicios.store')}}" method="POST" autocomplete="off" novalidate>
                @csrf
                @method('POST')
                <div class="col-12 col-md-12">
                    <label><b>NOMBRE SERVICIO</b></label>
                    <input type="text" class="form-control" name="nombre_servicio" placeholder="Escriba....." required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                    <div class="invalid-feedback">
                        LLene el campo.
                    </div>
                </div><br>
                <button class="btn btn-success"><i class="fa fa-save me-1"></i>GUARDAR</button>
            </form>
        </div>

    </div>
</div>
<div class="col-md-7 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b> REGISTRO DE SERVICIO </b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <table id="table" class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                <!-- buttons: agregar para botones-->
                <thead style="background-color: #c5cacf;">
                    <tr>
                        <th>ITEM</th>
                        <th>NOMBRE SERVICIO</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $servicios as $servicio)
                    <tr class="align-middle">
                        <td>{{ $servicio->id_servicio}}</td>
                        <td>{{ $servicio->nombre_servicio}}</td>
                        <td class="text-center">
                            <a href="{{ route('servicios.administrar',$servicio->id_servicio )}}"><button class=" btn btn-primary"><i class=" fa fa-file "></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection