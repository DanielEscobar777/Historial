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
            <h4 class="panel-title text-center"><b>SERVICIO {{ $servicio->nombre_servicio }}</b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <form class="row g-3 needs-validation" method="POST" action="{{ route('servicios.store_permisos') }}" autocomplete="off" novalidate>
                @csrf
                @method('POST')
                <input type="hidden" name="id_servicio" value="{{ $servicio->id_servicio }}">

                <div class="accordion" id="accordionPermisos">
                    <?php
                    $contador = 0;
                    foreach ($nivel_1 as $niv_1) {
                        $modulo = $niv_1['modulo'];
                        $contador++;
                        $idAcordeon = 'acordeon' . $contador;
                    ?>
                        <div class="accordion-item mb-3">
                            <h2 class="accordion-header" id="heading{{ $idAcordeon }}">
                                <button class="accordion-button collapsed bg-light fw-bold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $idAcordeon }}" aria-expanded="false" aria-controls="collapse{{ $idAcordeon }}">
                                    <input class="form-check-input me-2" type="checkbox" value="<?= $niv_1['id_permisos_historia'] ?>" name="permisos[]" <?= $niv_1['nombre_permiso'] ?> <?php if (isset($asignado[$niv_1['id_permisos_historia']])) echo 'checked'; ?>>
                                    <?=
                                      ucwords(str_replace('_', ' ', $niv_1['nombre_permiso'])) ?>
                                </button>
                            </h2>
                            <div id="collapse{{ $idAcordeon }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $idAcordeon }}" data-bs-parent="#accordionPermisos">
                                <div class="accordion-body">
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($nivel_2 as $niv_2) {
                                            if ($modulo == $niv_2['modulo']) { ?>
                                                <li class="list-group-item">
                                                    <input class="form-check-input me-2" type="checkbox" value="<?= $niv_2['id_permisos_historia'] ?>" name="permisos[]" <?= $niv_2['nombre_permiso'] ?> <?php if (isset($asignado[$niv_2['id_permisos_historia']])) echo 'checked'; ?>>
                                                    @switch($niv_2['nombre_permiso'])
                                                    @case('Unias')
                                                    <?= 'Uñas' ?>
                                                    @break
                                                    @case('Punio_percusion_renal')
                                                    <?= 'Puño Percusion Renal' ?>
                                                    @break
                                                    @default
                                                    <?=
                                                    ucwords(str_replace('_', ' ', $niv_2['nombre_permiso']))
                                                    
                                                   ?> @endswitch

                                                </li>
                                        <?php }
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <div class="col-12 pt-4 text-end">
                    <a href="{{ route('servicios.index') }}" class="btn btn-danger"><i class="fas fa-reply m-1"></i>VOLVER</a>
                    <button class="btn btn-success" type="submit"><i class="fas fa-save m-1"></i>GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection