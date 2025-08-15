<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        @page {
            margin: 0px;
        }

        body {
            margin: 2cm;
            font-family: 'DejaVu Sans';
        }

        .bod_seg {
            margin: 4cm;
            font-family: 'DejaVu Sans';
        }

        .container {
            display: flex;
            align-items: flex-start;
            /* Alinea al inicio (arriba) */
            gap: 20px;
            /* Espacio entre imagen y texto */
            width: 100%;
            margin-bottom: 20px;
        }

        .image-container {
            flex: 0 0 auto;
            /* No crece, no se encoge, tamaño automático */
            width: 150px;
            /* Ancho fijo para la imagen */
        }

        .text-container {
            flex: 1;
            /* Ocupa el espacio restante */
        }

        img {
            width: 100%;
            height: auto;
        }
    </style>
    <style>
        body {
            font-family: Arial;
            font-size: 12pt;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .indent-1 {
            padding-left: 20px;
        }

        .indent-2 {
            padding-left: 40px;
        }

        .indent-3 {
            padding-left: 60px;
        }

        .item {
            margin-bottom: 3px;
        }
    </style>
</head>
<?php $n = 1 ?>

<body class="body">
    <h4 style="border-collapse: collapse;font-size: 15px;text-align:center;font-family: Arial, sans-serif ">HISTORIA CLINICA</h4>

    <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- FILIACION</h5>
    <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">

        @if($h_antecedentes->nombre_servicio=='NEONATOLOGIA' )
        <tr>
            <td style="text-align: left; width: 80%; "><b>Nombre: </b> {!! nl2br(e($h_antecedentes->nombre_recien_necido)) !!}</td>
        </tr>
        <tr>
            @if($filiacion->sexo == 'M')
            <td style="text-align: left; "><b>Sexo : </b>Masculino</td>
            @else
            <td style="text-align: left; "><b>Sexo : </b>Femeninos</td>
            @endif
            <td style="text-align: left; "><b>Hora: </b> {{$filiacion->hora_registro}}</td>
        </tr>
        <tr>
            <td style="text-align: left; width: 80%; "><b>Fecha de nacimiento: </b> {!! nl2br(e($h_antecedentes->fecha_recien_necido)) !!}</td>
        </tr>
        <tr>
            <td style="text-align: left; width: 80%; "><b>Hora de nacimiento: </b> {!! nl2br(e($h_antecedentes->hora_recien_necido)) !!}</td>
        </tr>
        <tr>
            <td style="text-align: left; width: 80%; "><b>Servicio: </b> {!! nl2br(e($h_antecedentes->nombre_servicio)) !!}</td>
        </tr>
        <tr>
            <td style="text-align: left; width: 80%; "><b>Fecha registro: </b> {!! nl2br(e($h_antecedentes->fecha_registro)) !!}</td>
        </tr>
        <tr>
            <td style="text-align: left; width: 80%; "><b>Hora registro: </b> {!! nl2br(e($h_antecedentes->hora_registro)) !!}</td>
        </tr>
        <tr>
            <td style="text-align: left; width: 80%; "><b>Nombre y teléfono de referencia: </b> {!! nl2br(e($h_antecedentes->nombrenum_referencia)) !!}</td>
        </tr>
        @else
        <tr>
            <td style="text-align: left; width: 80%; "><b>Nombre: </b> {!! nl2br(e($filiacion->nombres)) !!} {!! nl2br(e($filiacion->p_apellido)) !!} {!! nl2br(e($filiacion->s_apellido)) !!}</td>
            <td style="text-align: left; width: 80%;"><b>Religion: </b> {!! nl2br(e($filiacion->religion)) !!}</td>
        </tr>
        <tr>

            <td style="text-align: left; width: 80%; "><b>Edad : </b>{!! nl2br(e( (int)\Carbon\Carbon::parse($filiacion->fecha_nacimiento)->floatDiffInYears($filiacion->fecha_registro) )) !!} </td>
            <td style="text-align: left; width: 80%; "><b>Fecha: </b>{!! nl2br(e($filiacion->fecha_registro)) !!} </td>
        </tr>
        <tr>
            @if($filiacion->sexo == 'M')
            <td style="text-align: left; "><b>Sexo : </b>Masculino</td>
            @else
            <td style="text-align: left; "><b>Sexo : </b>Femeninos</td>
            @endif
            <td style="text-align: left; "><b>Hora: </b> {!! nl2br(e($filiacion->hora_registro)) !!}</td>
        </tr>
        <tr>
            <td style="text-align: left; "><b>Ocupacion : </b>{!! nl2br(e($filiacion->ocupacion)) !!} </td>
            <td style="text-align: left; "><b>Cama :</b> {!! nl2br(e($filiacion->cama)) !!} </td>
        </tr>
        <tr>
            <td style="text-align: left; "><b>Nacionalidad : </b>{!! nl2br(e($filiacion->nacionalidad)) !!} </td>
            <td style="text-align: left; "><b>Matricula: </b> {!! nl2br(e($filiacion->matricula_seguro)) !!}</td>
        </tr>
        <tr>
            <td style="text-align: left; "><b>Residencia : </b>{!! nl2br(e($filiacion->residencia)) !!} </td>
            <td style="text-align: left; "><b>Servicio: </b> {!! nl2br(e($h_antecedentes->nombre_servicio)) !!} </td>
        </tr>
        <tr>
            <td style="text-align: left; "><b>Grado de instruccion: </b>{!! nl2br(e($filiacion->grado_instruccion )) !!} </td>
            <td style="text-align: left; "><b>Fuente de informacion : </b>{!! nl2br(e($filiacion->fuente_informacion )) !!}</td>
        </tr>
        <tr>
            <td style="text-align: left; "><b>Estado civil: </b>{!! nl2br(e($filiacion->estado_civil)) !!}</td>
            <td style="text-align: left; "><b>Nombre y numero de referencia : </b>{!! nl2br(e($filiacion->nombrenum_referencia )) !!} </td>
        </tr>
        <tr>
            <td style="text-align: left; "><b>Grado de confiabilidad: </b>{!! nl2br(e($filiacion->grado_confiabilidad )) !!}</td>
        </tr>
        @endif
    </table>

    @if($h_antecedentes->antecedentes_perinatologicos <> 'N/A')<?php $n++ ?>
        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left ;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- ANTECEDENTES PERINATOLOGICOS</h5>
        <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_antecedentes->antecedentes_perinatologicos)) !!}</p>
        @endif

        @if($h_antecedentes->antecedentes_inmunizacion <> 'N/A')<?php $n++ ?>
            <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- ANTECEDENTES DE INMUNIZACION</h5>
            <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_antecedentes->antecedentes_inmunizacion)) !!}</p>
            @endif

            @if($h_antecedentes->antecedentes_alimentarios <> 'N/A')<?php $n++ ?>
                <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- ANTECEDENTES ALIMENTARIOS DE IMPORTANCIA</h5>
                <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_antecedentes->antecedentes_alimentarios)) !!}</p>
                @endif

                @if($h_antecedentes->desarrollo_psicomotor <> 'N/A')<?php $n++ ?>
                    <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif;">{!! nl2br(e($n)) !!}.- DESARROLLO PSICOMOTOR (OPCIONAL)</h5>
                    <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif;"> {!! nl2br(e($h_antecedentes->desarrollo_psicomotor)) !!}</p>
                    @endif
                    @if($h_antecedentes->antecedentes_familiares <> 'N/A')<?php $n++ ?>
                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif;">{!! nl2br(e($n)) !!}.- ANTECEDENTES FAMILIARES DE IMPORTANCIA</h5>
                        <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif;">{!! nl2br(e($h_antecedentes->antecedentes_familiares)) !!}</p>
                        @endif
                        @foreach ($permisos as $permiso)
                        @if($permiso->nombre_permiso=='Antecedentes_heredofamiliares')<?php $n++ ?>
                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif;">{!! nl2br(e($n)) !!}.- ANTECEDENTES HEREDOFAMILIARES</h5>
                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                            @if($h_antecedentes->padre <> 'N/A')
                                <tr>
                                    <td style="text-align: left "><b>Padre</b> :{!! nl2br(e($h_antecedentes->padre )) !!}</td>
                                </tr>
                                @endif

                                @if($h_antecedentes->madre <> 'N/A')
                                    <tr>
                                        <td style="text-align: left"><b>Madre</b> : {!! nl2br(e($h_antecedentes->madre)) !!} </td>
                                    </tr>
                                    @endif
                                    @if($h_antecedentes->hermanos <> 'N/A')
                                        <tr>
                                            <td style="text-align: left "><b>Hermano(s)</b> : {!! nl2br(e($h_antecedentes->hermanos )) !!}</td>
                                        </tr>
                                        @endif
                                        @if($h_antecedentes->esposo <> 'N/A')
                                            <tr>
                                                <td style="text-align: left"><b>Esposo</b> : {!! nl2br(e($h_antecedentes->esposo )) !!} </td>
                                            </tr>
                                            @endif
                                            @if($h_antecedentes->hijos <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Hijos</b> : {!! nl2br(e($h_antecedentes->hijos )) !!} </td>
                                                </tr>
                                                @endif
                                                @if($h_antecedentes->abuelos <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Abuelos</b> : {!! nl2br(e($h_antecedentes->abuelos)) !!}</td>
                                                    </tr>
                                                    @endif

                        </table>
                        @endif
                        @endforeach
                        @foreach ($permisos as $permiso)
                        @if($permiso->nombre_permiso=='Antecedentes_patologicos')<?php $n++ ?>
                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- ANTECEDENTES PERSONALES PATOLOGICOS</h5>
                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                            @if($h_antecedentes->clinicos <> 'N/A')
                                <tr>
                                    <td style="text-align: left "><b>Clinicos</b> : {!! nl2br(e($h_antecedentes->clinicos )) !!}</td>
                                </tr>
                                @endif

                                @if($h_antecedentes->quirurjicos <> 'N/A')
                                    <tr>
                                        <td style="text-align: left "><b>Quirúrgicos</b> : {!! nl2br(e($h_antecedentes->quirurjicos)) !!} </td>
                                    </tr>
                                    @endif
                                    @if($h_antecedentes->alergicos <> 'N/A')
                                        <tr>
                                            <td style="text-align: left"><b>Alergias</b> : {!! nl2br(e($h_antecedentes->alergicos)) !!}</td>
                                        </tr>
                                        @endif
                                        @if($h_antecedentes->otros <> 'N/A')
                                            <tr>
                                                <td style="text-align: left"><b>Otros</b> : {!! nl2br(e($h_antecedentes->otros)) !!} </td>
                                            </tr>
                                            @endif

                                            @if($h_antecedentes->internaciones <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Internaciones</b> : {!! nl2br(e($h_antecedentes->internaciones)) !!} </td>
                                                </tr>
                                                @endif
                                                @if($h_antecedentes->cirugias <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Cirugias</b> : {!! nl2br(e($h_antecedentes->cirugias)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_antecedentes->transfusion_de_sangre <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Transfusiones de sangre</b> : {!! nl2br(e($h_antecedentes->transfusion_de_sangre)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_antecedentes->iras <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left "><b>Iras</b> : {!! nl2br(e($h_antecedentes->iras )) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_antecedentes->gastroenteritis <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Gastroenteritis</b> : {!! nl2br(e($h_antecedentes->gastroenteritis)) !!} </td>
                                                                </tr>
                                                                @endif

                        </table>
                        @endif
                        @endforeach
                        @foreach ($permisos as $permiso)
                        @if($permiso->nombre_permiso=='Antecedentes_no_patologicos')<?php $n++ ?>
                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- ANTECEDENTES PERSONALES NO PATOLOGICOS</h5>

                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">

                            @if($h_antecedentes->vacunas <> 'N/A')
                                <tr>
                                    <td style="text-align: left"><b>Vacunas</b> : {!! nl2br(e($h_antecedentes->vacunas)) !!} </td>
                                </tr>
                                @endif
                                @if($h_antecedentes->vacunas_hpv <> 'N/A')
                                    <tr>
                                        <td style="text-align: left"><b>Vacunas HPV</b> : {!! nl2br(e($h_antecedentes->vacunas_hpv )) !!} </td>
                                    </tr>
                                    @endif
                                    @if($h_antecedentes->habitos_toxicos <> 'N/A')
                                        <tr>
                                            <td style="text-align: left "><b>Habitos toxicos</b> : {!! nl2br(e($h_antecedentes->habitos_toxicos)) !!}</td>
                                        </tr>
                                        @endif
                                        @if($h_antecedentes->alimentacion <> 'N/A')
                                            <tr>
                                                <td style="text-align: left "><b>Alimentacion</b> : {!! nl2br(e($h_antecedentes->alimentacion)) !!} </td>
                                            </tr>
                                            @endif
                                            @if($h_antecedentes->habito_miccional <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Habito miccional</b> : {!! nl2br(e($h_antecedentes->habito_miccional)) !!}</td>
                                                </tr>
                                                @endif
                                                @if($h_antecedentes->habito_intestinal <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Habito intestinal</b> : {!! nl2br(e($h_antecedentes->habito_intestinal)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_antecedentes->vivienda_servicio_basico <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Viviensa y servicios basicos</b> :{!! nl2br(e($h_antecedentes->vivienda_servicio_basico)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_antecedentes->habito_alcoholico <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Habitos alcoholicos</b> : {!! nl2br(e($h_antecedentes->habito_alcoholico)) !!}</td>
                                                            </tr>
                                                            @endif
                                                            @if($h_antecedentes->habito_tabaquico <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Habitos tabaquico</b> : {!! nl2br(e($h_antecedentes->habito_tabaquico)) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_antecedentes->exposicion_biomasa <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"><b>Exposicion a biomasa</b> : {!! nl2br(e($h_antecedentes->exposicion_biomasa)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_antecedentes->contacto_tuberculosis <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left"><b>Contacto con tuberculosis</b> : {!! nl2br(e($h_antecedentes->contacto_con_tuberculosis)) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_antecedentes->contacto_triatoma_infestans <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left"><b>Contacto con Triatomas infestans</b> : {!! nl2br(e($h_antecedentes->contacto_triatoma_infestans)) !!}</td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_antecedentes->toxicomanias_drogas <> 'N/A')
                                                                                <tr>
                                                                                    <td style="text-align: left"><b>Toxicomanias-drogas</b> : {!! nl2br(e($h_antecedentes->toxicomanias_drogas)) !!}</td>
                                                                                </tr>
                                                                                @endif
                                                                                @if($h_antecedentes->inmunizaciones <> 'N/A')
                                                                                    <tr>
                                                                                        <td style="text-align: left"><b>Inmunizaciones</b> : {!! nl2br(e($h_antecedentes->inmunizaciones)) !!} </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @if($h_antecedentes->antecedentes_sexuales <> 'N/A')
                                                                                        <tr>
                                                                                            <td style="text-align: left"><b>Antecedentes sexuales</b> : {!! nl2br(e($h_antecedentes->antecedentes_sexuales )) !!} </td>
                                                                                        </tr>
                                                                                        @endif
                        </table>
                        @endif
                        @endforeach
                        @foreach ($permisos as $permiso)
                        @if($permiso->nombre_permiso=='Antecedentes_gineco_obstetricos')<?php $n++ ?>
                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- ANTECEDENTES GINECO OBSTETRICOS</h5>

                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">

                            @if($h_antecedentes->fecha_ultima_menstruacion <> 'N/A')
                                <tr>
                                    <td style="text-align: left"><b>Ultima fecha menstruacion</b> : {!! nl2br(e($h_antecedentes->fecha_ultima_menstruacion)) !!} </td>
                                </tr>
                                @endif
                                @if($h_antecedentes->menarca <> 'N/A')
                                    <tr>
                                        <td style="text-align: left"><b>Menarca</b> : {!! nl2br(e($h_antecedentes->menarca )) !!} </td>
                                    </tr>
                                    @endif
                                    @if($h_antecedentes->ritmo_menstrual <> 'N/A')
                                        <tr>
                                            <td style="text-align: left "><b>Ritmo menstrual</b> : {!! nl2br(e($h_antecedentes->ritmo_menstrual)) !!}</td>
                                        </tr>
                                        @endif
                                        @if($h_antecedentes->menopausia <> 'N/A')
                                            <tr>
                                                <td style="text-align: left "><b>Menopausia</b> : {!! nl2br(e($h_antecedentes->menopausia)) !!} </td>
                                            </tr>
                                            @endif
                                            @if($h_antecedentes->gestaciones <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Gestaciones</b> : {!! nl2br(e($h_antecedentes->gestaciones)) !!}</td>
                                                </tr>
                                                @endif
                                                @if($h_antecedentes->partos <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Partos</b> : {!! nl2br(e($h_antecedentes->partos)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_antecedentes->cesareas <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Cesareas</b> :{!! nl2br(e($h_antecedentes->cesareas)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_antecedentes->abortos <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Abortos</b> : {!! nl2br(e($h_antecedentes->abortos)) !!}</td>
                                                            </tr>
                                                            @endif
                                                            @if($h_antecedentes->hijos_macrosomicos <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Hijos macrosomicos</b> : {!! nl2br(e($h_antecedentes->hijos_macrosomicos)) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_antecedentes->preeclampsia_eclampsia <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"><b>Preeclampsia eclampsia</b> : {!! nl2br(e($h_antecedentes->preeclampsia_eclampsia)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_antecedentes->anticonceptivos <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left"><b>Anticonceptivos</b> : {!! nl2br(e($h_antecedentes->anticonceptivos)) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_antecedentes->fecha_ultima_papanicolau <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left"><b>Fecha ultimo papanicolau</b> : {!! nl2br(e($h_antecedentes->fecha_ultima_papanicolau)) !!}</td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_antecedentes->fecha_ultima_mamografia <> 'N/A')
                                                                                <tr>
                                                                                    <td style="text-align: left"><b>Fecha ultima mamografia</b> : {!! nl2br(e($h_antecedentes->fecha_ultima_mamografia)) !!}</td>
                                                                                </tr>
                                                                                @endif
                                                                                @if($h_antecedentes->fecha_ultima_densitometria <> 'N/A')
                                                                                    <tr>
                                                                                        <td style="text-align: left"><b>Fecha ultima densitometria</b> : {!! nl2br(e($h_antecedentes->fecha_ultima_densitometria)) !!} </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @if($h_antecedentes->fecha_ultimo_aborto <> 'N/A')
                                                                                        <tr>
                                                                                            <td style="text-align: left"><b>Fecha ultimo aborto</b> : {!! nl2br(e($h_antecedentes->fecha_ultimo_aborto )) !!} </td>
                                                                                        </tr>
                                                                                        @endif
                        </table>
                        @endif
                        @endforeach

                        @foreach ($permisos as $permiso)
                        @if($permiso->nombre_permiso=='Anamnesis_sistemas')<?php $n++ ?>
                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- ANAMNESIS POR SISTEMA</h5>
                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">

                            @if($h_antecedentes->cardiovascular_respiratorio <> 'N/A')
                                <tr>
                                    <td style="text-align: left"><b>Cardiovascular y respiratorio</b> : {!! nl2br(e($h_antecedentes->cardiovascular_respiratorio)) !!} </td>
                                </tr>
                                @endif
                                @if($h_antecedentes->gastro_intestinal <> 'N/A')
                                    <tr>
                                        <td style="text-align: left"><b>Gastro-intestinal</b> : {!! nl2br(e($h_antecedentes->gastro_intestinal)) !!} </td>
                                    </tr>
                                    @endif
                                    @if($h_antecedentes->genito_urinario <> 'N/A')
                                        <tr>
                                            <td style="text-align: left "><b>Genito-urinario </b>: {!! nl2br(e($h_antecedentes->genito_urinario )) !!}</td>
                                        </tr>
                                        @endif
                                        @if($h_antecedentes->hematologico <> 'N/A')
                                            <tr>
                                                <td style="text-align: left; "><b>Hematologico</b> : {!! nl2br(e($h_antecedentes->hematologico)) !!} </td>
                                            </tr>
                                            @endif
                                            @if($h_antecedentes->dermatologico <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left">Dermatologico : {!! nl2br(e($h_antecedentes->dermatologico)) !!}</td>
                                                </tr>
                                                @endif
                                                @if($h_antecedentes->neurologico <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Neurologico</b> : {!! nl2br(e($h_antecedentes->neurologico)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_antecedentes->locomotor <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Locomotor</b> : {!! nl2br(e($h_antecedentes->locomotor)) !!}</td>
                                                        </tr>
                                                        @endif
                        </table>
                        @endif
                        @endforeach
                        @if($h_examen_general->motivo_internacion <> 'N/A')<?php $n++ ?>
                            <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- MOTIVOS DE INTERNACION</h5>
                            <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_examen_general->motivo_internacion)) !!}</p>
                            @endif

                            @if($h_examen_general->historia_de_enfermedad_actual <> 'N/A')<?php $n++ ?>
                                <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- HISTORIA DE LA ENFERMEDAD ACTUAL</h5>
                                <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_examen_general->historia_de_enfermedad_actual)) !!} </p>
                                @endif
                                @if($h_examen_general->historia_de_enfermedad_actual <> 'N/A')<?php $n++ ?>
                                    <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- EXAMEN FISICO GENERAL</h5>
                                    @if($h_examen_general->examen_fisico_general <> 'N/A')
                                        <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_examen_general->examen_fisico_general)) !!} </p>
                                        @endif
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">

                                            @if($h_examen_general->estado_de_conciencia <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Estado de conciencia</b> : {!! nl2br(e($h_examen_general->estado_de_conciencia)) !!}</td>
                                                </tr>
                                                @endif
                                                @if($h_examen_general->posicion <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Posicion</b> : {!! nl2br(e($h_examen_general->posicion)) !!}</td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_general->color_piel_mucosa <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Color de piel y mucosa</b> : {!! nl2br(e($h_examen_general->color_piel_mucosa)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_general-> estado_hidratacion <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Estado de hidratacion</b> : {!! nl2br(e($h_examen_general-> estado_hidratacion)) !!}</td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_general->constitucion <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Constitucion</b> : {!! nl2br(e($h_examen_general->constitucion)) !!}</td>
                                                                </tr>
                                                                @endif
                                                                @if($h_examen_general->biotipo <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"><b>Biotipo</b> : {!! nl2br(e($h_examen_general->biotipo )) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_examen_general->marcha <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left "><b>Marchas</b> : {!! nl2br(e($h_examen_general->marcha)) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_examen_general->facies <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left"><b>Facies</b> : {!! nl2br(e($h_examen_general->facies)) !!}</td>
                                                                            </tr>
                                                                            @endif
                                        </table>
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            <TR style="text-align: left">><b>Signos vitales:</b></TR>

                                            @if($h_examen_general->apgar <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Apgar</b> : {!! nl2br(e($h_examen_general->apgar)) !!} </td>
                                                </tr>
                                                @endif
                                                @if($h_examen_general->silverman <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Silverman</b> : {!! nl2br(e($h_examen_general->silverman )) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_general->edad_por_capurro <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Edad por capurro</b> : {!! nl2br(e($h_examen_general->edad_por_capurro)) !!}</td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_general->somatometria <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Somatometria</b> : {!! nl2br(e($h_examen_general->somatometria)) !!}</td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_general-> tension_arterial <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Tension arterial</b> : {!! nl2br(e($h_examen_general-> tension_arterial)) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_examen_general->tension_arterial_media <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"><b>Tension arterial media</b> : {!! nl2br(e($h_examen_general->tension_arterial_media)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_examen_general->pa <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left"><b>PA</b> : {!! nl2br(e($h_examen_general->pa)) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_examen_general->frecuencia_cardiaca <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left "><b>Frecuencia cardiaca</b> : {!! nl2br(e($h_examen_general->frecuencia_cardiaca)) !!} </td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_examen_general->frecuencia_respiratoria <> 'N/A')
                                                                                <tr>
                                                                                    <td style="text-align: left"><b>Frecuencia respiratoria</b> : {!! nl2br(e($h_examen_general->frecuencia_respiratoria)) !!} </td>
                                                                                </tr>
                                                                                @endif
                                                                                @if($h_examen_general->temperatura <> 'N/A')
                                                                                    <tr>
                                                                                        <td style="text-align: left"><b>Temperatura</b> :{!! nl2br(e($h_examen_general->temperatura )) !!}</td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @if($h_examen_general->peso <> 'N/A')
                                                                                        <tr>
                                                                                            <td style="text-align: left"><b>Peso</b> : {!! nl2br(e($h_examen_general->peso)) !!} </td>
                                                                                        </tr>
                                                                                        @endif
                                                                                        @if($h_examen_general->talla <> 'N/A')
                                                                                            <tr>
                                                                                                <td style="text-align: left"><b>Talla</b> : {!! nl2br(e($h_examen_general->talla )) !!}</td>
                                                                                            </tr>
                                                                                            @endif
                                                                                            @if($h_examen_general->imc <> 'N/A')
                                                                                                <tr>
                                                                                                    <td style="text-align: left"><b>IMC</b> : {!! nl2br(e($h_examen_general->imc )) !!}</td>
                                                                                                </tr>
                                                                                                @endif
                                                                                                @if($h_examen_general->sato2 <> 'N/A')
                                                                                                    <tr>
                                                                                                        <td style="text-align: left"><b>Sato2</b> : {!! nl2br(e($h_examen_general->sato2 )) !!} </td>
                                                                                                    </tr>
                                                                                                    @endif
                                                                                                    @if($h_examen_general->saturacion <> 'N/A')
                                                                                                        <tr>
                                                                                                            <td style="text-align: left"><b>Saturacion</b> : {!! nl2br(e($h_examen_general->saturacion)) !!} </td>
                                                                                                        </tr>
                                                                                                        @endif
                                                                                                        @if($h_examen_general->sc <> 'N/A')
                                                                                                            <tr>
                                                                                                                <td style="text-align: left"><b>SC</b> : {!! nl2br(e($h_examen_general->sc)) !!}</td>
                                                                                                            </tr>
                                                                                                            @endif
                                                                                                            @if($h_examen_general->perimetro_cefalico <> 'N/A')
                                                                                                                <tr>
                                                                                                                    <td style="text-align: left"><b>Perimetro cefalico</b> : {!! nl2br(e($h_examen_general->perimetro_cefalico)) !!} </td>
                                                                                                                </tr>
                                                                                                                @endif
                                                                                                                @if($h_examen_general->perimetro_toracico <> 'N/A')
                                                                                                                    <tr>
                                                                                                                        <td style="text-align: left"><b>Perimetro toracico</b> : {!! nl2br(e($h_examen_general->perimetro_toracico)) !!}</td>
                                                                                                                    </tr>
                                                                                                                    @endif
                                                                                                                    @if($h_examen_general->perimetro_abdominal <> 'N/A')
                                                                                                                        <tr>
                                                                                                                            <td style="text-align: left"><b>Perimetro abdominal</b> : {!! nl2br(e($h_examen_general->perimetro_abdominal )) !!} </td>
                                                                                                                        </tr>
                                                                                                                        @endif
                                                                                                                        @if($h_examen_general->spo2 <> 'N/A')
                                                                                                                            <tr>
                                                                                                                                <td style="text-align: left"><b>SpO2</b> : {!! nl2br(e($h_examen_general->spo2)) !!}</td>
                                                                                                                            </tr>
                                                                                                                            @endif
                                                                                                                            @if($h_examen_general->fio2 <> 'N/A')
                                                                                                                                <tr>
                                                                                                                                    <td style="text-align: left"><b>FIO2</b> : {!! nl2br(e($h_examen_general->fio2)) !!}</td>
                                                                                                                                </tr>
                                                                                                                                @endif
                                        </table>
                                        @endif

                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Examen_fisico_segmentado')<?php $n++ ?>
                                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- EXAMEN FISICO SEGMENTADO</h5>
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_antecedentes->nombre_servicio =='MEDICINA INTERNA')
                                            <tr>
                                                <TD style="text-align: left"><B>CABEZA</B></TD>
                                            </tr>
                                            @endif
                                            @if($h_examen_segmentado->cabeza <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Cabeza</b> : {!! nl2br(e($h_examen_segmentado->cabeza)) !!} </td>
                                                </tr>
                                                @endif
                                                @if($h_examen_segmentado->frontales <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Frontales</b> : {!! nl2br(e($h_examen_segmentado->frontales )) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_segmentado->cabellos <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Cabellos</b> : {!! nl2br(e($h_examen_segmentado->cabellos)) !!}</td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_segmentado->cara <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Cara</b> : {!! nl2br(e($h_examen_segmentado->cara )) !!}</td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_segmentado->craneo <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Craneo</b> : {!! nl2br(e($h_examen_segmentado->craneo )) !!}</td>
                                                                </tr>
                                                                @endif

                                                                @if($h_examen_segmentado->apertura_ocular <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"><b>Apertura ocular</b> : {!! nl2br(e($h_examen_segmentado->apertura_ocular)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_examen_segmentado->ojos <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left"><b>Ojos</b> : {!! nl2br(e($h_examen_segmentado->ojos)) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_examen_segmentado->nariz <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left "><b>Nariz</b> : {!! nl2br(e($h_examen_segmentado->nariz)) !!} </td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_examen_segmentado->fosas_nasales <> 'N/A')
                                                                                <tr>
                                                                                    <td style="text-align: left"><b>Fosas nasales</b> : {!! nl2br(e($h_examen_segmentado->fosas_nasales)) !!} </td>
                                                                                </tr>
                                                                                @endif
                                                                                @if($h_examen_segmentado->piramide_nasal <> 'N/A')
                                                                                    <tr>
                                                                                        <td style="text-align: left"><b>Piramide nasal</b> : {!! nl2br(e($h_examen_segmentado->piramide_nasal )) !!} </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @if($h_examen_segmentado->coanas <> 'N/A')
                                                                                        <tr>
                                                                                            <td style="text-align: left"><b>Coanas</b> : {!! nl2br(e($h_examen_segmentado->coanas )) !!} </td>
                                                                                        </tr>
                                                                                        @endif
                                                                                        @if($h_examen_segmentado->oidos <> 'N/A')
                                                                                            <tr>
                                                                                                <td style="text-align: left"><b>Oidos</b> : {!! nl2br(e($h_examen_segmentado->oidos)) !!} </td>
                                                                                            </tr>
                                                                                            @endif
                                                                                            @if($h_examen_segmentado->pabellon_auricular <> 'N/A')
                                                                                                <tr>
                                                                                                    <td style="text-align: left"><b>Pabellon auricular</b> : {!! nl2br(e($h_examen_segmentado->pabellon_auricular)) !!} </td>
                                                                                                </tr>
                                                                                                @endif
                                                                                                @if($h_examen_segmentado->curvatura <> 'N/A')
                                                                                                    <tr>
                                                                                                        <td style="text-align: left"><b>Curvatura</b> : {!! nl2br(e($h_examen_segmentado->curvatura)) !!} </td>
                                                                                                    </tr>
                                                                                                    @endif
                                                                                                    @if($h_examen_segmentado->boca <> 'N/A')
                                                                                                        <tr>
                                                                                                            <td style="text-align: left"><b>Boca</b> : {!! nl2br(e($h_examen_segmentado->boca )) !!} </td>
                                                                                                        </tr>
                                                                                                        @endif
                                                                                                        @if($h_examen_segmentado->apertura_bucal <> 'N/A')
                                                                                                            <tr>
                                                                                                                <td style="text-align: left"> <b>Apertura bucal</b> : {!! nl2br(e($h_examen_segmentado->apertura_bucal)) !!} </td>
                                                                                                            </tr>
                                                                                                            @endif
                                                                                                            @if($h_examen_segmentado->paladar <> 'N/A')
                                                                                                                <tr>
                                                                                                                    <td style="text-align: left"><b>Paladar</b> : {!! nl2br(e($h_examen_segmentado->paladar)) !!} </td>
                                                                                                                </tr>
                                                                                                                @endif
                                                                                                                @if($h_examen_segmentado->mucosa_oral <> 'N/A')
                                                                                                                    <tr>
                                                                                                                        <td style="text-align: left"><b>Mucosa oral</b> : {!! nl2br(e($h_examen_segmentado->mucosa_oral)) !!} </td>
                                                                                                                    </tr>
                                                                                                                    @endif
                                                                                                                    <!-- SECCION CUELLO  -->

                                                                                                                    @if($h_antecedentes->nombre_servicio =='MEDICINA INTERNA')
                                                                                                                    <br>
                                                                                                                    <tr>
                                                                                                                        <td style="text-align: left"><b>CUELLO</b> </td>
                                                                                                                    </tr>
                                                                                                                    @if($h_examen_segmentado->cuello_inspeccion <> 'N/A')
                                                                                                                        <tr>
                                                                                                                            <td style="text-align: left"><b>Inspeccion</b> : {!! nl2br(e($h_examen_segmentado->cuello_inspeccion )) !!} </td>
                                                                                                                        </tr>
                                                                                                                        @endif
                                                                                                                        @if($h_examen_segmentado->cuello_palpacion <> 'N/A')
                                                                                                                            <tr>
                                                                                                                                <td style="text-align: left"><b>Palpacion</b> : {!! nl2br(e($h_examen_segmentado->cuello_palpacion )) !!} </td>
                                                                                                                            </tr>
                                                                                                                            @endif
                                                                                                                            @if($h_examen_segmentado->cuello_auscultacion <> 'N/A')
                                                                                                                                <tr>
                                                                                                                                    <td style="text-align: left"><b>Auscultacion</b> : {!! nl2br(e($h_examen_segmentado->cuello_auscultacion)) !!} </td>
                                                                                                                                </tr> <br>
                                                                                                                                @endif

                                                                                                                                @else

                                                                                                                                @if($h_examen_segmentado->cuello <> 'N/A')
                                                                                                                                    <tr>
                                                                                                                                        <td style="text-align: left"><b>Cuello</b> : {!! nl2br(e($h_examen_segmentado->cuello)) !!} </td>
                                                                                                                                    </tr>

                                                                                                                                    @endif
                                                                                                                                    @if($h_examen_segmentado->cuello_inspeccion <> 'N/A' || $h_examen_segmentado->cuello_palpacion <> 'N/A' || $h_examen_segmentado->cuello_auscultacion <>'N/A' )
                                                                                                                                                <tr>
                                                                                                                                                    <td style="text-align: left"> <b>Cuello:</b></td>
                                                                                                                                                </tr>
                                                                                                                                                @endif
                                                                                                                                                @if($h_examen_segmentado->cuello_inspeccion <> 'N/A')
                                                                                                                                                    <tr>
                                                                                                                                                        <td class="item indent-3" style="text-align: left"><b>Inspeccion</b> : {!! nl2br(e($h_examen_segmentado->cuello_inspeccion )) !!} </td>
                                                                                                                                                    </tr>
                                                                                                                                                    @endif
                                                                                                                                                    @if($h_examen_segmentado->cuello_palpacion <> 'N/A')
                                                                                                                                                        <tr>
                                                                                                                                                            <td class="item indent-3" style="text-align: left"><b>Palpacion</b> : {!! nl2br(e($h_examen_segmentado->cuello_palpacion )) !!} </td>
                                                                                                                                                        </tr>
                                                                                                                                                        @endif
                                                                                                                                                        @if($h_examen_segmentado->cuello_auscultacion <> 'N/A')
                                                                                                                                                            <tr>
                                                                                                                                                                <td class="item indent-3" style="text-align: left"><b>Auscultacion</b> : {!! nl2br(e($h_examen_segmentado->cuello_auscultacion)) !!} </td>
                                                                                                                                                            </tr>
                                                                                                                                                            @endif

                                                                                                                                                            @endif
                                                                                                                                                            <!-- SECCION TORAX -->


                                                                                                                                                            @if($h_antecedentes->nombre_servicio =='MEDICINA INTERNA')
                                                                                                                                                            <tr>
                                                                                                                                                                <td style="text-align: left"><b>TORAX</b> </td>
                                                                                                                                                            </tr>
                                                                                                                                                            @if($h_examen_segmentado->torax_inspeccion_estatico <> 'N/A')
                                                                                                                                                                <tr>
                                                                                                                                                                    <td style="text-align: left"><b>Inspección estática</b> : {!! nl2br(e($h_examen_segmentado->torax_inspeccion_estatico )) !!}</td>
                                                                                                                                                                </tr>
                                                                                                                                                                @endif
                                                                                                                                                                @if($h_examen_segmentado->torax_inspeccion_dinamico <> 'N/A')
                                                                                                                                                                    <tr>
                                                                                                                                                                        <td style="text-align: left"><b>Inspección dinámica</b> : {!! nl2br(e($h_examen_segmentado->torax_inspeccion_dinamico)) !!}</td>
                                                                                                                                                                    </tr>
                                                                                                                                                                    @endif
                                                                                                                                                                    @if($h_examen_segmentado->abdomen_palpacion <> 'N/A')
                                                                                                                                                                        <tr>
                                                                                                                                                                            <td style="text-align: left"> <b>Palpación</b> :{!! nl2br(e($h_examen_segmentado->abdomen_palpacion )) !!} </td>
                                                                                                                                                                        </tr>
                                                                                                                                                                        @endif
                                                                                                                                                                        @if($h_examen_segmentado->torax_percusion <> 'N/A')
                                                                                                                                                                            <tr>
                                                                                                                                                                                <td style="text-align: left"><b>Percusión</b> : {!! nl2br(e($h_examen_segmentado->torax_percusion)) !!} </td>
                                                                                                                                                                            </tr>
                                                                                                                                                                            @endif
                                                                                                                                                                            @if($h_examen_segmentado->torax_auscultacion <> 'N/A')
                                                                                                                                                                                <tr>
                                                                                                                                                                                    <td style="text-align: left"><b>Auscultación</b> : {!! nl2br(e($h_examen_segmentado->torax_auscultacion)) !!} </td>
                                                                                                                                                                                </tr>
                                                                                                                                                                                @endif
                                                                                                                                                                                <br>

                                                                                                                                                                                @else

                                                                                                                                                                                @if($h_examen_segmentado->torax <> 'N/A')
                                                                                                                                                                                    <tr>
                                                                                                                                                                                        <td style="text-align: left"><b>Torax</b> : {!! nl2br(e($h_examen_segmentado->torax)) !!} </td>
                                                                                                                                                                                    </tr>
                                                                                                                                                                                     @endif
                                                                                                                                                                                    @if($h_examen_segmentado->torax_inspeccion_estatico <> 'N/A' || $h_examen_segmentado->torax_inspeccion_dinamico <> 'N/A' || $h_examen_segmentado->torax_palpacion <> 'N/A' || $h_examen_segmentado->torax_percusion <> 'N/A' || $h_examen_segmentado->torax_auscultacion <> 'N/A')
                                                                                                                                                                                    <tr>
                                                                                                                                                                                        <td style="text-align: left"> <b>Torax:</b></td>
                                                                                                                                                                                    </tr> 
                                                                                                                                                                                    @endif
                                                                                                                                                                                    @if($h_examen_segmentado->torax_inspeccion_estatico <> 'N/A')
                                                                                                                                                                                        <tr>
                                                                                                                                                                                            <td class="item indent-3" style="text-align: left"><b>Inspección estática</b> : {!! nl2br(e($h_examen_segmentado->torax_inspeccion_estatico )) !!} </td>
                                                                                                                                                                                        </tr>
                                                                                                                                                                                        @endif
                                                                                                                                                                                        @if($h_examen_segmentado->torax_inspeccion_dinamico <> 'N/A')
                                                                                                                                                                                            <tr>
                                                                                                                                                                                                <td class="item indent-3" style="text-align: left"><b>Inspección dinámica</b> : {!! nl2br(e($h_examen_segmentado->torax_inspeccion_dinamico)) !!}</td>
                                                                                                                                                                                            </tr>
                                                                                                                                                                                            @endif
                                                                                                                                                                                            @if($h_examen_segmentado->torax_palpacion <> 'N/A')
                                                                                                                                                                                                <tr>
                                                                                                                                                                                                    <td class="item indent-3" style="text-align: left"> <b>Palpación</b> : {!! nl2br(e($h_examen_segmentado->torax_palpacion)) !!}</td>
                                                                                                                                                                                                </tr>
                                                                                                                                                                                                @endif
                                                                                                                                                                                                @if($h_examen_segmentado->torax_percusion <> 'N/A')
                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                        <td class="item indent-3" style="text-align: left"> <b>Percusión</b> : {!! nl2br(e($h_examen_segmentado->torax_percusion)) !!}</td>
                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                    @endif
                                                                                                                                                                                                    @if($h_examen_segmentado->torax_auscultacion <> 'N/A')
                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                            <td class="item indent-3" style="text-align: left"><b>Auscultación</b> : {!! nl2br(e($h_examen_segmentado->torax_auscultacion)) !!} </td>
                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                        @endif

                                                                                                                                                                                                        @endif

                                                                                                                                                                                                        @if($h_examen_segmentado->mamas <> 'N/A')
                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                <td style="text-align: left"> <b>Mamas</b> : {!! nl2br(e($h_examen_segmentado->mamas )) !!} </td>
                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                            @endif
                                                                                                                                                                                                            @if($h_examen_segmentado->pulmones <> 'N/A')
                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                    <td style="text-align: left"> <b>Pulmones</b> : {!! nl2br(e($h_examen_segmentado->pulmones)) !!} </td>
                                                                                                                                                                                                                </tr>

                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                @if($h_examen_segmentado->pulmones_inspeccion <> 'N/A' || $h_examen_segmentado->pulmones_palpacion <> 'N/A' || $h_examen_segmentado->pulmones_percusion <> 'N/A' || $h_examen_segmentado->pulmones_auscultacion <> 'N/A' )
                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                    <td style="text-align: left"> <b>Pulmones:</b></td>
                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                @if($h_examen_segmentado->pulmones_inspeccion <> 'N/A')
                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                        <td class="item indent-3" style="text-align: left;"><b> Inspección</b> : {!! nl2br(e($h_examen_segmentado->pulmones_inspeccion)) !!} </td>
                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                    @if($h_examen_segmentado->pulmones_palpacion <> 'N/A')
                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                            <td class="item indent-3" style="text-align: left"><b>Pulmones palpacion</b> : {!! nl2br(e($h_examen_segmentado->pulmones_palpacion )) !!} </td>
                                                                                                                                                                                                                                        </tr>

                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                        @if($h_examen_segmentado->pulmones_percusion <> 'N/A')
                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                <td class="item indent-3" style="text-align: left;"><b> Percusión.</b> {!! nl2br(e($h_examen_segmentado->pulmones_percusion)) !!} </td>

                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                            @if($h_examen_segmentado->pulmones_auscultacion <> 'N/A')
                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                    <td class="item indent-3" style="text-align: left"><b> Auscultación</b> : {!! nl2br(e($h_examen_segmentado->pulmones_auscultacion )) !!} </td>
                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                                @if($h_examen_segmentado->corazon <> 'N/A')
                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                        <td style="text-align: left"><b>Corazón</b> : {!! nl2br(e($h_examen_segmentado->corazon )) !!} </td>
                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                    @if($h_examen_segmentado->corazon_inspeccion <> 'N/A' || $h_examen_segmentado->corazon_palpacion <> 'N/A' || $h_examen_segmentado->corazon_percusion <> 'N/A' || $h_examen_segmentado->corazon_auscultacion <> 'N/A' )

                                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                                        <td style="text-align: left"> <b>Corazón:</b></td>
                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                                    @if($h_examen_segmentado->corazon_inspeccion <> 'N/A')
                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                            <td class="item indent-3" style="text-align: left"><b>Inspección</b> : {!! nl2br(e($h_examen_segmentado->corazon_inspeccion)) !!} </td>
                                                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                        @if($h_examen_segmentado->corazon_palpacion <> 'N/A')
                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                <td class="item indent-3" style="text-align: left"><b>Palpación</b> : {!! nl2br(e($h_examen_segmentado->corazon_palpacion)) !!} </td>
                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                            @if($h_examen_segmentado->corazon_percusion <> 'N/A')
                                                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                                                    <td class="item indent-3" style="text-align: left"><b>Percusión</b> : {!! nl2br(e($h_examen_segmentado->corazon_percusion )) !!} </td>
                                                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                                                                @if($h_examen_segmentado->corazon_auscultacion <> 'N/A')
                                                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                                                        <td class="item indent-3" style="text-align: left"><b>Auscultación</b> : {!! nl2br(e($h_examen_segmentado->corazon_auscultacion)) !!} </td>
                                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                                                    @if($h_examen_segmentado->precordio <> 'N/A')
                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                            <td style="text-align: left"><b>Precordio</b> : {!! nl2br(e($h_examen_segmentado->precordio)) !!} </td>
                                                                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                                        @endif

                                                                                                                                                                                                                                                                                        <!-- SECCION ABDOMEN -->

                                                                                                                                                                                                                                                                                        @if($h_antecedentes->nombre_servicio =='MEDICINA INTERNA')
                                                                                                                                                                                                                                                                                        <tr>

                                                                                                                                                                                                                                                                                            <td style="text-align: left"><b>ABDOMEN</b> </td>
                                                                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                                        @if($h_examen_segmentado->abdomen_inspeccion <> 'N/A')
                                                                                                                                                                                                                                                                                            <tr>

                                                                                                                                                                                                                                                                                                <td style="text-align: left"><b>Inspección</b> : {!! nl2br(e($h_examen_segmentado->abdomen_inspeccion)) !!} </td>
                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                                            @if($h_examen_segmentado->abdomen_palpacion <> 'N/A')
                                                                                                                                                                                                                                                                                                <tr>

                                                                                                                                                                                                                                                                                                    <td style="text-align: left"> <b>Palpación</b> :{!! nl2br(e($h_examen_segmentado->abdomen_palpacion )) !!} </td>
                                                                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                                                                                @if($h_examen_segmentado->abdomen_percusion <> 'N/A')
                                                                                                                                                                                                                                                                                                    <tr>

                                                                                                                                                                                                                                                                                                        <td style="text-align: left"><b>Percusión</b> : {!! nl2br(e($h_examen_segmentado->abdomen_percusion)) !!} </td>
                                                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                                                                    @if($h_examen_segmentado->abdomen_auscultacion <> 'N/A')
                                                                                                                                                                                                                                                                                                        <tr>

                                                                                                                                                                                                                                                                                                            <td style="text-align: left"><b>Auscultación</b> : {!! nl2br(e($h_examen_segmentado->abdomen_auscultacion)) !!}</td>
                                                                                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                                                        @else
                                                                                                                                                                                                                                                                                                        @if($h_examen_segmentado->abdomen <> 'N/A')
                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                <td style="text-align: left"><b>Abdomen</b> : {!! nl2br(e($h_examen_segmentado->abdomen)) !!} </td>
                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                                                            @if($h_examen_segmentado->abdomen_inspeccion <> 'N/A' || $h_examen_segmentado->abdomen_palpacion <> 'N/A' || $h_examen_segmentado->abdomen_percusion <> 'N/A' || $h_examen_segmentado->abdomen_auscultacion <> 'N/A' )
                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                <td style="text-align: left"> <b>Abdomen:</b></td>
                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                                                            @if($h_examen_segmentado->abdomen_inspeccion <> 'N/A')
                                                                                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                                                                                    <td class="item indent-3" style="text-align: left"><b>Inspección</b> : {!! nl2br(e($h_examen_segmentado->abdomen_inspeccion)) !!} </td>
                                                                                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                                                                                                @if($h_examen_segmentado->abdomen_palpacion <> 'N/A')
                                                                                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                                                                                        <td class="item indent-3" style="text-align: left"><b>Palpación</b> : {!! nl2br(e($h_examen_segmentado->abdomen_palpacion )) !!} </td>
                                                                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                                                                                    @if($h_examen_segmentado->abdomen_percusion <> 'N/A')
                                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                            <td class="item indent-3" style="text-align: left"><b>Percusión</b> : {!! nl2br(e($h_examen_segmentado->abdomen_percusion)) !!} </td>
                                                                                                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                                                                        @if($h_examen_segmentado->abdomen_auscultacion <> 'N/A')
                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                <td class="item indent-3" style="text-align: left"><b>Auscultación</b> : {!! nl2br(e($h_examen_segmentado->abdomen_auscultacion)) !!} </td>
                                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                                            @endif

                                                                                                                                                                                                                                                                                                                            @endif


                                                                                                                                                                                                                                                                                                                            @if($h_examen_segmentado->relacion_arteriovenosa <> 'N/A')
                                                                                                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                                                                                                    <td style="text-align: left"><b>Relacion arteriovenosa</b> : {!! nl2br(e($h_examen_segmentado->relacion_arteriovenosa)) !!} </td>
                                                                                                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                                                                                                @endif

                                                                                                                                                                                                                                                                                                                                @if($h_examen_segmentado->cordon_umbilical <> 'N/A')
                                                                                                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                                                                                                        <td style="text-align: left"><b>Cordon Umbilical</b> : {!! nl2br(e($h_examen_segmentado->cordon_umbilical)) !!} </td>
                                                                                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                                                                                                    @if($h_examen_segmentado->genitales_acuerdo_sexo_edad <> 'N/A')
                                                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                                            <td style="text-align: left"><b>Genitales de acuerdo a su edad</b> : {!! nl2br(e($h_examen_segmentado->genitales_acuerdo_sexo_edad)) !!} </td>
                                                                                                                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                                                                                        @if($h_examen_segmentado->pies <> 'N/A')
                                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                                <td style="text-align: left"><b>Pies</b> : {!! nl2br(e($h_examen_segmentado->pies)) !!} </td>
                                                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                                                                                            @if($h_examen_segmentado->surcos_plantales <> 'N/A')
                                                                                                                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                                                                                                                    <td style="text-align: left"><b>Surcos plantales</b> : {!! nl2br(e($h_examen_segmentado->surcos_plantales)) !!} </td>
                                                                                                                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                                                                                                                                @if($h_examen_segmentado->reflejos_succion <> 'N/A')
                                                                                                                                                                                                                                                                                                                                                    <tr>
                                                                                                                                                                                                                                                                                                                                                        <td style="text-align: left"><b>Reflejos de succion</b> : {!! nl2br(e($h_examen_segmentado->reflejos_succion)) !!} </td>
                                                                                                                                                                                                                                                                                                                                                    </tr>
                                                                                                                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                                                                                                                    @if($h_examen_segmentado->genitourinarios <> 'N/A')
                                                                                                                                                                                                                                                                                                                                                        <tr>
                                                                                                                                                                                                                                                                                                                                                            <td style="text-align: left"><b>Genitourinarios</b> : {!! nl2br(e( $h_examen_segmentado->genitourinarios )) !!} </td>
                                                                                                                                                                                                                                                                                                                                                        </tr>
                                                                                                                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                                                                                                                        @if($h_examen_segmentado->extremidades <> 'N/A')
                                                                                                                                                                                                                                                                                                                                                            <tr>
                                                                                                                                                                                                                                                                                                                                                                <td style="text-align: left"><b>Extremidades</b> : {!! nl2br(e($h_examen_segmentado->extremidades)) !!} </td>
                                                                                                                                                                                                                                                                                                                                                            </tr>
                                                                                                                                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                                                                                                                                            @if($h_examen_segmentado->neurologicos <> 'N/A')
                                                                                                                                                                                                                                                                                                                                                                <tr>
                                                                                                                                                                                                                                                                                                                                                                    <td style="text-align: left"><b>Neurologico</b> : {!! nl2br(e($h_examen_segmentado->neurologicos)) !!} </td>
                                                                                                                                                                                                                                                                                                                                                                </tr>
                                                                                                                                                                                                                                                                                                                                                                @endif
                                        </table><br>
                                        @endif
                                        @endforeach

                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Examen_cardiovascular')
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_examen_segmentado_mi->cardiovascular_palpacion <> 'N/A')
                                                <TR style="text-align: left"><b>CARDIOVASCULAR</b></TR>
                                                @endif
                                                @if($h_examen_segmentado_mi->cardiovascular_palpacion <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Palpación</b> : {!! nl2br(e($h_examen_segmentado_mi->cardiovascular_palpacion)) !!}</td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_segmentado_mi->cardiovascular_percusion <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Percusión</b> : {!! nl2br(e($h_examen_segmentado_mi->cardiovascular_percusion)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_segmentado_mi->cardiovascular_auscultacion <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Auscultación</b> : {!! nl2br(e($h_examen_segmentado_mi->cardiovascular_auscultacion)) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_segmentado_mi->cardiovascular_agregados <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"> - Agregados: {!! nl2br(e($h_examen_segmentado_mi->cardiovascular_agregados)) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_examen_segmentado_mi->cardiovascular_soplos <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"> - Soplos: {!! nl2br(e($h_examen_segmentado_mi->cardiovascular_soplos)) !!}</td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_examen_segmentado_mi->cardiovascular_fremito <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left"> - Frémito: {!! nl2br(e($h_examen_segmentado_mi->cardiovascular_fremito)) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                            
                                        </table>
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">

                                                                        @if($h_examen_segmentado_mi->pulsos_perifericos <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left"> Pulso periféricos: {!! nl2br(e($h_examen_segmentado_mi->pulsos_perifericos)) !!}</td>
                                                                            </tr>
                                                                            @endif

                                                                            <tr>
                                                                                @if($h_examen_segmentado_mi->branquial <> 'N/A')
                                                                                    <td style="text-align: left;width: 40%;"> Branquial: {!! nl2br(e($h_examen_segmentado_mi->branquial)) !!}</td>
                                                                                    @endif
                                                                                    @if($h_examen_segmentado_mi->radial <> 'N/A')
                                                                                        <td style="text-align: left;width: 40%;"> Radial: {!! nl2br(e($h_examen_segmentado_mi->radial)) !!} </td>
                                                                                        @endif
                                                                            </tr>
                                                                            <tr>
                                                                                @if($h_examen_segmentado_mi->femoral <> 'N/A')
                                                                                    <td style="text-align: left;width: 40%;"> Femoral: {!! nl2br(e($h_examen_segmentado_mi->femoral)) !!} </td>
                                                                                    @endif
                                                                                    @if($h_examen_segmentado_mi->popliteo <> 'N/A')
                                                                                        <td style="text-align: left;width: 40%;"> Popliteo: {!! nl2br(e($h_examen_segmentado_mi->popliteo)) !!} </td>
                                                                                        @endif
                                                                            </tr>
                                                                            <tr>
                                                                                @if($h_examen_segmentado_mi->tibia <> 'N/A')
                                                                                    <td style="text-align: left;width: 40%;">Tibial: {!! nl2br(e($h_examen_segmentado_mi->tibia)) !!} </td>
                                                                                    @endif
                                                                                    @if($h_examen_segmentado_mi->pedio <> 'N/A')
                                                                                        <td style="text-align: left;width: 40%;">Pedio: {!! nl2br(e($h_examen_segmentado_mi->pedio)) !!} </td>
                                                                                        @endif
                                                                            </tr>
                                        </table><br>
                                        @endif
                                        @endforeach

                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Examen_genito_urinario')
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_examen_segmentado_mi->punio_percusion_renal <> 'N/A')
                                                <TR style="text-align: left"><b>GENITO-URINARIO</b></TR>
                                                @endif
                                                @if($h_examen_segmentado_mi->punio_percusion_renal <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Puño percusión renal</b> : {!! nl2br(e($h_examen_segmentado_mi->punio_percusion_renal)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_segmentado_mi->palpacion_renal <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Palpación renal</b> : {!! nl2br(e($h_examen_segmentado_mi->palpacion_renal)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_segmentado_mi->puntos_ureterales <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Puntos ureterales</b> : {!! nl2br(e($h_examen_segmentado_mi->puntos_ureterales)) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_segmentado_mi->genitales <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Genitales</b> : {!! nl2br(e($h_examen_segmentado_mi->genitales)) !!} </td>
                                                                </tr>
                                                                @endif
                                        </table> <br>
                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Examen_extremidades_superiores')
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_examen_segmentado_mi->genitales <> 'N/A')
                                                <TR style="text-align: left"><b>EXTREMIDADES SUPERIORES:</b></TR>
                                                @endif
                                                @if($h_examen_segmentado_mi->s_simetria <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Simetría</b> : {!! nl2br(e($h_examen_segmentado_mi->s_simetria)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_segmentado_mi->s_deformidades <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Deformidades</b> : {!! nl2br(e($h_examen_segmentado_mi->s_deformidades)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_segmentado_mi->s_articulaciones <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Articulaciones</b> : {!! nl2br(e($h_examen_segmentado_mi->s_articulaciones)) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_segmentado_mi->s_piel <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Piel</b> : {!! nl2br(e($h_examen_segmentado_mi->s_piel)) !!} </td>
                                                                </tr>
                                                                @endif
                                        </table><br>
                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Examen_extremidades_inferiores')
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_examen_segmentado_mi->i_simetria <> 'N/A')
                                                <TR style="text-align: left"><b>EXTREMIDADES INFERIORES:</b></TR>
                                                @endif
                                                @if($h_examen_segmentado_mi->i_simetria <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Simetría</b> : {!! nl2br(e($h_examen_segmentado_mi->i_simetria)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_segmentado_mi->i_deformidades <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Deformidades</b> : {!! nl2br(e($h_examen_segmentado_mi->i_deformidades)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_segmentado_mi->i_articulaciones <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Articulaciones</b> : {!! nl2br(e($h_examen_segmentado_mi->i_articulaciones)) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_segmentado_mi->i_piel <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Piel</b> : {!! nl2br(e($h_examen_segmentado_mi->i_piel)) !!} </td>
                                                                </tr>
                                                                @endif
                                        </table><br>
                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Dermatologia')
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_examen_segmentado_mi->piel <> 'N/A')
                                                <TR style="text-align: left"><b>DERMATOLOGICO:</b></TR>
                                                @endif
                                                @if($h_examen_segmentado_mi->piel <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Piel</b> : {!! nl2br(e($h_examen_segmentado_mi->piel)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_segmentado_mi->pelo <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Pelo</b> : {!! nl2br(e($h_examen_segmentado_mi->pelo)) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_segmentado_mi->unias <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Uñas</b> : {!! nl2br(e($h_examen_segmentado_mi->unias )) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_segmentado_mi->mucosas <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Mucosas</b> : {!! nl2br(e($h_examen_segmentado_mi->mucosas)) !!}</td>
                                                                </tr>
                                                                @endif
                                                                @if($h_examen_segmentado_mi->topografia <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"><b>Topografía</b>: {!! nl2br(e($h_examen_segmentado_mi->topografia)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_examen_segmentado_mi->iconografia <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left"><b>Morfología</b> : {!! nl2br(e($h_examen_segmentado_mi->iconografia)) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_examen_segmentado_mi->morfologia <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left"><b>Iconografía</b> : {!! nl2br(e($h_examen_segmentado_mi->morfologia)) !!} </td>
                                                                            </tr>
                                                                            @endif
                                        </table><br>
                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Ganglios_linfaticos')
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            <th style="text-align: left">
                                                GANGLIOS LINFÁTICOS
                                            </th>
                                            <tr style="text-align: left">
                                                <td>{!! nl2br(e($h_examen_segmentado_mi->ganglios_linfaticos )) !!}</td>
                                            </tr>
                                        </table>

                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Examen_ginecologico')

                                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif;">EXAMEN GINECOLOGICO</h5>

                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_examen_segmentado_mi->vello_pubiano <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Vello pubiano</b> : {!! nl2br(e($h_examen_segmentado_mi->vello_pubiano )) !!} </td>
                                                </tr>
                                                @endif
                                                @if($h_examen_segmentado_mi->vulva <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Vulva</b> : {!! nl2br(e($h_examen_segmentado_mi->vulva)) !!}</td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_segmentado_mi->uretra <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>Uretra</b> : {!! nl2br(e($h_examen_segmentado_mi->uretra )) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_segmentado_mi->glandulas_bys <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>Glandula ByS</b> : {!! nl2br(e($h_examen_segmentado_mi->glandulas_bys )) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_segmentado_mi->clitoris <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Clitoris</b> : {!! nl2br(e($h_examen_segmentado_mi->clitoris)) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_examen_segmentado_mi->perineo <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"><b>Perineo</b> : {!! nl2br(e($h_examen_segmentado_mi->perineo)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_examen_segmentado_mi->vagina <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left"><b>Vagina</b> : {!! nl2br(e($h_examen_segmentado_mi->vagina)) !!}</td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_examen_segmentado_mi->cuello_uterino <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left"><b>Cuello</b> : {!! nl2br(e($h_examen_segmentado_mi->cuello_uterino )) !!} </td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_examen_segmentado_mi->cuerpo_uterino <> 'N/A')
                                                                                <tr>
                                                                                    <td style="text-align: left"><b>Cuerpo uterino</b> : {!! nl2br(e($h_examen_segmentado_mi->cuerpo_uterino)) !!} </td>
                                                                                </tr>
                                                                                @endif
                                                                                @if($h_examen_segmentado_mi->anexos <> 'N/A')
                                                                                    <tr>
                                                                                        <td style="text-align: left"><b>Anexos</b> : {!! nl2br(e($h_examen_segmentado_mi->anexos )) !!}</td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @if($h_examen_segmentado_mi->especuloscopia <> 'N/A')
                                                                                        <tr>
                                                                                            <td style="text-align: left"><b>Especuloscopia</b> : {!! nl2br(e($h_examen_segmentado_mi->especuloscopia )) !!} </td>
                                                                                        </tr>
                                                                                        @endif
                                                                                        @if($h_examen_segmentado_mi->tacto_rectal <> 'N/A')
                                                                                            <tr>
                                                                                                <td style="text-align: left"><b>Tacto rectal</b> : {!! nl2br(e($h_examen_segmentado_mi->tacto_rectal)) !!} </td>
                                                                                            </tr>
                                                                                            @endif
                                        </table>
                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Examen_obstetrico')

                                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif">EXAMEN OBSTÉTRICO</h5>

                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_examen_segmentado_mi->genitales <> 'N/A')
                                                <tr>
                                                    <td style="text-align: left"><b>Genitales</b> : {!! nl2br(e($h_examen_segmentado_mi->genitales)) !!} </td>
                                                </tr>
                                                @endif
                                                @if($h_examen_segmentado_mi->flujos <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left"><b>Flujos</b> : {!! nl2br(e($h_examen_segmentado_mi->flujos)) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_examen_segmentado_mi->afu <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left"><b>AFU</b> : {!! nl2br(e($h_examen_segmentado_mi->afu )) !!} </td>
                                                        </tr>
                                                        @endif
                                                        @if($h_examen_segmentado_mi->fcf <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left"><b>FCF</b> : {!! nl2br(e($h_examen_segmentado_mi->fcf)) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_examen_segmentado_mi->situacion <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left"><b>Situación</b> : {!! nl2br(e($h_examen_segmentado_mi->situacion)) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_examen_segmentado_mi->posicion <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left"><b>Posición</b> : {!! nl2br(e($h_examen_segmentado_mi->posicion)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_examen_segmentado_mi->presentacion <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left"><b>Presentación</b> : {!! nl2br(e($h_examen_segmentado_mi->presentacion)) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_examen_segmentado_mi->movimientos_fetales <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left"><b>Movimientos fetales</b> : {!! nl2br(e($h_examen_segmentado_mi->movimientos_fetales)) !!} </td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_examen_segmentado_mi->tacto_vaginal <> 'N/A')
                                                                                <tr>
                                                                                    <td style="text-align: left"><b>Tacto vaginal</b> : {!! nl2br(e($h_examen_segmentado_mi->tacto_vaginal)) !!} </td>
                                                                                </tr>
                                                                                @endif
                                        </table>
                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Sistema_nervioso')<?php $n++ ?>
                                        <h5 style="font-size: 13px;text-align:left;font-family: Arial, sans-serif;">{!! nl2br(e($n)) !!}.- SISTEMA NERVIOSO</h5>

                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            @if($h_sistema_nervioso->conciencia <> 'N/A')
                                                <TR style="text-align: left"><b>Funciones cerebrales superiores</b></TR>
                                                <tr>
                                                    <td style="text-align: left">1. Conciencia: {!! nl2br(e($h_sistema_nervioso->conciencia)) !!} </td>
                                                </tr>
                                                @endif
                                                @if($h_sistema_nervioso->gnosia <> 'N/A')
                                                    <tr>
                                                        <td style="text-align: left">2. Gnosia: {!! nl2br(e($h_sistema_nervioso->gnosia )) !!}</td>
                                                    </tr>
                                                    @endif
                                                    @if($h_sistema_nervioso->praxia <> 'N/A')
                                                        <tr>
                                                            <td style="text-align: left">3. Praxia: {!! nl2br(e($h_sistema_nervioso->praxia )) !!}</td>
                                                        </tr>
                                                        @endif
                                                        @if($h_sistema_nervioso->lenguaje <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left">4. Lenguaje: {!! nl2br(e( $h_sistema_nervioso->lenguaje )) !!}</td>
                                                            </tr>
                                                            @endif
                                                            @if($h_sistema_nervioso->memoria <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left">5. Memoria: {!! nl2br(e($h_sistema_nervioso->memoria )) !!}</td>
                                                                </tr>
                                                                @endif
                                                                @if($h_sistema_nervioso->calculo <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left">6. Cálculo: {!! nl2br(e($h_sistema_nervioso->calculo)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_sistema_nervioso->inteligencia <> 'N/A')
                                                                        <tr>
                                                                            <td style="text-align: left">7. Inteligencia: {!! nl2br(e($h_sistema_nervioso->inteligencia )) !!} </td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_sistema_nervioso->atencion <> 'N/A')
                                                                            <tr>
                                                                                <td style="text-align: left">8. Atención: {!! nl2br(e($h_sistema_nervioso->atencion )) !!}</td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_sistema_nervioso->emotividad <> 'N/A')
                                                                                <tr>
                                                                                    <td style="text-align: left">9. Emotividad: {!! nl2br(e($h_sistema_nervioso->emotividad )) !!} </td>
                                                                                </tr>
                                                                                @endif
                                                                                @if($h_sistema_nervioso->planificacion <> 'N/A')
                                                                                    <tr>
                                                                                        <td style="text-align: left">10. Planificación: {!! nl2br(e($h_sistema_nervioso->planificacion)) !!} </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @if($h_sistema_nervioso->decision <> 'N/A')
                                                                                        <tr>
                                                                                            <td style="text-align: left">11. Decisión: {!! nl2br(e($h_sistema_nervioso->decision)) !!}</td>
                                                                                        </tr>
                                                                                        @endif
                                                                                        @if($h_sistema_nervioso->percepcion <> 'N/A')
                                                                                            <tr>
                                                                                                <td style="text-align: left">12. Percepción: {!! nl2br(e($h_sistema_nervioso->percepcion )) !!}</td>
                                                                                            </tr>
                                                                                            @endif
                                        </table>
                                        <h6 style="font-size: 13px;text-align:left;font-family: Arial, sans-serif;">Paredes craneales</h6>
                                        <table style=" border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;" border="1">
                                            <tbody>
                                                @if($h_sistema_nervioso->paredes_craneales_percepcion <> 'N/A')
                                                    <tr>
                                                        <th style="width: 10%;border-bottom: none;">I</th>
                                                        <th style="width: 40%;text-align: left"> Percepcion</th>
                                                        <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->paredes_craneales_percepcion )) !!} </td>
                                                    </tr>
                                                    @endif
                                                    @if($h_sistema_nervioso->identificacion <> 'N/A')
                                                        <tr>
                                                            <th style="width: 10%;border-top: none;"></th>
                                                            <th style="width: 40%;text-align: left"> Identificacion</th>
                                                            <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->identificacion)) !!}</td>
                                                        </tr>
                                                        @endif
                                                        @if($h_sistema_nervioso->agudez_visual <> 'N/A')
                                                            <tr>
                                                                <th style="width: 10%;border-bottom: none;">II</th>
                                                                <th style="width: 40%;text-align: left"> Agudez visual</th>
                                                                <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->agudez_visual)) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_sistema_nervioso->vision_de_colores <> 'N/A')
                                                                <tr>
                                                                    <th style="width: 10%;border-top: none;"></th>
                                                                    <th style="width: 40%;text-align: left"> Vision de color</th>
                                                                    <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->vision_de_colores)) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_sistema_nervioso->campo_visual <> 'N/A')
                                                                    <tr>
                                                                        <th style="width: 10%;border-top: none;"></th>
                                                                        <th style="width: 40%;text-align: left"> Campo visula</th>
                                                                        <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->campo_visual)) !!}</td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_sistema_nervioso->pupilas <> 'N/A')
                                                                        <tr>
                                                                            <th style="width: 10%;border-top: none;"></th>
                                                                            <th style="width: 40%;text-align: left"> Pupilas</th>
                                                                            <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->pupilas)) !!}</td>
                                                                        </tr>
                                                                        @endif
                                                                        @if($h_sistema_nervioso->motilidad_del_globo_ocular <> 'N/A')
                                                                            <tr>
                                                                                <th>III</th>
                                                                                <th style="width: 40%;text-align: left"> Motilidad del globo ocular</th>
                                                                                <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->motilidad_del_globo_ocular)) !!} </td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_sistema_nervioso->reflejo_fotomotor <> 'N/A')
                                                                                <tr>
                                                                                    <th>IV</th>
                                                                                    <th style="width: 40%;text-align: left"> Reflejos fotomotor</th>
                                                                                    <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->reflejo_fotomotor)) !!} </td>
                                                                                </tr>
                                                                                @endif
                                                                                @if($h_sistema_nervioso->reflejos_de_acomodacion <> 'N/A')
                                                                                    <tr>
                                                                                        <th>V</th>
                                                                                        <th style="width: 40%;text-align: left"> Reflejos de acomodacion</th>
                                                                                        <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->reflejos_de_acomodacion)) !!} </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @if($h_sistema_nervioso->sensitivo <> 'N/A')
                                                                                        <tr>
                                                                                            <th style="width: 10%;border-bottom: none;">VI</th>
                                                                                            <th style="width: 40%;text-align: left">Sensitivo</th>
                                                                                            <td style="width: 50%;text-align: left">{!! nl2br(e($h_sistema_nervioso->sensitivo)) !!} </td>
                                                                                        </tr>
                                                                                        @endif
                                                                                        @if($h_sistema_nervioso->reflejo_corneal <> 'N/A')
                                                                                            <tr>
                                                                                                <th style="width: 10%;border-top: none;"></th>
                                                                                                <th style="width: 40%;text-align: left">Reflejos corneales</th>
                                                                                                <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->reflejo_corneal)) !!} </td>
                                                                                            </tr>
                                                                                            @endif
                                                                                            @if($h_sistema_nervioso->motor <> 'N/A')
                                                                                                <tr>
                                                                                                    <th style="width: 10%;border-top: none;"></th>
                                                                                                    <th style="width: 40%;text-align: left">Motor</th>
                                                                                                    <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->motor)) !!} </td>
                                                                                                </tr>
                                                                                                @endif
                                                                                                @if($h_sistema_nervioso->reflejo_maseterino <> 'N/A')
                                                                                                    <tr>
                                                                                                        <th style="width: 10%;border-top: none;"></th>
                                                                                                        <th style="width: 40%;text-align: left">Reflejos maseteros</th>
                                                                                                        <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->reflejo_maseterino)) !!} </td>
                                                                                                    </tr>
                                                                                                    @endif
                                                                                                    @if($h_sistema_nervioso->valora_musculos_expresion_facial <> 'N/A')
                                                                                                        <tr>
                                                                                                            <th>VII</th>
                                                                                                            <th style="width: 40%;text-align: left">Valoracion muscular de la expresion facial</th>
                                                                                                            <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->valora_musculos_expresion_facial)) !!} </td>
                                                                                                        </tr>
                                                                                                        @endif
                                                                                                        @if($h_sistema_nervioso->audicion_prueba_rinnne_weber <> 'N/A')
                                                                                                            <tr>

                                                                                                                <th style="width: 10%;border-bottom: none;">VIII</th>
                                                                                                                <th style="width: 40%;text-align: left">Audicion (prueba de Rinne, Weber)</th>
                                                                                                                <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->audicion_prueba_rinnne_weber)) !!} </td>
                                                                                                            </tr>
                                                                                                            @endif
                                                                                                            @if($h_sistema_nervioso->vestibular <> 'N/A')
                                                                                                                <tr>
                                                                                                                    <th style="width: 10%;border-top: none;"></th>
                                                                                                                    <th style="width: 40%;text-align: left">Vestibular</th>
                                                                                                                    <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->vestibular)) !!} </td>
                                                                                                                </tr>
                                                                                                                @endif
                                                                                                                @if($h_sistema_nervioso->reflejo_nauseoso <> 'N/A')
                                                                                                                    <tr>
                                                                                                                        <th>IX</th>
                                                                                                                        <th style="width: 40%;text-align: left">Reflejos nauseoso</th>
                                                                                                                        <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->reflejo_nauseoso)) !!} </td>
                                                                                                                    </tr>
                                                                                                                    @endif
                                                                                                                    @if($h_sistema_nervioso->tos_debil_o_disfonia <> 'N/A')
                                                                                                                        <tr>

                                                                                                                            <th style="width: 10%;border-bottom: none;">X</th>
                                                                                                                            <th style="width: 40%;text-align: left">Tos debil o disfonia</th>
                                                                                                                            <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->tos_debil_o_disfonia)) !!} </td>
                                                                                                                        </tr>
                                                                                                                        @endif
                                                                                                                        @if($h_sistema_nervioso->asimetria_paladar_blando_perdida_reflejo_nauseoso <> 'N/A')
                                                                                                                            <tr>
                                                                                                                                <th style="width: 10%;border-top: none;"></th>
                                                                                                                                <th style="width: 40%;text-align: left">Asimetria paladar blando/trapecio reflejos nauseoso</th>
                                                                                                                                <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->asimetria_paladar_blando_perdida_reflejo_nauseoso)) !!} </td>
                                                                                                                            </tr>
                                                                                                                            @endif
                                                                                                                            @if($h_sistema_nervioso->valor_fuerza_esternocleidomastoideo_trapecio <> 'N/A')
                                                                                                                                <tr>
                                                                                                                                    <th>XI</th>
                                                                                                                                    <th style="width: 40%;text-align: left">Valor fuerza de esternocleidomastoideo/trapecio</th>
                                                                                                                                    <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->valor_fuerza_esternocleidomastoideo_trapecio)) !!} </td>
                                                                                                                                </tr>
                                                                                                                                @endif
                                                                                                                                @if($h_sistema_nervioso->desviacion_o_fasciculacion_de_lengua <> 'N/A')
                                                                                                                                    <tr>
                                                                                                                                        <th>XII</th>
                                                                                                                                        <th style="width: 40%;text-align: left">Desviacion de la lengua/fasciculacion de la lengua</th>
                                                                                                                                        <td style="width: 50%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->desviacion_o_fasciculacion_de_lengua)) !!} </td>
                                                                                                                                    </tr>
                                                                                                                                    @endif
                                            </tbody>

                                        </table>

                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Sistema_motor') <?php $n++ ?>
                                        <h5 style="font-size: 13px;text-align:left;font-family: Arial, sans-serif;">{!! nl2br(e($n)) !!}.- SISTEMA MOTOR</h5>
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            <tr>
                                                <td style="text-align: left; width: 55%">

                                                    <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                                        @if($h_sistema_nervioso->tono <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left">Tono:</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left; width: 40%;"> {!! nl2br(e($h_sistema_nervioso->tono)) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_sistema_nervioso->trofismo <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left">Trofismo:</td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left; width: 40%;">{!! nl2br(e($h_sistema_nervioso->trofismo )) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_sistema_nervioso->reflejos_de_estiramiento <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left">Reflejos de estiramiento muscular:</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; width: 40%;">{!! nl2br(e($h_sistema_nervioso->reflejos_de_estiramiento)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                    </table>
                                                </td>
                                                <td style="text-align: left; width: 90%;">
                                                    <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;" border="1">

                                                        <tbody>
                                                            <tr>
                                                                <th colspan="3">Balance muscular (Daniels)</th>
                                                            </tr>
                                                            <tr>
                                                                <th>Segmento</th>
                                                                <th style="width: 40%;text-align: center"> Derecho</th>
                                                                <th style="width: 40%;text-align: center"> Izquierdo</th>
                                                            </tr>

                                                            @if($h_sistema_nervioso->balance_muscular_brazo_derecho <> 'N/A' && $h_sistema_nervioso->balance_muscular_brazo_izquierdo <> 'N/A')
                                                                    <tr>
                                                                        <th style="width: 40%;text-align: left">Brazo</th>
                                                                        <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_brazo_derecho)) !!} </td>
                                                                        <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_brazo_izquierdo)) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                                    @if($h_sistema_nervioso->balance_muscular_antebrazo_derecho <> 'N/A' && $h_sistema_nervioso->balance_muscular_antebrazo_izquierdo <> 'N/A' )
                                                                            <tr>
                                                                                <th style="width: 40%;text-align: left">Antebrazo</th>
                                                                                <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_antebrazo_derecho)) !!} </td>
                                                                                <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_antebrazo_izquierdo)) !!} </td>
                                                                            </tr>
                                                                            @endif
                                                                            @if($h_sistema_nervioso->balance_muscular_mano_derecho <> 'N/A' && $h_sistema_nervioso->balance_muscular_mano_izquierdo <> 'N/A' )
                                                                                    <tr>
                                                                                        <th style="width: 40%;text-align: left">Mano</th>
                                                                                        <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_mano_derecho)) !!} </td>
                                                                                        <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_mano_izquierdo)) !!} </td>
                                                                                    </tr>
                                                                                    @endif
                                                                                    @if($h_sistema_nervioso->balance_muscular_muslo_derecho <> 'N/A' && $h_sistema_nervioso->balance_muscular_muslo_izquierdo <> 'N/A' )
                                                                                            <tr>
                                                                                                <th style="width: 40%;text-align: left">Muslo</th>
                                                                                                <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_muslo_derecho)) !!} </td>
                                                                                                <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_muslo_izquierdo)) !!} </td>
                                                                                            </tr>
                                                                                            @endif
                                                                                            @if($h_sistema_nervioso->balance_muscular_pierna_derecho <> 'N/A' && $h_sistema_nervioso->balance_muscular_pierna_izquierdo <> 'N/A' )
                                                                                                    <tr>
                                                                                                        <th style="width: 40%;text-align: left">Pierna</th>
                                                                                                        <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_pierna_derecho)) !!} </td>
                                                                                                        <td style="width: 40%;text-align: left"> {!! nl2br(e($h_sistema_nervioso->balance_muscular_pierna_izquierdo)) !!} </td>
                                                                                                    </tr>
                                                                                                    @endif
                                                                                                    @if($h_sistema_nervioso->balance_muscular_pie_derecho <> 'N/A' && $h_sistema_nervioso->balance_muscular_pie_izquierdo <> 'N/A')
                                                                                                            <tr>
                                                                                                                <th style="width: 40%;text-align: left">Pie</th>
                                                                                                                <td style="width: 40%;text-align: left">{!! nl2br(e($h_sistema_nervioso->balance_muscular_pie_derecho)) !!} </td>
                                                                                                                <td style="width: 40%;text-align: left">{!! nl2br(e($h_sistema_nervioso->balance_muscular_pie_izquierdo)) !!} </td>
                                                                                                            </tr>
                                                                                                            @endif

                                                        </tbody>

                                                    </table>
                                                </td>
                                                <td style="text-align: left; width: 30%;"><img src="{!! nl2br(e( $imagePath )) !!}" style="max-width: 300px;">
                                                </td>
                                            </tr>
                                        </table>
                                        @endif
                                        @endforeach
                                        @foreach ($permisos as $permiso)
                                        @if($permiso->nombre_permiso=='Sistema_sensitivo')<?php $n++ ?>
                                        <h5 style="font-size: 13px;text-align:left;font-family: Arial, sans-serif;">{!! nl2br(e($n)) !!}.- SISTEMA SENSITIVO</h5>
                                        <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                            <tr>
                                                <td style="text-align: left; width: 40%">
                                                    <img src="{!! nl2br(e( $imagePath )) !!}" style="max-width: 150px;">
                                                </td>
                                                <td style="text-align: left; width: 90%;">
                                                    <table style="border-collapse: collapse;font-size: 13px;text-align:center;width: 100%;font-family: Arial, sans-serif;">
                                                        @if($h_sistema_nervioso->sensibilidad_superficial <> 'N/A')
                                                            <tr>
                                                                <td style="text-align: left">Sensibilidad superficial: </td>
                                                            </tr>
                                                            <tr>
                                                                <td style="text-align: left; width: 40%;"> {!! nl2br(e($h_sistema_nervioso->sensibilidad_superficial )) !!} </td>
                                                            </tr>
                                                            @endif
                                                            @if($h_sistema_nervioso->sensibilidad_profunda_consciente <> 'N/A')
                                                                <tr>
                                                                    <td style="text-align: left">Sensibilidad profunda consciente: </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="text-align: left; width: 40%;"> {!! nl2br(e($h_sistema_nervioso->sensibilidad_profunda_consciente )) !!} </td>
                                                                </tr>
                                                                @endif
                                                                @if($h_sistema_nervioso->sensibilidad_profunda_inconsciente <> 'N/A')
                                                                    <tr>
                                                                        <td style="text-align: left">Sensibilidad profunda inconsciente: </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left; width: 40%;">{!! nl2br(e($h_sistema_nervioso->sensibilidad_profunda_inconsciente )) !!} </td>
                                                                    </tr>
                                                                    @endif
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        @endif
                                        @endforeach

                                        @if($h_examenes->diagnostico_sindromatico <> 'N/A') <?php $n++ ?>
                                            <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- DIAGNOSTICO SINDROMATICO</h5>
                                            <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_examenes->diagnostico_sindromatico)) !!}</p>
                                            @endif
                                            @if($h_examenes->laboratorios_de_estudio_y_gabinete_solicitados <> 'N/A') <?php $n++ ?>
                                                <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- INTERPRETACION DE LABORATORIOS DE ESTUDIO Y GABINETE SOLICITADOS</h5>
                                                <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_examenes->laboratorios_de_estudio_y_gabinete_solicitados)) !!}</p>
                                                @endif
                                                @if($h_examenes->examenes_complementarios <> 'N/A')<?php $n++ ?>
                                                    <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- EXAMENES COMPLEMENTARIOS</h5>
                                                    <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_examenes->examenes_complementarios)) !!}</p>
                                                    @endif
                                                    @if($h_examenes->impresion_diagnostica <> 'N/A')<?php $n++ ?>
                                                        <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($n)) !!}.- IMPRESION DIAGNOSTICA</h5>
                                                        <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_examenes->impresion_diagnostica)) !!}</p>
                                                        @endif
                                                        @if($h_examenes->comentarios <> 'N/A')<?php $n++ ?>
                                                            <h5 style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif "> {!! nl2br(e($n)) !!}.- COMENTARIOS</h5>
                                                            <p style="border-collapse: collapse;font-size: 13px;text-align:left;font-family: Arial, sans-serif ">{!! nl2br(e($h_examenes->comentarios)) !!}</p>
                                                            @endif

</body>

</html>