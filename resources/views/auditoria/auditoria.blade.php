@extends('layouts.header')
@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b>Eventos de Historia Clínica</b></h4>
        </div>
        <?php $n = 2 ?>
        <div class="panel-body">

            <div class="col-md-12">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h1 class="accordion-header" id="flush-heading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse" aria-expanded="false" aria-controls="flush-collapseOne">
                                Filiacion
                            </button>
                        </h1>
                        <div id="flush-collapse" class="accordion-collapse collapse" aria-labelledby="flush-heading" data-bs-parent="#accordionFlushExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <!-- buttons: agregar para botones-->
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>NOMBRE PACIENTE</th>
                                                <th>RELIGION </th>
                                                <th>CAMA</th>
                                                <th>FUENTE INFORMACION</th>
                                                <th>NUMERO DE REFERENCIA</th>
                                                <th>GRADO INSTRUCCION</th>
                                                <th>GRADO CONFIABILIDAD</th>
                                                <th>GRUPO SANGUINEO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $filiaciones as $filiacion)
                                            <tr class="align-middle">
                                                <td>{{ $filiacion->operacion}}</td>
                                                <td>{{ $filiacion->name}}</td>
                                                <td>{{ $filiacion->fecha_modificacion}}</td>
                                                <td>{{ $filiacion->id_paciente}}</td>
                                                <td>{{ $filiacion->religion}}</td>
                                                <td>{{ $filiacion->cama}}</td>
                                                <td>{{ $filiacion->fuente_informacion}}</td>
                                                <td>{{ $filiacion->nombrenum_referencia}}</td>
                                                <td>{{ $filiacion->grado_instruccion}}</td>
                                                <td>{{ $filiacion->grado_confiabilidad}}</td>
                                                <td>{{ $filiacion->grupo_sanguineo_facto}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($permisos as $permiso)
                @if($permiso->nombre_permiso == 'Antecedentes_perinatologicos')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h1 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h1>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>ANTECEDENTE PERINATOLOGICO </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $antecedentes_perinatologicos as $ante_perinatologicos)
                                            <tr class="align-middle">
                                                <td>{{ $ante_perinatologicos->operacion}}</td>
                                                <td>{{ $ante_perinatologicos->name}}</td>
                                                <td>{{ $ante_perinatologicos->fecha_modificacion}}</td>
                                                <td>{{ $ante_perinatologicos->antecedentes_perinatolo}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Antecedentes_inmunizacions')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>ANTECEDENTE INMUNIZACION </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $antecedentes_inmunizacion as $ante_inmunizacion)
                                            <tr class="align-middle">
                                                <td>{{ $ante_inmunizacion->operacion}}</td>
                                                <td>{{ $ante_inmunizacion->name}}</td>
                                                <td>{{ $ante_inmunizacion->fecha_modificacion}}</td>
                                                <td>{{ $ante_inmunizacion->antecedentes_inmunizacion}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Antecedentes_alimentarios')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTheer">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTheer" aria-expanded="false" aria-controls="collapseTwo">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTheer" class="accordion-collapse collapse" aria-labelledby="headingTheer" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>ANTECEDENTE ALIMENTARIOS </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $antecedentes_inmunizacion as $ante_inmunizacion)
                                            <tr class="align-middle">
                                                <td>{{ $ante_inmunizacion->operacion}}</td>
                                                <td>{{ $ante_inmunizacion->name}}</td>
                                                <td>{{ $ante_inmunizacion->fecha_modificacion}}</td>
                                                <td>{{ $ante_inmunizacion->antecedentes_inmunizacion}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Antecedentes_familiares')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingfour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapsefour" class="accordion-collapse collapse" aria-labelledby="headingfour" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>ANTECEDENTE FAMILIARES </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $antecedentes_familiares as $ante_familiares)
                                            <tr class="align-middle">
                                                <td>{{ $ante_familiares->operacion}}</td>
                                                <td>{{ $ante_familiares->name}}</td>
                                                <td>{{ $ante_familiares->fecha_modificacion}}</td>
                                                <td>{{ $ante_familiares->antecedentes_familiares}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Desarrollo_psicomotors')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingfive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapsefive" class="accordion-collapse collapse" aria-labelledby="headingfive" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>DESARROLLO PSICOMOTOR </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $desarrollo_psicomotors as $desarrollo_psicomotor)
                                            <tr class="align-middle">
                                                <td>{{ $desarrollo_psicomotor->operacion}}</td>
                                                <td>{{ $desarrollo_psicomotor->name}}</td>
                                                <td>{{ $desarrollo_psicomotor->fecha_modificacion}}</td>
                                                <td>{{ $desarrollo_psicomotor->desarrollo_psicomotor}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Antecedentes_heredofamiliares')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingsix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapsesix" class="accordion-collapse collapse" aria-labelledby="headingsix" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">

                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Padre' => 'PADRE', 'Madre' => 'MADRE', 'Hermanos' => 'HERMANOS',
                                                'Hijos' => 'HIJOS', 'Esposo' => 'ESPOSO', 'abuelos' => 'ABUELOS'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($antecedentes_heredofamiliares as $ant_heredofamiliares)
                                            <tr class="align-middle">
                                                <td>{{ $ant_heredofamiliares->operacion }}</td>
                                                <td>{{ $ant_heredofamiliares->name }}</td>
                                                <td>{{ $ant_heredofamiliares->fecha_modificacion }}</td>
                                                @foreach(['padre', 'madre', 'hermanos', 'hijos', 'esposo', 'abuelos'] as $campo)
                                                @if($ant_heredofamiliares->$campo != 'N/A')
                                                <td>{{ $ant_heredofamiliares->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Antecedentes_patologicos')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingseven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseseven" class="accordion-collapse collapse" aria-labelledby="headingseven" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Clinicos' => 'CLINICOS', 'Quirurjicos' => 'QUIRURJICOS', 'Alergicos' => 'ALERGIAS','Otros' => 'OTROS', 'Internaciones' => 'INTERNACIONES',
                                                'Cirugias' => 'CIRUJIAS', 'Transfusion_de_sangre' => 'TRANSFUSIONES DE SANGRE','Iras' => 'IRAS','Gastroenteritis' => 'GASTROENTERITIS','Traumatismos' => 'TRAUMATISMO',
                                                'Medicamentos'=>'MEDICAMENTOS', 'Enfermedades'=>'ENFERMEDADES'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $antecedentes_patologicos as $ant_patologicos )
                                            <tr class="align-middle">
                                                <td>{{ $ant_patologicos->operacion}}</td>
                                                <td>{{ $ant_patologicos->name}}</td>
                                                <td>{{ $ant_patologicos->fecha_modificacion}}</td>
                                                @foreach(['clinicos', 'quirurjicos', 'alergicos', 'otros', 'internaciones', 'cirujias','transfusion_de_sangre','iras','gastroenteritis',
                                                'traumatismos','medicamentos','enfermedades'] as $campo)
                                                @if($ant_patologicos->$campo != 'N/A')
                                                <td>{{ $ant_patologicos->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Antecedentes_no_patologicos')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingeight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeight" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseeight" class="accordion-collapse collapse" aria-labelledby="headingeight" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Vacunas' => 'VACUNAS', 'Vacunas_HPV' => 'VACUNAS HPV', 'Habitos_toxicos' => 'HABITOS TOXICOS','Alimentacion' => 'ALIMENTACION', 'Habito_miccional' => 'HABITO MICCIONAL',
                                                'Habito_intestinal' => 'HABITO INTESTINAL', 'Vivienda_servicio_basico' => 'VIVIENDA SERVICIO BASICO','Habito_alcoholico' => 'HABITO ALCOHOLICO','Habito_tabaquico' => 'HABITO TABAQUICO',
                                                'Exposicion_biomasa' => 'EXPOSICION BIOMASA', 'Contacto_tuberculosis'=>'CONTACTO CON TUBERCULOSIS', 'Contacto_triatoma_infestans'=>'CONTACTO TRIATOMA INFESTANS',
                                                'Toxicomanias_drogas'=>'TOXICOMANIAS DROGAS', 'Inmunizaciones'=>'INMUNIZACIONES','Antecedentes_sexuales'=>'ANTECEDENTE SEXUALES'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $antecedentes_no_patologicos as $ant_no_patologicos )
                                            <tr class="align-middle">
                                                <td>{{ $ant_no_patologicos->operacion}}</td>
                                                <td>{{ $ant_no_patologicos->name}}</td>
                                                <td>{{ $ant_no_patologicos->fecha_modificacion}}</td>
                                                @foreach(['vacunas', 'vacunas_hpv', 'habitos_toxicos', 'alimentacion', 'habito_miccional', 'habito_intestinal','vivienda_servicio_basico','habito_alcoholico','habito_tabaquico',
                                                'exposicion_biomasa','contacto_con_tuberculosis','contacto_triatoma_infestans','toxicomanias_drogas','inmunizaciones','antecedentes_sexuales'] as $campo)
                                                @if($ant_no_patologicos->$campo != 'N/A')
                                                <td>{{ $ant_no_patologicos->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Antecedentes_gineco_obstetricos')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingnine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenine" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapsenine" class="accordion-collapse collapse" aria-labelledby="headingnine" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Ultima_fecha_menstruacion' => 'ULTIMA FECHA MENSTRUACION', 'Menarca' => 'MENARCA ', 'Ritmo_menstrual' => 'RITMO MENSTRUAL','Menopausia' => 'MENOPAUSIA', 'Gestaciones' => 'GESTACIONES',
                                                'Partos' => 'PARTOS', 'Cesareas' => 'CESAREAS','Abortos' => 'ABORTOS','Hijos_macrosomicos' => 'HIJOS MACROSOMICOS ',
                                                'Preeclampsia-eclampsia' => 'PREECLAMPSIA', 'Anticonceptivos'=>'ANTICONCEPTIVOS', 'Fecha_ultimo_papanicolau'=>'FECHA ULTIMO PAPANICOLAU',
                                                'Fecha_ultima_mamografia'=>'FECHA ULTIMA MOMOGRAFIA', 'Fecha_ultimo_densitometria'=>'FECHA ULTIMA DENSITOMETRIA'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $antecedentes_gineco_obstetricos as $ant_gineco_obstetricos )
                                            <tr class="align-middle">
                                                <td>{{ $ant_gineco_obstetricos->operacion}}</td>
                                                <td>{{ $ant_gineco_obstetricos->name}}</td>
                                                <td>{{ $ant_gineco_obstetricos->fecha_modificacion}}</td>
                                                @foreach(['fecha_ultima_menstruacion', 'menarca', 'ritmo_menstrual', 'menopausia', 'gestaciones', 'partos','cesareas','abortos','hijos_macrosomicos',
                                                'preeclampsia_eclampsia','anticonceptivos','fecha_ultima_papanicolau','fecha_ultima_mamografia','fecha_ultima_densitometria'] as $campo)
                                                @if($ant_gineco_obstetricos->$campo != 'N/A')
                                                <td>{{ $ant_gineco_obstetricos->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($permiso->nombre_permiso == 'Anamnesis_sistemas')
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingten">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseten" aria-expanded="false" aria-controls="collapsefour">
                            {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                        </button>
                    </h2>
                    <div id="collapseten" class="accordion-collapse collapse" aria-labelledby="headingten" data-bs-parent="#accordionExample">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                    <thead style="background-color:rgb(151, 215, 231);">
                                        <tr>
                                            <th>EVENTO</th>
                                            <th>USUARIO</th>
                                            <th>FECHA</th>
                                            @foreach(['Cardiovascular_respiratorio' => 'CARDIOVASCULAR RESPIRATORIA', 'Gastro_intestinal' => 'GASTRO-INTESTINAL ', 'Genito_urinario' => 'GENITO-URINARIO','Hematologico' => 'HEMATOLOGICO',
                                            'Dermatologico' => 'DERMATOLOGICO','Neurologico' => 'NEUROLOGICO', 'Locomotor' => 'LOCOMOTOR'] as $permisoKey => $titulo)
                                            @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                            <th>{{ $titulo }}</th>
                                            @endif
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $anamnesis_sistemas as $anamnesis )
                                        <tr class="align-middle">
                                            <td>{{ $anamnesis->operacion}}</td>
                                            <td>{{ $anamnesis->name}}</td>
                                            <td>{{ $anamnesis->fecha_modificacion}}</td>
                                            @foreach(['cardiovascular_respiratorio', 'gastro_intestinal', 'genito_urinario', 'hematologico',
                                            'dermatologico','neurologico','locomotor'] as $campo)
                                            @if($anamnesis->$campo != 'N/A')
                                            <td>{{ $anamnesis->$campo }}</td>
                                            @endif
                                            @endforeach
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($permiso->nombre_permiso == 'Motivo_de_internacion')
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingeleven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeleven" aria-expanded="false" aria-controls="collapsefour">
                            {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                        </button>
                    </h2>
                    <div id="collapseeleven" class="accordion-collapse collapse" aria-labelledby="headingeleven" data-bs-parent="#accordionExample">
                        <div class="card">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>MOTIVO DE INTERNACION </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $motivo_de_internacion as $motivo)
                                            <tr class="align-middle">
                                                <td>{{ $motivo->operacion}}</td>
                                                <td>{{ $motivo->name}}</td>
                                                <td>{{ $motivo->fecha_modificacion}}</td>
                                                <td>{{ $motivo->motivo_internacion}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($permiso->nombre_permiso == 'Historia_enfermedad_actual')
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingtwelve">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsetwelve" aria-expanded="false" aria-controls="collapsefour">
                            {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                        </button>
                    </h2>
                    <div id="collapsetwelve" class="accordion-collapse collapse" aria-labelledby="headingtwelve" data-bs-parent="#accordionExample">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                    <thead style="background-color:rgb(151, 215, 231);">
                                        <tr>
                                            <th>EVENTO</th>
                                            <th>USUARIO</th>
                                            <th>FECHA</th>
                                            <th>HISTORIA DE LA ENFERMEDAD ACTUAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $historia_enfermedad_actual as $historia)
                                        <tr class="align-middle">
                                            <td>{{ $historia->operacion}}</td>
                                            <td>{{ $historia->name}}</td>
                                            <td>{{ $historia->fecha_modificacion}}</td>
                                            <td>{{ $historia->historia_de_enfermedad_actual}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examen_fisico_generals')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapset" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapset" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Examen_fisico_general' => 'EXAMEN FISICO GENERAL', 'Estado_de_conciencia' => 'ESTADO DE CONCIENCIA ', 'Posicion' => 'POSICION','Color_piel_mucosa' => 'COLOR DE PIEL MUCOSA',
                                                'Estado_hidratacion' => 'ESTADO DE HIDRATACION','Constitucion' => 'CONSTITUCION', 'Biotipo' => 'BIOTIPO', 'Marcha'=>'MARCHA',
                                                'Facies'=>'FACIES', 'Apgar'=>'APGAR','Silverman'=>'SILVERMAN','Edad_por_capurro','EDAD POR CAPURRO','Somatometria'=>'SOMATOMETRIA',
                                                'PA'=>'PA','Tension_arterial'=>'TENSION ARTERIAL', 'Tension_arterial_media'=>'TENSION ARTERIAL MEDIA', 'Frecuencia_cardiaca'=>'FR',
                                                'Frecuencia_respiratoria'=>'FR', 'Temperatura'=>'TEMPERATURA','Peso'=>'PESO', 'Talla'=>'TALLA','IMC'=>'IMC','Sato2'=>'SATO2','Saturacion'=>'SATURACION',
                                                'SC'=>'SC','Perimetro_cefalico'=>'PERIMETRO CEFALICO','Perimetro_toracico'=>'PERIMETRO TORACICO','Perimetro_abdominal'=>'PERIMETRO ABDOMINAL',
                                                'SpO2'=>'SpO2','FiO2'=>'FiO2'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examen_fisico_generals as $examen_general )
                                            <tr class="align-middle">
                                                <td>{{ $examen_general->operacion}}</td>
                                                <td>{{ $examen_general->name}}</td>
                                                <td>{{ $examen_general->fecha_modificacion}}</td>
                                                @foreach(['examen_fisico_general', 'estado_de_conciencia', 'posicion','color_piel_mucosa','estado_hidratacion','constitucion','biotipo', 'marcha','facies','apgar','silverman',
                                                'edad_por_capurro','somatometria','pa', 'tension_arterial','tension_arterial_media','frecuencia_cardiaca','frecuencia_respiratoria','temperatura','peso','talla','imc','sato2',
                                                'saturacion','sc','perimetro_cefalico','perimetro_toracico','perimetro_abdominal','spo2','fio2'] as $campo)
                                                @if($examen_general->$campo != 'N/A')
                                                <td>{{ $examen_general->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examen_fisico_segmentado')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThirteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThirteen" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseThirteen" class="accordion-collapse collapse" aria-labelledby="headingThirteen" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Cabeza' => 'CABEZA', 'Frontales' => 'FRONTALES', 'Cabellos' => 'CABELLOS','Cara' => 'CARA','Apertura_ocular'=>'APERTURA OCULAR',
                                                'Ojos' => 'OJOS','Nariz' => 'NARIZ', 'Fosas_nasales' => 'FOSAS NASALES', 'Piramide_nasal'=>'PIRAMIDE NASAL','Coanas'=>'COANAS','Oidos'=>'OIDOS',
                                                'Pabellon_auricular'=>'PABELLON AURICULAR', 'Curvatura'=>'CURVATURA','Boca'=>'BOCA','Apertura_bucal','APERTURA BOCAL','Paladar'=>'PALADAR',
                                                'Mucosa_oral'=>'MUCOSA ORAL','Pulmones'=>'PULMONES', 'Pulmones_inspeccion'=>'PULMONES INSPECCION', 'Pulmones_palpacion'=>'PULMONES PALPACION',
                                                'Pulmones_percusion'=>'PULMONES PERCUSION', 'Pulmones_auscultacion'=>'PULMONES AUSCULTACION','Corazon'=>'CORAZON', 'Corazon_inspeccion'=>'CORAZON INSPECCION',
                                                'Corazon_palpacion'=>'CORAZON PALPACION','Corazon_percusion'=>'CORAZON PERCUSION','Corazon_auscultacion'=>'CORAZON AUSCULTACION','Precordio'=>'PRECORDIO',
                                                'Abdomen'=>'ABDOMEN','Abdomen_inspeccion'=>'ABDOMEN INSPECCION ','Abdomen_palpacion'=>'ABDOMEN PALPACION','Abdomen_percusion'=>'ABDOMEN PERCUSION',
                                                'Abdomen_auscultacion'=>'ABDOMEN AUSCULTACION','Cordon_umbilical'=>'CORDON UMBILICAL','Relacion_arteriovenosa'=>'RELACION ARTERIOVENOSA','Genitales_acuerdo_sexo_edad'=>'GENITALES DE ACUERDO A EDAD',
                                                'Pies'=>'PIES','Surcos_plantales'=>'SURCOS PLANTALES','Reflejos_succion'=>'REFLEJOS DE SUCCION','Genitourinarios'=>'GENITOURINARIOS','Extremidades'=>'EXTREMIDADES',
                                                'Neurologicos'=>'NEUROLOGICO','Craneo'=>'CRANEO','Cavidad_bucal'=>'CAVIDAD BUCAL','Cuello'=>'CUELLO','Cuello_inspeccion'=>'CUELLO INSPECCION','Cuello_palpacion'=>'CUELLO PALPACION',
                                                'Cuello_auscultacion'=>'CUELLO AUSCULTACION','Torax'=>'TORAX','Torax_inspeccion_estatico'=>'TORAX INSPECCION ESTATICO','Torax_inspeccion_dinamico'=>'TORAX INSPECCION DINAMICO',
                                                'Torax_palpacion'=>'TORAX PALPACION','Torax_percusion'=>'TORAX PERCUSION', 'Torax_auscultacion'=>'TORAX AUSCULTACION','Mamas'=>'MAMAS'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examen_fisico_segmentado as $examen_segmentado )
                                            <tr class="align-middle">
                                                <td>{{ $examen_segmentado->operacion}}</td>
                                                <td>{{ $examen_segmentado->name}}</td>
                                                <td>{{ $examen_segmentado->fecha_modificacion}}</td>
                                                @foreach(['cabeza', 'frontales', 'cabellos', 'cara','apertura_ocular','ojos','nariz','fosas_nasales','piramide_nasal',
                                                'coanas','oidos','pabellon_auricular','curvatura','boca','apertura_bucal','paladar','mucosa_oral','pulmones','pulmones_inspeccion',
                                                'pulmones_palpacion','pulmones_percusion','pulmones_auscultacion','corazon','corazon_inspeccion','corazon_palpacion','corazon_percusion',
                                                'corazon_auscultacion','precordio','abdomen','abdomen_inspeccion','abdomen_palpacion','abdomen_percusion','abdomen_auscultacion',
                                                'cordon_umbilical','relacion_arteriovenosa','genitales_acuerdo_sexo_edad','pies','surcos_plantales','reflejos_succion','genitourinarios',
                                                'extremidades','neurologicos','craneo','cavidad_bucal','cuello','cuello_inspeccion','cuello_palpacion','cuello_auscultacion',
                                                'torax','torax_inspeccion_estatico','torax_inspeccion_dinamico','torax_palpacion','torax_percusion','torax_auscultacion','mamas'] as $campo)
                                                @if($examen_segmentado->$campo != 'N/A')
                                                <td>{{ $examen_segmentado->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examen_obstetrico')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFourteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFourteen" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseFourteen" class="accordion-collapse collapse" aria-labelledby="headingFourteen" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Genitales' => 'GENITALES', 'Flujos' => 'FLUJOS', 'AFU' => 'AFU','Situacion' => 'SITUACION',
                                                'Posicion' => 'POSICION','Tacto_vaginal' => 'TACTO VAGINAL', 'FCF' => 'FCF', 'Presentacion'=>'PRESENTACION',
                                                'Movimientos_fetales'=>'MOVIMIENTOS FETALES'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examen_obstetrico as $exm_obstetrico )
                                            <tr class="align-middle">
                                                <td>{{ $exm_obstetrico->operacion}}</td>
                                                <td>{{ $exm_obstetrico->name}}</td>
                                                <td>{{ $exm_obstetrico->fecha_modificacion}}</td>
                                                @foreach(['genitales', 'flujos', 'afu','situacion','posicion','tacto_vaginal','fcf', 'presentacion','movimientos_fetales'] as $campo)
                                                @if($exm_obstetrico->$campo != 'N/A')
                                                <td>{{ $exm_obstetrico->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examen_ginecologico')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFifteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFifteen" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseFifteen" class="accordion-collapse collapse" aria-labelledby="headingFifteen" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Vello_pubiano' => 'VELLO PUBIANO', 'Vulva' => 'VULVA', 'Uretra' => 'URETRA','Glandulas_ByS' => 'GLANDULAS ByS',
                                                'Clitoris' => 'CLITORIS','Perineo' => 'PERINEO', 'Vagina' => 'VAGINA', 'Cuello_uterino'=>'CUELLO UTERINO',
                                                'Cuerpo_uterino'=>'CUERPO UTERINO','Anexos'=>'ANEXOS','Especuloscopia'=>'ESPECULOSCOPIA','Tacto_rectal'=>'TACTO RECTAL'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examen_ginecologico as $exm_ginecologico )
                                            <tr class="align-middle">
                                                <td>{{ $exm_ginecologico->operacion}}</td>
                                                <td>{{ $exm_ginecologico->name}}</td>
                                                <td>{{ $exm_ginecologico->fecha_modificacion}}</td>
                                                @foreach(['vello_pubiano', 'vulva', 'uretra','glandula_bys','clitoris','perineo','vagina', 'cuello_uterino',
                                                'cuerpo_uterino','anexos','especuloscopia','tacto_rectal'] as $campo)
                                                @if($exm_ginecologico->$campo != 'N/A')
                                                <td>{{ $exm_ginecologico->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examen_cardiovascular')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSixteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSixteen" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseSixteen" class="accordion-collapse collapse" aria-labelledby="headingSixteen" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Cardiovascular_palpacion' => 'PALPACION', 'Cardiovascular_percusion' => 'PERCUSION', 'Cardiovascular_auscultacion' => 'AUSCULTACION',
                                                'Cardiovascular_agregados' => 'AGREGADOS','Cardiovascular_soplos' => 'SOPLOS','Cardiovascular_fremito' => 'FREMITO', 'Pulsos_perifericos' => 'PULSOS PERIFERICOS',
                                                'Branquial'=>'BRANQUIAL','Femoral'=>'FEMORAL','Tibia'=>'TIBIA','Radial'=>'RADIAL','Popliteo'=>'POPLITEO','Pedio'=>'PEDIO'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examen_cardiovascular as $exm_cardiovascular )
                                            <tr class="align-middle">
                                                <td>{{ $exm_cardiovascular->operacion}}</td>
                                                <td>{{ $exm_cardiovascular->name}}</td>
                                                <td>{{ $exm_cardiovascular->fecha_modificacion}}</td>
                                                @foreach(['cardiovascular_palpacion', 'cardiovascular_percusion', 'cardiovascular_auscultacion','cardiovascular_agregados',
                                                'cardiovascular_soplos','cardiovascular_fremito','pulsos_perifericos', 'branquial','femoral','tibia','radial','popliteo','pedio'] as $campo)
                                                @if($exm_cardiovascular->$campo != 'N/A')
                                                <td>{{ $exm_cardiovascular->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examen_genito_urinario')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingSeventeen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeventeen" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseSeventeen" class="accordion-collapse collapse" aria-labelledby="headingSeventeen" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['puño_percusion_renal' => 'PUÑO PERCUSION RENAL', 'Palpacion_renal' => 'PALPACION RENAL', 'Puntos_ureterales' => 'puntos ureterales',
                                                'Genitales' => 'GENITALES'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examen_genito_urinario as $exm_genito_urinario )
                                            <tr class="align-middle">
                                                <td>{{ $exm_genito_urinario->operacion}}</td>
                                                <td>{{ $exm_genito_urinario->name}}</td>
                                                <td>{{ $exm_genito_urinario->fecha_modificacion}}</td>
                                                @foreach(['punio_percusion_renal', 'palpacion_renal', 'puntos_ureterales','genitales'] as $campo)
                                                @if($exm_genito_urinario->$campo != 'N/A')
                                                <td>{{ $exm_genito_urinario->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examen_extremidades_superiores')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingEighteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEighteen" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseEighteen" class="accordion-collapse collapse" aria-labelledby="headingEighteen" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['s_simetria' => 'SIMETRIA', 's_deformidades' => 'DEFORMIDADES', 's_articulaciones' => 'ARTICULACIONES ',
                                                's_piel' => 'PIEL'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examen_extremidades_superiores as $exm_extremidades_superiores )
                                            <tr class="align-middle">
                                                <td>{{ $exm_extremidades_superiores->operacion}}</td>
                                                <td>{{ $exm_extremidades_superiores->name}}</td>
                                                <td>{{ $exm_extremidades_superiores->fecha_modificacion}}</td>
                                                @foreach(['s_simetria', 's_deformidades', 's_articulaciones','s_piel'] as $campo)
                                                @if($exm_extremidades_superiores->$campo != 'N/A')
                                                <td>{{ $exm_extremidades_superiores->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examen_extremidades_inferiores')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingNineteen">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNineteen" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseNineteen" class="accordion-collapse collapse" aria-labelledby="headingNineteen" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['i_simetria' => 'SIMETRIA', 'i_deformidades' => 'DEFORMIDADES', 'i_articulaciones' => 'ARTICULACIONES ',
                                                'i_piel' => 'PIEL'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examen_extremidades_inferiores as $exm_extremidades_inferiores )
                                            <tr class="align-middle">
                                                <td>{{ $exm_extremidades_inferiores->operacion}}</td>
                                                <td>{{ $exm_extremidades_inferiores->name}}</td>
                                                <td>{{ $exm_extremidades_inferiores->fecha_modificacion}}</td>
                                                @foreach(['i_simetria', 'i_deformidades', 'i_articulaciones','i_piel'] as $campo)
                                                @if($exm_extremidades_inferiores->$campo != 'N/A')
                                                <td>{{ $exm_extremidades_inferiores->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Dermatologia')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwenty">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwenty" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwenty" class="accordion-collapse collapse" aria-labelledby="headingTwenty" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Piel' => 'PIEL', 'Pelo' => 'PELO', 'Uñas' => 'UÑAS ','Mucosas'=>'MUCOSAS','Topografia'=>'TOPOGRAFIA',
                                                'Morfologia' => 'MORFOLOGIA','Iconografia'=>'ICONOGRAFIA'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $dermatologias as $dermatologia )
                                            <tr class="align-middle">
                                                <td>{{ $dermatologia->operacion}}</td>
                                                <td>{{ $dermatologia->name}}</td>
                                                <td>{{ $dermatologia->fecha_modificacion}}</td>
                                                @foreach(['piel', 'pelo', 'unias','mucosas','topografia','morfologia','iconografia'] as $campo)
                                                @if($dermatologia->$campo != 'N/A')
                                                <td>{{ $dermatologia->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Ganglios_linfaticos')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentyone">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyone" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentyone" class="accordion-collapse collapse" aria-labelledby="headingTwentyone" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>GANGLIOS LINFATICOS </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $ganglios_linfaticos as $ganglio_linfatico)
                                            <tr class="align-middle">
                                                <td>{{ $ganglio_linfatico->operacion}}</td>
                                                <td>{{ $ganglio_linfatico->name}}</td>
                                                <td>{{ $ganglio_linfatico->fecha_modificacion}}</td>
                                                <td>{{ $ganglio_linfatico->ganglios_linfaticos}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Sistema_nervioso')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentytwoo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentytwoo" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentytwoo" class="accordion-collapse collapse" aria-labelledby="headingTwentytwoo" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Conciencia' => 'CONCIENCIA', 'Gnosia' => 'GNOSIA','Praxia'=>'PRAXIA','Lenguaje'=>'LENGUAJE','Memoria'=>'MEMORIA',
                                                'Calculo' => 'CALCULO','Inteligencia'=>'INTELIGENCIA','Atencion'=>'ATENCION','Emotividad'=>'EMOTIVIDAD','Planificacion'=>'PLANIFICACION',
                                                'Decision'=>'DECISION','Percepcion' => 'PERCEPCION','Paredes_craneales_percepcion'=>'PERCEPCION','Identificacion'=>'IDENTIFICACION',
                                                'Agudez_visual'=>'AGUDEZ VISUAL','Vision_de_colores'=>'VISION DE COLORES','Campo_visual'=>'CAMPO VISUAL','Pupilas'=>'PUPILAS',
                                                'Motilidad_del_globo_ocular'=>'MOTILIDAD DE GLOBO OCULAR','Reflejo_fotomotor'=>'REFLEJO FOTOMOTOR','Reflejos_de_acomodacion'=>'REFLEJO DE ACOMODACION',
                                                'Sensitivo'=> 'SENSITIVO','Reflejo_corneal'=>'REFLEJO CORNEAL','Motor'=>'MOTOR','Reflejo_maseterino'=>'REFLEJO MASETERINO',
                                                'Valora_musculos_expresion_facial'=>'VALOR MUSCULAR EXPRESION FACIAL','Audicion_prueba_rinnne_weber'=>'AUDICION(prueba de Rinner,Weber)',
                                                'Vestibular'=>'VESTIBULAR','Reflejo_nauseoso'=>'REFLEJO NAUSEOSO','Tos_debil_o_disfonia'=>'TOS DEBIL O DISFONIA',
                                                'Asimetria_paladar_blando_perdida_reflejo_nauseoso'=>'ASIMETRIA PALADAR BLANDO/PERDIDA REFLEJO NAUSEOSO',
                                                'Valor_fuerza_esternocleidomastoideo_trapecio'=>'VALORAR FUERZA DE ESTERNOCLEIDOMASTOIDEO/TRAPECIO',
                                                'Desviacion_o_fasciculacion_de_lengua'=>'DESVIACION DE LA LENGUA/FASCICULACION DE LA LENGUA'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $sistema_nervioso as $sistema_n )
                                            <tr class="align-middle">
                                                <td>{{ $sistema_n->operacion}}</td>
                                                <td>{{ $sistema_n->name}}</td>
                                                <td>{{ $sistema_n->fecha_modificacion}}</td>
                                                @foreach(['conciencia', 'gnosia', 'praxia','lenguaje','memoria','calculo','inteligencia','atencion','emotividad','planificacion',
                                                'decision','percepcion','paredes_craneales_percepcion','identificacion','agudez_visual','vision_de_colores','campo_visual','pupilas',
                                                'motilidad_del_globo_ocular','reflejo_fotomotor','reflejos_de_acomodacion','sensitivo','reflejo_corneal','motor','reflejo_maseterino',
                                                'valora_musculos_expresion_facial','audicion_prueba_rinnne_weber','vestibular','reflejo_nauseoso','tos_debil_o_disfonia',
                                                'asimetria_paladar_blando_perdida_reflejo_nauseoso','valor_fuerza_esternocleidomastoideo_trapecio','desviacion_o_fasciculacion_de_lengua'] as $campo)
                                                @if($sistema_n->$campo != 'N/A')
                                                <td>{{ $sistema_n->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Sistema_motor')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentytreer">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentytreer" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentytreer" class="accordion-collapse collapse" aria-labelledby="headingTwentytreer" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Tono' => 'TONO', 'Trofismo' => 'TROFISMO','Reflejos_de_estiramiento'=>'REFLEJOS DE ESTIRAMIENTO',
                                                'Balance_muscular_brazo_derecho' => 'BALANCE BRAZO DERECHO ','Balance_muscular_brazo_izquierdo'=>'BALANCE BRAZO IZQUIERDO',
                                                'Balance_muscular_antebrazo_derecho'=>'BALANCE ANTEBRAZO DERECHO','Balance_muscular_antebrazo_izquierdo' => 'BALANCE ANTEBRAZO IZQUIERDO',
                                                'Balance_muscular_mano_derecho'=>'BALANCE MANO DERECHO','Balance_muscular_mano_izquierdo'=>'BALANCE MANO IZQUIERDO',
                                                'Balance_muscular_muslo_derecho'=>'BALANCE MUSLO DERECHO','Balance_muscular_muslo_izquierdo'=>'BALANCE MUSLO IZQUIERDO',
                                                'Balance_muscular_pierna_derecho'=> 'BALANCE PIERNA DERECHO','Balance_muscular_pierna_izquierdo'=>'BALANCE PIERNA IZQUIERDO',
                                                'Balance_muscular_pie_derecho'=>'BALANCE PIE DERECHO','Balance_muscular_pie_izquierdo'=>'BALANCE PIE IZQUIERDO'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $sistema_motor as $sistema_m )
                                            <tr class="align-middle">
                                                <td>{{ $sistema_m->operacion}}</td>
                                                <td>{{ $sistema_m->name}}</td>
                                                <td>{{ $sistema_m->fecha_modificacion}}</td>
                                                @foreach(['tono', 'trofismo', 'reflejos_de_estiramiento','balance_muscular_brazo_derecho','balance_muscular_brazo_izquierdo',
                                                'balance_muscular_antebrazo_derecho','balance_muscular_antebrazo_izquierdo','balance_muscular_mano_derecho','balance_muscular_mano_izquierdo',
                                                'balance_muscular_muslo_derecho','balance_muscular_muslo_izquierdo','balance_muscular_pierna_derecho','balance_muscular_pierna_izquierdo',
                                                'balance_muscular_pie_derecho','balance_muscular_pie_izquierdo'] as $campo)
                                                @if($sistema_m->$campo != 'N/A')
                                                <td>{{ $sistema_m->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Sistema_sensitivo')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentyfour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyfour" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentyfour" class="accordion-collapse collapse" aria-labelledby="headingTwentyfour" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                @foreach(['Sensibilidad_superficial' => 'SENSIBILIDAD SUPERFICIAL', 'Sensibilidad_profunda_consciente' => 'SENSIBILIDAD PROFUNDA CONSCIENTE',
                                                'Sensibilidad_profunda_inconsciente' => 'SENSIBILIDAD PROFUNDA INCONSCIENTE ','Sistema_vestibulo_cerebeloso'=>'SISTEMA VESTIBULO CEREBELOSO',
                                                'Signos_irritacion_meningea'=>'SIGNOS DE IRRIGACION MENINGEA','Marcha' => 'MARCHA'] as $permisoKey => $titulo)
                                                @if($permisos_1->contains('nombre_permiso', $permisoKey))
                                                <th>{{ $titulo }}</th>
                                                @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $sistema_sensitivo as $sistema_sens )
                                            <tr class="align-middle">
                                                <td>{{ $sistema_sens->operacion}}</td>
                                                <td>{{ $sistema_sens->name}}</td>
                                                <td>{{ $sistema_sens->fecha_modificacion}}</td>
                                                @foreach(['sensibilidad_superficial', 'sensibilidad_profunda_consciente', 'sensibilidad_profunda_inconsciente','sistema_vestibulo_cerebeloso',
                                                'signos_irritacion_meningea','marcha'] as $campo)
                                                @if($sistema_sens->$campo != 'N/A')
                                                <td>{{ $sistema_sens->$campo }}</td>
                                                @endif
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Diagnostico_sindromatico')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentyfive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyfive" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentyfive" class="accordion-collapse collapse" aria-labelledby="headingTwentyfive" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>DIAGNOSTICO SINDROMATICO</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $diagnostico_sindromatico as $diagnostico)
                                            <tr class="align-middle">
                                                <td>{{ $diagnostico->operacion}}</td>
                                                <td>{{ $diagnostico->name}}</td>
                                                <td>{{ $diagnostico->fecha_modificacion}}</td>
                                                <td>{{ $diagnostico->diagnostico_sindromatico}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Examenes_complementarios')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentysix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentysix" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentysix" class="accordion-collapse collapse" aria-labelledby="headingTwentysix" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>EXAMENES COMPLEMENTARIOS </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $examenes_complementarios as $examen_complementario)
                                            <tr class="align-middle">
                                                <td>{{ $examen_complementario->operacion}}</td>
                                                <td>{{ $examen_complementario->name}}</td>
                                                <td>{{ $examen_complementario->fecha_modificacion}}</td>
                                                <td>{{ $examen_complementario->examenes_complementarios}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Impresion_diagnostica')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentyseven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyseven" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentyseven" class="accordion-collapse collapse" aria-labelledby="headingTwentyseven" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>IMPRESION DIAGNOSTICA </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $impresion_diagnostica as $impresion)
                                            <tr class="align-middle">
                                                <td>{{ $impresion->operacion}}</td>
                                                <td>{{ $impresion->name}}</td>
                                                <td>{{ $impresion->fecha_modificacion}}</td>
                                                <td>{{ $impresion->impresion_diagnostica}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Comentarios')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentyeight">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentyeight" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentyeight" class="accordion-collapse collapse" aria-labelledby="headingTwentyeight" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>COMENTARIOS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $comentarios as $comentario)
                                            <tr class="align-middle">
                                                <td>{{ $comentario->operacion}}</td>
                                                <td>{{ $comentario->name}}</td>
                                                <td>{{ $comentario->fecha_modificacion}}</td>
                                                <td>{{ $comentario->comentarios}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($permiso->nombre_permiso == 'Interpretacion_laboratorios_de_estudio_y_gabinetes')
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwentynine">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwentynine" aria-expanded="false" aria-controls="collapsefour">
                                {{ ucwords(str_replace('_', ' ', $permiso->nombre_permiso))}}
                            </button>
                        </h2>
                        <div id="collapseTwentynine" class="accordion-collapse collapse" aria-labelledby="headingTwentynine" data-bs-parent="#accordionExample">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                                        <thead style="background-color:rgb(151, 215, 231);">
                                            <tr>
                                                <th>EVENTO</th>
                                                <th>USUARIO</th>
                                                <th>FECHA</th>
                                                <th>LABORATORIOS DE ESTUDIO Y GABINETES SOLICITADOS </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach( $interpretacion_laboratorio as $interpretacion_lab)
                                            <tr class="align-middle">
                                                <td>{{ $interpretacion_lab->operacion}}</td>
                                                <td>{{ $interpretacion_lab->name}}</td>
                                                <td>{{ $interpretacion_lab->fecha_modificacion}}</td>
                                                <td>{{ $interpretacion_lab->laboratorios_de_estudio_y_gabinete_solicitados}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection