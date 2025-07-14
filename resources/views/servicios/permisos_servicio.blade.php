@extends('layouts.header')

@section('content')

<div class="col-12">
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a class="text-danger">ADMINISTRACION DE HISTORIAS CLINICAS</a></li>
        <li class="breadcrumb-item"><a>TABLERO</a></li>
    </ol>
    <h1 class="page-header mb-3 text-danger">ADMINISTRACION DE HISTORIAS CLINICAS</h1>
</div>
<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b>SERVICIO {{$servicio->nombre_servicio}} </b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <form class="row g-3 needs-validation" method="POST" action="{{route('servicios.store_permisos')}}" autocomplete="off" novalidate>
                @csrf
                @method('POST')
                <input type="hidden" name="id_servicio" value="{{$servicio->id_servicio}} ">
                <div class="row g-3">
                    <?php
                    foreach ($nivel_1 as $niv_1) {
                        $modulo = $niv_1['modulo'];
                    ?>

                        <div class="col-4">
                            <div class="card border-2 border-secondary">
                                <div class="card body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <input class="form-check-input me-1" type="checkbox" value="<?= $niv_1['id_permisos_historia'] ?>" name="permisos[]" data-on-text="Activado" data-off-text="off" data-on-color="info" data-size="small" data-off-color="danger" <?= $niv_1['nombre_permiso'] ?> <?php if (isset($asignado[$niv_1['id_permisos_historia']])) {
                                                                                                                                                                                                                                                                                                                echo 'checked';
                                                                                                                                                                                                                                                                                                            } ?>> <?= $niv_1['nombre_permiso'] ?>
                                        </li>
                                        <?php foreach ($nivel_2 as $niv_2) {
                                            if ($modulo == $niv_2['modulo']) { ?>
                                                <ul>
                                                    <li class="list-group-item">
                                                        <input class="form-check-input me-1" type="checkbox" value="<?= $niv_2['id_permisos_historia'] ?>" name="permisos[]" data-on-text="Activado" data-off-text="off" data-on-color="info" data-size="small" data-off-color="danger" <?= $niv_2['nombre_permiso'] ?> <?php if (isset($asignado[$niv_2['id_permisos_historia']])) {
                                                                                                                                                                                                                                                                                                                            echo 'checked';
                                                                                                                                                                                                                                                                                                                        } ?>>
                                                        <?= $niv_2['nombre_permiso'] ?>
                                                    </li>
                                                </ul>
                                        <?php }
                                        } ?>

                                    </ul>
                                </div>
                            </div>
                        </div>

                    <?php } ?>
                </div>
                <div class="col-12 pt-4">
                    <a href="{{route('servicios.index')}}" class="btn btn-danger "><i class="fas fa-reply m-1"></i>VOLVER</a>

                    <button class="btn btn-success" type="submit"><i class="fas fa-save m-1"></i>GUARDAR</button>
                </div>
            </form>
        </div>

    </div>
</div>


@endsection