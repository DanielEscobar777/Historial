@extends('layouts.header')

@section('content')

<div class="col-12">
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a class="text-danger">SERVICIO</a></li>
        <li class="breadcrumb-item"><a href="{{ route('servicios.index') }}">TABLERO</a></li>
        <li class="breadcrumb-item active">EDITAR ACCESO</li>
    </ol>
    <h1 class="page-header mb-3 text-danger">Editar acceso a <strong>{{ $servicio->nombre_servicio }}</strong></h1>
</div>

<div class="row">
    <div class="col-md-12 col-12">
        <div class="panel" data-sortable-id="ui-general-1">
            <div class="panel-heading" style="background-color: #c5cacf;">
                <h4 class="panel-title text-center"><b> EDITAR ACCESO A ÁREAS </b></h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
                </div>
            </div>

            <div class="panel-body">
                <form action="{{ route('historial.secciones.update', $id_servicio) }}" method="POST">
                    @csrf

                    @foreach ($secciones as $seccion)
                        <div class="form-check">
                            <input type="checkbox"
                                   name="secciones[]"
                                   value="{{ $seccion->id }}"
                                   class="form-check-input"
                                   id="seccion_{{ $seccion->id }}"
                                   {{ in_array($seccion->id, $seleccionadas) ? 'checked' : '' }}>

                            <label class="form-check-label" for="seccion_{{ $seccion->id }}">
                                {{ $seccion->nombre }}
                            </label>
                        </div>
                    @endforeach

                    <div class="mt-3">
                        <button type="submit" class="btn btn-success"><i class="fa fa-check me-2"></i>Guardar</button>
                        <a href="{{ route('servicios.index') }}" class="btn btn-secondary ms-2"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
