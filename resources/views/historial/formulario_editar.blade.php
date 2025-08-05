@extends('layouts.header')
@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b>Formulario Actualizar Historia Clínica</b></h4>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <?php $n = 2 ?>
        <div class="panel-body">
            <!-- <pre>{{ print_r(old(), true) }}</pre> -->
            <form action="{{route('historial.update',$historial->id_historia)}}" method="POST" autocomplete="off" novalidate>
                @csrf @method('PUT')
                <div class="row">
                    <h5 style="color:rgba(23, 93, 126, 0.87);">1.- Filiación</h5>
                    @if ($n_ser->nombre_servicio=='NEONATOLOGIA')

                    
                            @if(isset($usuarios_encontrados) && count($usuarios_encontrados) > 1)
                                <div class="col-md-12">
                                    <label><b>Seleccionar paciente correspondiente:</b></label>
                                    <select name="id_usuario_seleccionado" class="form-control" id="seleccion_usuario" required>
                                        <option value="">Seleccione una opción</option>
                                        @foreach($usuarios_encontrados as $index => $usuario)
                                            <option value="{{ $usuario['ci'] }}" 
                                                data-index="{{ $index }}"
                                                data-nombres="{{ $usuario['nombres'] }}"
                                                data-p_apellido="{{ $usuario['p_apellido'] }}"
                                                data-s_apellido="{{ $usuario['s_apellido'] }}"
                                                data-sexo="{{ $usuario['sexo'] }}"
                                                data-fecha_nacimiento="{{ $usuario['fecha_nacimiento'] }}"
                                                data-matricula_seguro="{{ $usuario['matricula_seguro'] }}"
                                                data-nacionalidad="{{ $usuario['nacionalidad'] }}"
                                                data-telefono="{{ $usuario['telefono'] }}"
                                                data-residencia="{{ $usuario['residencia'] }}"
                                            >
                                                {{ $usuario['nombres'] }} {{ $usuario['p_apellido'] }} {{ $usuario['s_apellido'] }} - {{ $usuario['ci'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Campos ocultos para enviar los datos --}}
                                <input type="hidden" name="id_paciente" value="{{ $historial->id_paciente }}">
                                <input type="hidden" name="ci" id="ci_oculto">
                                <input type="hidden" name="nombres" id="nombres_oculto">
                                <input type="hidden" name="p_apellido" id="p_apellido_oculto">
                                <input type="hidden" name="s_apellido" id="s_apellido_oculto">
                                <input type="hidden" name="sexo_api" id="sexo_oculto">
                                <input type="hidden" name="fecha_nacimiento" id="fecha_nacimiento_oculto">
                                <input type="hidden" name="matricula_seguro" id="matricula_oculto">
                                <input type="hidden" name="nacionalidad" id="nacionalidad_oculto">
                                <input type="hidden" name="complemento" id="complemento_oculto">
                                <input type="hidden" name="telefono" id="telefono_oculto">
                                <input type="hidden" name="residencia" id="residencia_oculto">

                            @endif

                        </div>    


                    <div class="col-md-6">
                        <label><b>Nombre del Recién Nacido</b></label>
                        <input type="text" class="form-control" name="nombre_recien_necido" value="{{$historial->nombre_recien_necido}}">
                    </div>
                    <div class="col-md-6">
                        <label><b>Sexo</b></label>
                        <input type="text" class="form-control" name="sexo" value="{{$historial->sexo}}">
                    </div>
                    <div class="col-md-6">
                        <label><b>Cama</b></label>
                        <input type="text" class="form-control" name="cama" value="{{$historial->cama}}">
                    </div>
                    <div class="col-md-6">
                        <label><b>Fecha de Nacimiento del RN</b></label>
                        <input type="date" class="form-control" name="fecha_recien_necido" value="{{$historial->fecha_recien_necido}}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Hora de Nacimiento del RN</b></label>
                        <input type="time" class="form-control" name="hora_recien_necido" value="{{$historial->hora_recien_necido}}">
                    </div>
                    <div class="col-md-6">
                        <label><b>Servicio</b></label>
                        <input type="text" class="form-control" value="{{$n_ser->nombre_servicio}} " disabled>
                        <input type="hidden" class="form-control" name="id_servicio" value="{{$n_ser->id_servicio}}">
                        <input type="hidden" class="form-control" name="nombre_servicio" value="{{$n_ser->nombre_servicio}}">
                    </div>
                    <div class="col-md-6">
                        <label><b>Referencia (Nombre y Teléfono)</b></label>
                        <input type="text" class="form-control" name="nombrenum_referencia" value="{{$historial->nombrenum_referencia}}">
                    </div>
                    @else

                    <div class="col-md-6">
                        <label><b>Paciente</b></label>
                        <input type="text" class="form-control" name="id_paciente" value="{{$paciente->nombres}} {{$paciente->p_apellido}} {{$paciente->s_apellido}}" disabled>
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" value="{{ $n_ser->nombre_servicio }}" disabled>
                        <input type="hidden" class="form-control" name="id_servicio" value="{{ $n_ser->id_servicio }}">
                        <input type="hidden" class="form-control" name="nombre_servicio" value="{{ $n_ser->nombre_servicio }}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Servicio</b></label>
                        <input type="text" class="form-control" value="{{$n_ser->nombre_servicio}} " disabled>
                        <input type="hidden" class="form-control" name="id_servicio" value="{{$n_ser->id_servicio}}">
                        <input type="hidden" class="form-control" name="nombre_servicio" value="{{$n_ser->nombre_servicio}}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Grado de Instrucción</b></label>
                        <input type="text" class="form-control" name="grado_instruccion" value="{{$historial->grado_instruccion}}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Religión</b></label>
                        <input type="text" class="form-control" name="religion" value="{{$historial->religion}}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Cama</b></label>
                        <input type="text" class="form-control" name="cama" value="{{$historial->cama}}" required>
                    </div>
                    <div class="col-md-6">
                        <label><b>Ocupacion</b></label>
                        <input type="text" class="form-control" name="ocupacion" value="{{$historial->ocupacion}}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Estado civil</b></label>
                        <input type="text" class="form-control" name="estado_civil" value="{{$historial->estado_civil}}" required>
                    </div>
                    <div class="col-md-6">
                        <label><b>Fuente de Información</b></label>
                        <input type="text" class="form-control" name="fuente_informacion" value="{{$historial->fuente_informacion}}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Referencia (Nombre y Teléfono)</b></label>
                        <input type="text" class="form-control" name="nombrenum_referencia" value="{{$historial->nombrenum_referencia}}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grado de Confiabilidad</b></label>
                        <input type="text" class="form-control" name="grado_confiabilidad" value="{{$historial->grado_confiabilidad}}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grupo Sanguíneo y Factor</b></label>
                        <input type="text" class="form-control" name="grupo_sanguineo_facto" value="{{$historial->grupo_sanguineo_facto}}" required>
                    </div>

                    @endif

                </div>

                <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger"><i class="fa fa-reply"></i> Cancelar</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
            </form><br>

            <div class="col-md-12">
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
                                <form action="{{ route('antecedentes_perinatologicos.update',$antecedentes_perinatologicos->id_antecedentes_perinatologicos) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Antecedentes perinatologicos</b></label>
                                            <input type="text" class="form-control" name="antecedentes_perinatologicos" value="{{$antecedentes_perinatologicos->antecedentes_perinatologicos}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('antecedentes_inmunizacion.update',$antecedentes_inmunizacion->id_antecedentes_inmunizacion) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Antecedentes Inmunizacion</b></label>
                                            <input type="text" class="form-control" name="antecedentes_inmunizacion" value="{{$antecedentes_inmunizacion->antecedentes_inmunizacion}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{route('antecedentes_alimentarios.update',$antecedentes_alimentarios->id_antecedentes_alimentarios)}}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Antecedentes Alimentarios</b></label>
                                            <input type="text" class="form-control" name="antecedentes_alimentarios" value="{{$antecedentes_alimentarios->antecedentes_alimentarios}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{route('antecedentes_familiares.update',$antecedentes_familiares->id_antecedentes_familiares)}}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Antecedentes Familiares</b></label>
                                            <input type="text" class="form-control" name="antecedentes_familiares" value="{{$antecedentes_familiares->antecedentes_familiares}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('desarrollo_psicomotor.update',$desarrollo_psicomotor->id_desarrollo_psicomotor) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Desarrollo psicomotors</b></label>
                                            <input type="text" class="form-control" name="desarrollo_psicomotor" value="{{$desarrollo_psicomotor->desarrollo_psicomotor}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('antecedentes_heredofamiliares.update',$antecedentes_heredofamiliares->id_antecedentes_heredofamiliares) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($antecedentes_heredofamiliares->padre <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Padre</b></label>
                                                <input type="text" class="form-control" name="padre" value="{{$antecedentes_heredofamiliares->padre}}" required>
                                            </div>
                                            @endif
                                            @if($antecedentes_heredofamiliares->madre <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Madre</b></label>
                                                    <input type="text" class="form-control" name="madre" value="{{$antecedentes_heredofamiliares->madre}}" required>
                                                </div>
                                                @endif
                                                @if($antecedentes_heredofamiliares->hermanos <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Hermano(s)</b></label>
                                                        <input type="text" class="form-control" name="hermanos" value="{{$antecedentes_heredofamiliares->hermanos}}" required>
                                                    </div>
                                                    @endif
                                                    @if($antecedentes_heredofamiliares->esposo <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Esposo</b></label>
                                                            <input type="text" class="form-control" name="esposo" value="{{$antecedentes_heredofamiliares->esposo}}" required>
                                                        </div>
                                                        @endif
                                                        @if($antecedentes_heredofamiliares->hijos <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Hijos</b></label>
                                                                <input type="text" class="form-control" name="hijos" value="{{$antecedentes_heredofamiliares->hijos}}" required>
                                                            </div>
                                                            @endif
                                                            @if($antecedentes_heredofamiliares->abuelos <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Abuelos</b></label>
                                                                    <input type="text" class="form-control" name="abuelos" value="{{$antecedentes_heredofamiliares->abuelos}}" required>
                                                                </div>
                                                                @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('antecedentes_patologicos.update',$antecedentes_patologicos->id_antecedentes_patologicos) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($antecedentes_patologicos->clinicos <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Clinicos</b></label>
                                                <input type="text" class="form-control" name="clinicos" value="{{$antecedentes_patologicos->clinicos}}" required>
                                            </div>
                                            @endif
                                            @if($antecedentes_patologicos->quirurjicos <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Quirurjicos</b></label>
                                                    <input type="text" class="form-control" name="quirurjicos" value="{{$antecedentes_patologicos->quirurjicos}}" required>
                                                </div>
                                                @endif
                                                @if($antecedentes_patologicos->alergicos <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Alergias</b></label>
                                                        <input type="text" class="form-control" name="alergicos" value="{{$antecedentes_patologicos->alergicos}}" required>
                                                    </div>
                                                    @endif
                                                    @if($antecedentes_patologicos->otros <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Otros</b></label>
                                                            <input type="text" class="form-control" name="otros" value="{{$antecedentes_patologicos->otros}}" required>
                                                        </div>
                                                        @endif
                                                        @if($antecedentes_patologicos->internaciones <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Internaciones</b></label>
                                                                <input type="text" class="form-control" name="internaciones" value="{{$antecedentes_patologicos->internaciones}}" required>
                                                            </div>
                                                            @endif
                                                            @if($antecedentes_patologicos->cirugias <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Cirugias</b></label>
                                                                    <input type="text" class="form-control" name="cirugias" value="{{$antecedentes_patologicos->cirugias}}" required>
                                                                </div>
                                                                @endif
                                                                @if($antecedentes_patologicos->transfusion_de_sangre <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Transfusion de sangre</b></label>
                                                                        <input type="text" class="form-control" name="transfusion_de_sangre" value="{{$antecedentes_patologicos->transfusion_de_sangre}}" required>
                                                                    </div>
                                                                    @endif
                                                                    @if($antecedentes_patologicos->iras <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Iras</b></label>
                                                                            <input type="text" class="form-control" name="iras" value="{{$antecedentes_patologicos->iras}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($antecedentes_patologicos->gastroenteritis <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Gastroenteritis</b></label>
                                                                                <input type="text" class="form-control" name="gastroenteritis" value="{{$antecedentes_patologicos->gastroenteritis}}" required>
                                                                            </div>
                                                                            @endif
                                                                            @if($antecedentes_patologicos->traumatismos <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Traumatismos</b></label>
                                                                                    <input type="text" class="form-control" name="traumatismos" value="{{$antecedentes_patologicos->traumatismos}}" required>
                                                                                </div>
                                                                                @endif
                                                                                @if($antecedentes_patologicos->medicamentos <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Medicamentos</b></label>
                                                                                        <input type="text" class="form-control" name="medicamentos" value="{{$antecedentes_patologicos->medicamentos}}" required>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($antecedentes_patologicos->enfermedades <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Enfermedades</b></label>
                                                                                            <input type="text" class="form-control" name="enfermedades" value="{{$antecedentes_patologicos->enfermedades}}" required>
                                                                                        </div>
                                                                                        @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('antecedentes_no_patologicos.update',$antecedentes_no_patologicos->id_antecedentes_nopatologicos) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($antecedentes_no_patologicos->vacunas <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Vacunas</b></label>
                                                <input type="text" class="form-control" name="vacunas" value="{{$antecedentes_no_patologicos->vacunas}}" required>
                                            </div>
                                            @endif
                                            @if($antecedentes_no_patologicos->vacunas_hpv <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Vacunas hpv</b></label>
                                                    <input type="text" class="form-control" name="vacunas_hpv" value="{{$antecedentes_no_patologicos->vacunas_hpv}}" required>
                                                </div>
                                                @endif
                                                @if($antecedentes_no_patologicos->habitos_toxicos <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Habitos toxicos</b></label>
                                                        <input type="text" class="form-control" name="habitos_toxicos" value="{{$antecedentes_no_patologicos->habitos_toxicos}}" required>
                                                    </div>
                                                    @endif
                                                    @if($antecedentes_no_patologicos->alimentacion <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Alimentacion</b></label>
                                                            <input type="text" class="form-control" name="alimentacion" value="{{$antecedentes_no_patologicos->alimentacion}}" required>
                                                        </div>
                                                        @endif
                                                        @if($antecedentes_no_patologicos->habito_miccional <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Habito miccional</b></label>
                                                                <input type="text" class="form-control" name="habito_miccional" value="{{$antecedentes_no_patologicos->habito_miccional}}" required>
                                                            </div>
                                                            @endif
                                                            @if($antecedentes_no_patologicos->habito_intestinal <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Habito intestinal</b></label>
                                                                    <input type="text" class="form-control" name="habito_intestinal" value="{{$antecedentes_no_patologicos->habito_intestinal}}" required>
                                                                </div>
                                                                @endif
                                                                @if($antecedentes_no_patologicos->vivienda_servicio_basico <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Vivienda servicio basico</b></label>
                                                                        <input type="text" class="form-control" name="vivienda_servicio_basico" value="{{$antecedentes_no_patologicos->vivienda_servicio_basico}}" required>
                                                                    </div>
                                                                    @endif
                                                                    @if($antecedentes_no_patologicos->habito_alcoholico <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Habito alcoholico</b></label>
                                                                            <input type="text" class="form-control" name="habito_alcoholico" value="{{$antecedentes_no_patologicos->habito_alcoholico}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($antecedentes_no_patologicos->habito_tabaquico <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Habito tabaquico</b></label>
                                                                                <input type="text" class="form-control" name="habito_tabaquico" value="{{$antecedentes_no_patologicos->habito_tabaquico}}" required>
                                                                            </div>
                                                                            @endif
                                                                            @if($antecedentes_no_patologicos->exposicion_biomasa <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Exposicion a biomasa</b></label>
                                                                                    <input type="text" class="form-control" name="exposicion_biomasa" value="{{$antecedentes_no_patologicos->exposicion_biomasa}}" required>
                                                                                </div>
                                                                                @endif
                                                                                @if($antecedentes_no_patologicos->contacto_con_tuberculosis <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Contacto con tuberculosis</b></label>
                                                                                        <input type="text" class="form-control" name="contacto_con_tuberculosis" value="{{$antecedentes_no_patologicos->contacto_con_tuberculosis}}" required>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($antecedentes_no_patologicos->contacto_triatoma_infestans <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Contacto triatoma infestans</b></label>
                                                                                            <input type="text" class="form-control" name="contacto_triatoma_infestans" value="{{$antecedentes_no_patologicos->contacto_triatoma_infestans}}" required>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($antecedentes_no_patologicos->toxicomanias_drogas <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Toxicomanias drogas</b></label>
                                                                                                <input type="text" class="form-control" name="toxicomanias_drogas" value="{{$antecedentes_no_patologicos->toxicomanias_drogas}}" required>
                                                                                            </div>
                                                                                            @endif
                                                                                            @if($antecedentes_no_patologicos->inmunizaciones <> 'N/A')
                                                                                                <div class="col-md-12">
                                                                                                    <label><b>Inmunizaciones</b></label>
                                                                                                    <input type="text" class="form-control" name="inmunizaciones" value="{{$antecedentes_no_patologicos->inmunizaciones}}" required>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if($antecedentes_no_patologicos->antecedentes_sexuales <> 'N/A')
                                                                                                    <div class="col-md-12">
                                                                                                        <label><b>Antecedentes sexuales</b></label>
                                                                                                        <input type="text" class="form-control" name="antecedentes_sexuales" value="{{$antecedentes_no_patologicos->antecedentes_sexuales}}" required>
                                                                                                    </div>
                                                                                                    @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('antecedentes_gineco_obsteticos.update',$Antecedentes_gineco_obsteticos->id_antecedentes_gineco) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($Antecedentes_gineco_obsteticos->fecha_ultima_menstruacion <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Fecha de ultima menstruacion</b></label>
                                                <input type="text" class="form-control" name="fecha_ultima_menstruacion" value="{{$Antecedentes_gineco_obsteticos->fecha_ultima_menstruacion}}" required>
                                            </div>
                                            @endif
                                            @if($Antecedentes_gineco_obsteticos->ritmo_menstrual <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Ritmo menstrual</b></label>
                                                    <input type="text" class="form-control" name="ritmo_menstrual" value="{{$Antecedentes_gineco_obsteticos->ritmo_menstrual}}" required>
                                                </div>
                                                @endif
                                                @if($Antecedentes_gineco_obsteticos->menopausia <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Menopausia</b></label>
                                                        <input type="text" class="form-control" name="menopausia" value="{{$Antecedentes_gineco_obsteticos->menopausia}}" required>
                                                    </div>
                                                    @endif
                                                    @if($Antecedentes_gineco_obsteticos->gestaciones <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Gestaciones</b></label>
                                                            <input type="text" class="form-control" name="gestaciones" value="{{$Antecedentes_gineco_obsteticos->gestaciones}}" required>
                                                        </div>
                                                        @endif
                                                        @if($Antecedentes_gineco_obsteticos->partos <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Partos</b></label>
                                                                <input type="text" class="form-control" name="partos" value="{{$Antecedentes_gineco_obsteticos->partos}}" required>
                                                            </div>
                                                            @endif
                                                            @if($Antecedentes_gineco_obsteticos->cesareas <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Cesareas</b></label>
                                                                    <input type="text" class="form-control" name="cesareas" value="{{$Antecedentes_gineco_obsteticos->cesareas}}" required>
                                                                </div>
                                                                @endif
                                                                @if($Antecedentes_gineco_obsteticos->abortos <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Abortos</b></label>
                                                                        <input type="text" class="form-control" name="abortos" value="{{$Antecedentes_gineco_obsteticos->abortos}}" required>
                                                                    </div>
                                                                    @endif
                                                                    @if($Antecedentes_gineco_obsteticos->hijos_macrosomicos <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Hijos macrosomicos</b></label>
                                                                            <input type="text" class="form-control" name="hijos_macrosomicos" value="{{$Antecedentes_gineco_obsteticos->hijos_macrosomicos}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($Antecedentes_gineco_obsteticos->preeclampsia_eclampsia <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Preeclampsia eclampsia</b></label>
                                                                                <input type="text" class="form-control" name="preeclampsia_eclampsia" value="{{$Antecedentes_gineco_obsteticos->preeclampsia_eclampsia}}" required>
                                                                            </div>
                                                                            @endif
                                                                            @if($Antecedentes_gineco_obsteticos->anticonceptivos <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Anticonceptivos</b></label>
                                                                                    <input type="text" class="form-control" name="anticonceptivos" value="{{$Antecedentes_gineco_obsteticos->anticonceptivos}}" required>
                                                                                </div>
                                                                                @endif
                                                                                @if($Antecedentes_gineco_obsteticos->fecha_ultima_papanicolau <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Fecha ultima de papanicolau</b></label>
                                                                                        <input type="text" class="form-control" name="fecha_ultima_papanicolau" value="{{$Antecedentes_gineco_obsteticos->fecha_ultima_papanicolau}}" required>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($Antecedentes_gineco_obsteticos->fecha_ultima_mamografia <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Fecha ultima de mamografia</b></label>
                                                                                            <input type="text" class="form-control" name="fecha_ultima_mamografia" value="{{$Antecedentes_gineco_obsteticos->fecha_ultima_mamografia}}" required>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($Antecedentes_gineco_obsteticos->fecha_ultima_densitometria <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Fecha ultimo densitometria</b></label>
                                                                                                <input type="text" class="form-control" name="fecha_ultima_densitometria" value="{{$Antecedentes_gineco_obsteticos->fecha_ultima_densitometria}}" required>
                                                                                            </div>
                                                                                            @endif
                                                                                        @if($Antecedentes_gineco_obsteticos->fecha_ultimo_aborto <> 'N/A')
                                                                                                <div class="col-md-12">
                                                                                                    <label><b>Fecha ultimo aborto</b></label>
                                                                                                    <input type="text" class="form-control" name="fecha_ultimo_aborto" value="{{$Antecedentes_gineco_obsteticos->fecha_ultimo_aborto}}" required>
                                                                                                </div>
                                                                                                @endif

                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                            <form action="{{ route('anamnesis_sistemas.update',$anamnesis_sistema->id_anamnesis_sistema) }}" method="POST" autocomplete="off" novalidate>
                                @csrf @method('PUT')
                                <div class="row">
                                    @if($anamnesis_sistema->cardiovascular_respiratorio <> 'N/A')
                                        <div class="col-md-12">
                                            <label><b>Cardiovascular respiratorio</b></label>
                                            <input type="text" class="form-control" name="cardiovascular_respiratorio" value="{{$anamnesis_sistema->cardiovascular_respiratorio}}" required>
                                        </div>
                                        @endif
                                        @if($anamnesis_sistema->gastro_intestinal <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Gastro-intestinal</b></label>
                                                <input type="text" class="form-control" name="gastro_intestinal" value="{{$anamnesis_sistema->gastro_intestinal}}" required>
                                            </div>
                                            @endif
                                            @if($anamnesis_sistema->genito_urinario <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Genito-urinario</b></label>
                                                    <input type="text" class="form-control" name="genito_urinario" value="{{$anamnesis_sistema->genito_urinario}}" required>
                                                </div>
                                                @endif
                                                @if($anamnesis_sistema->hematologico <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Hematologico</b></label>
                                                        <input type="text" class="form-control" name="hematologico" value="{{$anamnesis_sistema->hematologico}}" required>
                                                    </div>
                                                    @endif
                                                    @if($anamnesis_sistema->dermatologico <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Dermatologico</b></label>
                                                            <input type="text" class="form-control" name="dermatologico" value="{{$anamnesis_sistema->dermatologico}}" required>
                                                        </div>
                                                        @endif
                                                        @if($anamnesis_sistema->neurologico <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Neurologico</b></label>
                                                                <input type="text" class="form-control" name="neurologico" value="{{$anamnesis_sistema->neurologico}}" required>
                                                            </div>
                                                            @endif
                                                            @if($anamnesis_sistema->locomotor <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Locomotor</b></label>
                                                                    <input type="text" class="form-control" name="locomotor" value="{{$anamnesis_sistema->locomotor}}" required>
                                                                </div>
                                                                @endif


                                </div><br>
                                <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                            </form>
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
                            <form action="{{ route('motivo_de_internacion.update',$motivo_de_internacion->id_motivo_internacion) }}" method="POST" autocomplete="off" novalidate>
                                @csrf @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <label><b>Motivo de internacion</b></label>
                                        <input type="text" class="form-control" name="motivo_de_internacion" value="{{$motivo_de_internacion->motivo_internacion}}" required>
                                    </div>
                                </div><br>
                                <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                            </form>
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
                            <form action="{{ route('historia_enfermedad_actual.update',$historia_enfermedad_actual->id_historia_enfermedad) }}" method="POST" autocomplete="off" novalidate>
                                @csrf @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <label><b>Historia de enfermedad actual</b></label>
                                        <input type="text" class="form-control" name="historia_de_enfermedad_actual" value="{{$historia_enfermedad_actual->historia_de_enfermedad_actual}}" required>
                                    </div>
                                </div><br>
                                <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                            </form>
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
                                <form action="{{ route('examen_fisico_general.update',$examen_fisico_general->id_examen_general) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($examen_fisico_general->examen_fisico_general <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Examen fisico general</b></label>
                                                <input type="text" class="form-control" name="examen_fisico_general" value="{{$examen_fisico_general->examen_fisico_general}}" required>
                                            </div>
                                            @endif
                                            @if($examen_fisico_general->estado_de_conciencia <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Estado de conciencia</b></label>
                                                    <input type="text" class="form-control" name="estado_de_conciencia" value="{{$examen_fisico_general->estado_de_conciencia}}" required>
                                                </div>
                                                @endif
                                                @if($examen_fisico_general->color_piel_mucosa <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Color piel mucosa</b></label>
                                                        <input type="text" class="form-control" name="color_piel_mucosa" value="{{$examen_fisico_general->color_piel_mucosa}}" required>
                                                    </div>
                                                    @endif
                                                    @if($examen_fisico_general->constitucion <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Constitucion</b></label>
                                                            <input type="text" class="form-control" name="constitucion" value="{{$examen_fisico_general->constitucion}}" required>
                                                        </div>
                                                        @endif
                                                        @if($examen_fisico_general->marcha <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Marcha</b></label>
                                                                <input type="text" class="form-control" name="marcha" value="{{$examen_fisico_general->marcha}}" required>
                                                            </div>
                                                            @endif
                                                            @if($examen_fisico_general->posicion <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Posicion</b></label>
                                                                    <input type="text" class="form-control" name="posicion" value="{{$examen_fisico_general->posicion}}" required>
                                                                </div>
                                                                @endif
                                                                @if($examen_fisico_general->estado_hidratacion <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Estado hidratacion</b></label>
                                                                        <input type="text" class="form-control" name="estado_hidratacion" value="{{$examen_fisico_general->estado_hidratacion}}" required>
                                                                    </div>
                                                                    @endif

                                                                    @if($examen_fisico_general->biotipo <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Biotipo</b></label>
                                                                            <input type="text" class="form-control" name="biotipo" value="{{$examen_fisico_general->biotipo}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_fisico_general->facies <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Facies</b></label>
                                                                                <input type="text" class="form-control" name="facies" value="{{$examen_fisico_general->facies}}" required>
                                                                            </div>
                                                                            @endif
                                                                            @if($examen_fisico_general->tension_arterial <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Tension arterial</b></label>
                                                                                    <input type="text" class="form-control" name="tension_arterial" value="{{$examen_fisico_general->tension_arterial}}" required>
                                                                                </div>
                                                                                @endif
                                                                                @if($examen_fisico_general->tension_arterial_media <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Tension arterial media</b></label>
                                                                                        <input type="text" class="form-control" name="tension_arterial_media" value="{{$examen_fisico_general->tension_arterial_media}}" required>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($examen_fisico_general->frecuencia_cardiaca <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Frecuencia cardiaca</b></label>
                                                                                            <input type="text" class="form-control" name="frecuencia_cardiaca" value="{{$examen_fisico_general->frecuencia_cardiaca}}" required>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($examen_fisico_general->temperatura <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Temperatura</b></label>
                                                                                                <input type="text" class="form-control" name="temperatura" value="{{$examen_fisico_general->temperatura}}" required>
                                                                                            </div>
                                                                                            @endif
                                                                                            @if($examen_fisico_general->peso <> 'N/A')
                                                                                                <div class="col-md-12">
                                                                                                    <label><b>Peso</b></label>
                                                                                                    <input type="text" class="form-control" name="peso" value="{{$examen_fisico_general->peso}}" required>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if($examen_fisico_general->talla <> 'N/A')
                                                                                                    <div class="col-md-12">
                                                                                                        <label><b>Talla</b></label>
                                                                                                        <input type="text" class="form-control" name="talla" value="{{$examen_fisico_general->talla}}" required>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    @if($examen_fisico_general->imc <> 'N/A')
                                                                                                        <div class="col-md-12">
                                                                                                            <label><b>IMC</b></label>
                                                                                                            <input type="text" class="form-control" name="imc" value="{{$examen_fisico_general->imc}}" required>
                                                                                                        </div>
                                                                                                        @endif
                                                                                                        @if($examen_fisico_general->spo2 <> 'N/A')
                                                                                                            <div class="col-md-12">
                                                                                                                <label><b>Sapo2</b></label>
                                                                                                                <input type="text" class="form-control" name="spo2" value="{{$examen_fisico_general->spo2}}" required>
                                                                                                            </div>
                                                                                                            @endif
                                                                                                            @if($examen_fisico_general->sato2 <> 'N/A')
                                                                                                                <div class="col-md-12">
                                                                                                                    <label><b>Sato2</b></label>
                                                                                                                    <input type="text" class="form-control" name="sato2" value="{{$examen_fisico_general->sato2}}" required>
                                                                                                                </div>
                                                                                                                @endif
                                                                                                                @if($examen_fisico_general->fio2 <> 'N/A')
                                                                                                                    <div class="col-md-12">
                                                                                                                        <label><b>Fio2</b></label>
                                                                                                                        <input type="text" class="form-control" name="fio2" value="{{$examen_fisico_general->fio2}}" required>
                                                                                                                    </div>
                                                                                                                    @endif
                                                                                                                    @if($examen_fisico_general->sc <> 'N/A')
                                                                                                                        <div class="col-md-12">
                                                                                                                            <label><b>SC</b></label>
                                                                                                                            <input type="text" class="form-control" name="sc" value="{{$examen_fisico_general->sc}}" required>
                                                                                                                        </div>
                                                                                                                        @endif
                                                                                                                        @if($examen_fisico_general->apgar <> 'N/A')
                                                                                                                            <div class="col-md-12">
                                                                                                                                <label><b>Apgar</b></label>
                                                                                                                                <input type="text" class="form-control" name="apgar" value="{{$examen_fisico_general->apgar}}" required>
                                                                                                                            </div>
                                                                                                                            @endif
                                                                                                                            @if($examen_fisico_general->silverman <> 'N/A')
                                                                                                                                <div class="col-md-12">
                                                                                                                                    <label><b>Silverman</b></label>
                                                                                                                                    <input type="text" class="form-control" name="silverman" value="{{$examen_fisico_general->silverman}}" required>
                                                                                                                                </div>
                                                                                                                                @endif
                                                                                                                                @if($examen_fisico_general->edad_por_capurro <> 'N/A')
                                                                                                                                    <div class="col-md-12">
                                                                                                                                        <label><b>Edad por capurro</b></label>
                                                                                                                                        <input type="text" class="form-control" name="edad_por_capurro" value="{{$examen_fisico_general->edad_por_capurro}}" required>
                                                                                                                                    </div>
                                                                                                                                    @endif
                                                                                                                                    @if($examen_fisico_general->pa <> 'N/A')
                                                                                                                                        <div class="col-md-12">
                                                                                                                                            <label><b>PA</b></label>
                                                                                                                                            <input type="text" class="form-control" name="pa" value="{{$examen_fisico_general->pa}}" required>
                                                                                                                                        </div>
                                                                                                                                        @endif
                                                                                                                                        @if($examen_fisico_general->somatometria <> 'N/A')
                                                                                                                                            <div class="col-md-12">
                                                                                                                                                <label><b>Somatometria</b></label>
                                                                                                                                                <input type="text" class="form-control" name="somatometria" value="{{$examen_fisico_general->somatometria}}" required>
                                                                                                                                            </div>
                                                                                                                                            @endif
                                                                                                                                            @if($examen_fisico_general->saturacion <> 'N/A')
                                                                                                                                                <div class="col-md-12">
                                                                                                                                                    <label><b>Saturacion</b></label>
                                                                                                                                                    <input type="text" class="form-control" name="saturacion" value="{{$examen_fisico_general->saturacion}}" required>
                                                                                                                                                </div>
                                                                                                                                                @endif
                                                                                                                                                @if($examen_fisico_general->perimetro_cefalico <> 'N/A')
                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                        <label><b>Perimetro cefalico</b></label>
                                                                                                                                                        <input type="text" class="form-control" name="perimetro_cefalico" value="{{$examen_fisico_general->perimetro_cefalico}}" required>
                                                                                                                                                    </div>
                                                                                                                                                    @endif
                                                                                                                                                    @if($examen_fisico_general->perimetro_toracico <> 'N/A')
                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                            <label><b>Perimetro toracico</b></label>
                                                                                                                                                            <input type="text" class="form-control" name="perimetro_toracico" value="{{$examen_fisico_general->perimetro_toracico}}" required>
                                                                                                                                                        </div>
                                                                                                                                                        @endif
                                                                                                                                                        @if($examen_fisico_general->perimetro_abdominal <> 'N/A')
                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                <label><b>Perimetro abdominal</b></label>
                                                                                                                                                                <input type="text" class="form-control" name="perimetro_abdominal" value="{{$examen_fisico_general->perimetro_abdominal}}" required>
                                                                                                                                                            </div>
                                                                                                                                                            @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('examen_fisico_segmentado.update',$examen_fisico_segmentado->id_examen_fisico_segmentado) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($examen_fisico_segmentado->cabeza <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Cabeza</b></label>
                                                <input type="text" class="form-control" name="cabeza" value="{{$examen_fisico_segmentado->cabeza}}" required>
                                            </div>
                                            @endif
                                            @if($examen_fisico_segmentado->frontales <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Frontales</b></label>
                                                    <input type="text" class="form-control" name="frontales" value="{{$examen_fisico_segmentado->frontales}}" required>
                                                </div>
                                                @endif
                                                @if($examen_fisico_segmentado->cabellos <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Cabellos</b></label>
                                                        <input type="text" class="form-control" name="cabellos" value="{{$examen_fisico_segmentado->cabellos}}" required>
                                                    </div>
                                                    @endif
                                                    @if($examen_fisico_segmentado->cara <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Cara</b></label>
                                                            <input type="text" class="form-control" name="cara" value="{{$examen_fisico_segmentado->cara}}" required>
                                                        </div>
                                                        @endif
                                                        @if($examen_fisico_segmentado->apertura_ocular <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Apertura ocular</b></label>
                                                                <input type="text" class="form-control" name="apertura_ocular" value="{{$examen_fisico_segmentado->apertura_ocular}}" required>
                                                            </div>
                                                            @endif
                                                            @if($examen_fisico_segmentado->ojos <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Ojos</b></label>
                                                                    <input type="text" class="form-control" name="ojos" value="{{$examen_fisico_segmentado->ojos}}" required>
                                                                </div>
                                                                @endif
                                                                @if($examen_fisico_segmentado->nariz <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Nariz</b></label>
                                                                        <input type="text" class="form-control" name="nariz" value="{{$examen_fisico_segmentado->nariz}}" required>
                                                                    </div>
                                                                    @endif
                                                                    @if($examen_fisico_segmentado->fosas_nasales <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Fosas nasales</b></label>
                                                                            <input type="text" class="form-control" name="fosas_nasales" value="{{$examen_fisico_segmentado->fosas_nasales}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_fisico_segmentado->piramide_nasal <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Piramide nasal</b></label>
                                                                                <input type="text" class="form-control" name="piramide_nasal" value="{{$examen_fisico_segmentado->piramide_nasal}}" required>
                                                                            </div>
                                                                            @endif
                                                                            @if($examen_fisico_segmentado->coanas <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Coanas</b></label>
                                                                                    <input type="text" class="form-control" name="coanas" value="{{$examen_fisico_segmentado->coanas}}" required>
                                                                                </div>
                                                                                @endif
                                                                                @if($examen_fisico_segmentado->pabellon_auricular <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Pabellon auricular</b></label>
                                                                                        <input type="text" class="form-control" name="pabellon_auricular" value="{{$examen_fisico_segmentado->pabellon_auricular}}" required>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($examen_fisico_segmentado->curvatura <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Curvatura</b></label>
                                                                                            <input type="text" class="form-control" name="curvatura" value="{{$examen_fisico_segmentado->curvatura}}" required>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($examen_fisico_segmentado->boca <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Boca</b></label>
                                                                                                <input type="text" class="form-control" name="boca" value="{{$examen_fisico_segmentado->boca}}" required>
                                                                                            </div>
                                                                                            @endif
                                                                                            @if($examen_fisico_segmentado->apertura_bucal <> 'N/A')
                                                                                                <div class="col-md-12">
                                                                                                    <label><b>Apertura bucal</b></label>
                                                                                                    <input type="text" class="form-control" name="apertura_bucal" value="{{$examen_fisico_segmentado->apertura_bucal}}" required>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if($examen_fisico_segmentado->paladar <> 'N/A')
                                                                                                    <div class="col-md-12">
                                                                                                        <label><b>Paladar</b></label>
                                                                                                        <input type="text" class="form-control" name="paladar" value="{{$examen_fisico_segmentado->paladar}}" required>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    @if($examen_fisico_segmentado->mucosa_oral <> 'N/A')
                                                                                                        <div class="col-md-12">
                                                                                                            <label><b>Mucosa oral</b></label>
                                                                                                            <input type="text" class="form-control" name="mucosa_oral" value="{{$examen_fisico_segmentado->mucosa_oral}}" required>
                                                                                                        </div>
                                                                                                        @endif
                                                                                                        @if($examen_fisico_segmentado->pulmones <> 'N/A')
                                                                                                            <div class="col-md-12">
                                                                                                                <label><b>Pulmones</b></label>
                                                                                                                <input type="text" class="form-control" name="pulmones" value="{{$examen_fisico_segmentado->pulmones}}" required>
                                                                                                            </div>
                                                                                                            @endif
                                                                                                            @if($examen_fisico_segmentado->pulmones_inspeccion <> 'N/A')
                                                                                                                <div class="col-md-12">
                                                                                                                    <label><b>Pulmones inspeccion</b></label>
                                                                                                                    <input type="text" class="form-control" name="pulmones_inspeccion" value="{{$examen_fisico_segmentado->pulmones_inspeccion}}" required>
                                                                                                                </div>
                                                                                                                @endif
                                                                                                                @if($examen_fisico_segmentado->pulmones_palpacion <> 'N/A')
                                                                                                                    <div class="col-md-12">
                                                                                                                        <label><b>Pulmones palpacion</b></label>
                                                                                                                        <input type="text" class="form-control" name="pulmones_palpacion" value="{{$examen_fisico_segmentado->pulmones_palpacion}}" required>
                                                                                                                    </div>
                                                                                                                    @endif
                                                                                                                    @if($examen_fisico_segmentado->pulmones_percusion <> 'N/A')
                                                                                                                        <div class="col-md-12">
                                                                                                                            <label><b>Pulmones percusion</b></label>
                                                                                                                            <input type="text" class="form-control" name="pulmones_percusion" value="{{$examen_fisico_segmentado->pulmones_percusion}}" required>
                                                                                                                        </div>
                                                                                                                        @endif
                                                                                                                        @if($examen_fisico_segmentado->pulmones_auscultacion <> 'N/A')
                                                                                                                            <div class="col-md-12">
                                                                                                                                <label><b>Pulmones auscultacion</b></label>
                                                                                                                                <input type="text" class="form-control" name="pulmones_auscultacion" value="{{$examen_fisico_segmentado->pulmones_auscultacion}}" required>
                                                                                                                            </div>
                                                                                                                            @endif
                                                                                                                            @if($examen_fisico_segmentado->corazon <> 'N/A')
                                                                                                                                <div class="col-md-12">
                                                                                                                                    <label><b>Corazon</b></label>
                                                                                                                                    <input type="text" class="form-control" name="corazon" value="{{$examen_fisico_segmentado->corazon}}" required>
                                                                                                                                </div>
                                                                                                                                @endif
                                                                                                                                @if($examen_fisico_segmentado->corazon_inspeccion <> 'N/A')
                                                                                                                                    <div class="col-md-12">
                                                                                                                                        <label><b>Corazon inspeccion</b></label>
                                                                                                                                        <input type="text" class="form-control" name="corazon_inspeccion" value="{{$examen_fisico_segmentado->corazon_inspeccion}}" required>
                                                                                                                                    </div>
                                                                                                                                    @endif
                                                                                                                                    @if($examen_fisico_segmentado->corazon_palpacion <> 'N/A')
                                                                                                                                        <div class="col-md-12">
                                                                                                                                            <label><b>Corazon palpacion</b></label>
                                                                                                                                            <input type="text" class="form-control" name="corazon_palpacion" value="{{$examen_fisico_segmentado->corazon_palpacion}}" required>
                                                                                                                                        </div>
                                                                                                                                        @endif
                                                                                                                                        @if($examen_fisico_segmentado->corazon_percusion <> 'N/A')
                                                                                                                                            <div class="col-md-12">
                                                                                                                                                <label><b>Corazon percusion</b></label>
                                                                                                                                                <input type="text" class="form-control" name="corazon_percusion" value="{{$examen_fisico_segmentado->corazon_percusion}}" required>
                                                                                                                                            </div>
                                                                                                                                            @endif
                                                                                                                                            @if($examen_fisico_segmentado->corazon_auscultacion <> 'N/A')
                                                                                                                                                <div class="col-md-12">
                                                                                                                                                    <label><b>Corazon auscultacion</b></label>
                                                                                                                                                    <input type="text" class="form-control" name="corazon_auscultacion" value="{{$examen_fisico_segmentado->corazon_auscultacion}}" required>
                                                                                                                                                </div>
                                                                                                                                                @endif
                                                                                                                                                @if($examen_fisico_segmentado->abdomen <> 'N/A')
                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                        <label><b>Abdomen</b></label>
                                                                                                                                                        <input type="text" class="form-control" name="abdomen" value="{{$examen_fisico_segmentado->abdomen}}" required>
                                                                                                                                                    </div>
                                                                                                                                                    @endif
                                                                                                                                                    @if($examen_fisico_segmentado->abdomen_inspeccion <> 'N/A')
                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                            <label><b>Abdomen inspeccion</b></label>
                                                                                                                                                            <input type="text" class="form-control" name="abdomen_inspeccion" value="{{$examen_fisico_segmentado->abdomen_inspeccion}}" required>
                                                                                                                                                        </div>
                                                                                                                                                        @endif
                                                                                                                                                        @if($examen_fisico_segmentado->abdomen_palpacion <> 'N/A')
                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                <label><b>Abdomen palpacion</b></label>
                                                                                                                                                                <input type="text" class="form-control" name="abdomen_palpacion" value="{{$examen_fisico_segmentado->abdomen_palpacion}}" required>
                                                                                                                                                            </div>
                                                                                                                                                            @endif
                                                                                                                                                            @if($examen_fisico_segmentado->abdomen_percusion <> 'N/A')
                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                    <label><b>Abdomen percusion</b></label>
                                                                                                                                                                    <input type="text" class="form-control" name="abdomen_percusion" value="{{$examen_fisico_segmentado->abdomen_percusion}}" required>
                                                                                                                                                                </div>
                                                                                                                                                                @endif
                                                                                                                                                                @if($examen_fisico_segmentado->precordio <> 'N/A')
                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                        <label><b>Precordio</b></label>
                                                                                                                                                                        <input type="text" class="form-control" name="precordio" value="{{$examen_fisico_segmentado->precordio}}" required>
                                                                                                                                                                    </div>
                                                                                                                                                                    @endif
                                                                                                                                                                    @if($examen_fisico_segmentado->cordon_umbilical <> 'N/A')
                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                            <label><b>Cordon umbilical</b></label>
                                                                                                                                                                            <input type="text" class="form-control" name="cordon_umbilical" value="{{$examen_fisico_segmentado->cordon_umbilical}}" required>
                                                                                                                                                                        </div>
                                                                                                                                                                        @endif
                                                                                                                                                                        @if($examen_fisico_segmentado->relacion_arteriovenosa <> 'N/A')
                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                <label><b>Relacion arteriovenosa</b></label>
                                                                                                                                                                                <input type="text" class="form-control" name="relacion_arteriovenosa" value="{{$examen_fisico_segmentado->relacion_arteriovenosa}}" required>
                                                                                                                                                                            </div>
                                                                                                                                                                            @endif
                                                                                                                                                                            @if($examen_fisico_segmentado->genitales_acuerdo_sexo_edad <> 'N/A')
                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                    <label><b>Genitales de acuerdo a sexo y edad</b></label>
                                                                                                                                                                                    <input type="text" class="form-control" name="genitales_acuerdo_sexo_edad" value="{{$examen_fisico_segmentado->genitales_acuerdo_sexo_edad}}" required>
                                                                                                                                                                                </div>
                                                                                                                                                                                @endif
                                                                                                                                                                                @if($examen_fisico_segmentado->pies <> 'N/A')
                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                        <label><b>Pies</b></label>
                                                                                                                                                                                        <input type="text" class="form-control" name="pies" value="{{$examen_fisico_segmentado->pies}}" required>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    @endif
                                                                                                                                                                                    @if($examen_fisico_segmentado->surcos_plantales <> 'N/A')
                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                            <label><b>Surcos plantales</b></label>
                                                                                                                                                                                            <input type="text" class="form-control" name="surcos_plantales" value="{{$examen_fisico_segmentado->surcos_plantales}}" required>
                                                                                                                                                                                        </div>
                                                                                                                                                                                        @endif
                                                                                                                                                                                        @if($examen_fisico_segmentado->reflejos_succion <> 'N/A')
                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                <label><b>Reflejos succion</b></label>
                                                                                                                                                                                                <input type="text" class="form-control" name="reflejos_succion" value="{{$examen_fisico_segmentado->reflejos_succion}}" required>
                                                                                                                                                                                            </div>
                                                                                                                                                                                            @endif
                                                                                                                                                                                            @if($examen_fisico_segmentado->genitourinarios <> 'N/A')
                                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                                    <label><b>Genitourinarios</b></label>
                                                                                                                                                                                                    <input type="text" class="form-control" name="genitourinarios" value="{{$examen_fisico_segmentado->genitourinarios}}" required>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                @endif
                                                                                                                                                                                                @if($examen_fisico_segmentado->extremidades <> 'N/A')
                                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                                        <label><b>Extremidades</b></label>
                                                                                                                                                                                                        <input type="text" class="form-control" name="extremidades" value="{{$examen_fisico_segmentado->extremidades}}" required>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    @endif
                                                                                                                                                                                                    @if($examen_fisico_segmentado->neurologicos <> 'N/A')
                                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                                            <label><b>Neurologicos</b></label>
                                                                                                                                                                                                            <input type="text" class="form-control" name="neurologicos" value="{{$examen_fisico_segmentado->neurologicos}}" required>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        @endif
                                                                                                                                                                                                        @if($examen_fisico_segmentado->craneo <> 'N/A')
                                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                                <label><b>Craneo</b></label>
                                                                                                                                                                                                                <input type="text" class="form-control" name="craneo" value="{{$examen_fisico_segmentado->craneo}}" required>
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                            @endif
                                                                                                                                                                                                            @if($examen_fisico_segmentado->cavidad_bucal <> 'N/A')
                                                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                                                    <label><b>Cavidad bucal</b></label>
                                                                                                                                                                                                                    <input type="text" class="form-control" name="cavidad_bucal" value="{{$examen_fisico_segmentado->cavidad_bucal}}" required>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                @if($examen_fisico_segmentado->cuello <> 'N/A')
                                                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                                                        <label><b>Cuello</b></label>
                                                                                                                                                                                                                        <input type="text" class="form-control" name="cuello" value="{{$examen_fisico_segmentado->cuello}}" required>
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                    @if($examen_fisico_segmentado->cuello_inspeccion <> 'N/A')
                                                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                                                            <label><b>Cuello inspeccion</b></label>
                                                                                                                                                                                                                            <input type="text" class="form-control" name="cuello_inspeccion" value="{{$examen_fisico_segmentado->cuello_inspeccion}}" required>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                        @if($examen_fisico_segmentado->cuello_palpacion <> 'N/A')
                                                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                                                <label><b>Cuello palpacion</b></label>
                                                                                                                                                                                                                                <input type="text" class="form-control" name="cuello_palpacion" value="{{$examen_fisico_segmentado->cuello_palpacion}}" required>
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                            @if($examen_fisico_segmentado->cuello_auscultacion <> 'N/A')
                                                                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                                                                    <label><b>Cuello auscultacion</b></label>
                                                                                                                                                                                                                                    <input type="text" class="form-control" name="cuello_auscultacion" value="{{$examen_fisico_segmentado->cuello_auscultacion}}" required>
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                @if($examen_fisico_segmentado->torax <> 'N/A')
                                                                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                                                                        <label><b>Torax</b></label>
                                                                                                                                                                                                                                        <input type="text" class="form-control" name="torax" value="{{$examen_fisico_segmentado->torax}}" required>
                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                    @endif

                                                                                                                                                                                                                                    @if($examen_fisico_segmentado->torax_inspeccion_estatico <> 'N/A')
                                                                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                                                                            <label><b>Torax inspeccion estatico</b></label>
                                                                                                                                                                                                                                            <input type="text" class="form-control" name="torax_inspeccion_estatico" value="{{$examen_fisico_segmentado->torax_inspeccion_estatico}}" required>
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                        @if($examen_fisico_segmentado->torax_inspeccion_dinamico <> 'N/A')
                                                                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                                                                <label><b>Torax inspeccion dinamico</b></label>
                                                                                                                                                                                                                                                <input type="text" class="form-control" name="torax_inspeccion_dinamico" value="{{$examen_fisico_segmentado->torax_inspeccion_dinamico}}" required>
                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                            @if($examen_fisico_segmentado->torax_palpacion <> 'N/A')
                                                                                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                                                                                    <label><b>Torax palpacion</b></label>
                                                                                                                                                                                                                                                    <input type="text" class="form-control" name="torax_palpacion" value="{{$examen_fisico_segmentado->torax_palpacion}}" required>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                                @if($examen_fisico_segmentado->torax_percusion <> 'N/A')
                                                                                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                                                                                        <label><b>Torax percusion</b></label>
                                                                                                                                                                                                                                                        <input type="text" class="form-control" name="torax_percusion" value="{{$examen_fisico_segmentado->torax_percusion}}" required>
                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                    @if($examen_fisico_segmentado->torax_auscultacion <> 'N/A')
                                                                                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                                                                                            <label><b>Torax auscultacion</b></label>
                                                                                                                                                                                                                                                            <input type="text" class="form-control" name="torax_auscultacion" value="{{$examen_fisico_segmentado->torax_auscultacion}}" required>
                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                        @if($examen_fisico_segmentado->mamas <> 'N/A')
                                                                                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                                                                                <label><b>Mamas </b></label>
                                                                                                                                                                                                                                                                <input type="text" class="form-control" name="mamas" value="{{$examen_fisico_segmentado->mamas}}" required>
                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                            @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('examen_obstetrico.update',$examen_obstetrico->id_examen_obstetrico) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">

                                        @if($examen_obstetrico->genitales <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Genitales</b></label>
                                                <input type="text" class="form-control" name="genitales" value="{{$examen_obstetrico->genitales}}" required>
                                            </div>
                                            @endif
                                            @if($examen_obstetrico->flujos <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Flujos</b></label>
                                                    <input type="text" class="form-control" name="flujos" value="{{$examen_obstetrico->flujos}}" required>
                                                </div>
                                                @endif
                                                @if($examen_obstetrico->afu <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>AFU</b></label>
                                                        <input type="text" class="form-control" name="afu" value="{{$examen_obstetrico->afu}}" required>
                                                    </div>
                                                    @endif
                                                    @if($examen_obstetrico->situacion <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Situacion</b></label>
                                                            <input type="text" class="form-control" name="situacion" value="{{$examen_obstetrico->situacion}}" required>
                                                        </div>
                                                        @endif
                                                        @if($examen_obstetrico->posicion <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Posicion</b></label>
                                                                <input type="text" class="form-control" name="posicion" value="{{$examen_obstetrico->posicion}}" required>
                                                            </div>
                                                            @endif
                                                            @if($examen_obstetrico->tacto_vaginal <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Tacto vaginal</b></label>
                                                                    <input type="text" class="form-control" name="tacto_vaginal" value="{{$examen_obstetrico->tacto_vaginal}}" required>
                                                                </div>
                                                                @endif

                                                                @if($examen_obstetrico->fcf <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>FCF</b></label>
                                                                        <input type="text" class="form-control" name="fcf" value="{{$examen_obstetrico->fcf}}" required>
                                                                    </div>
                                                                    @endif
                                                                    @if($examen_obstetrico->presentacion <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Presentacion</b></label>
                                                                            <input type="text" class="form-control" name="presentacion" value="{{$examen_obstetrico->presentacion}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_obstetrico->movimientos_fetales <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Movimientos fetales </b></label>
                                                                                <input type="text" class="form-control" name="movimientos_fetales" value="{{$examen_obstetrico->movimientos_fetales}}" required>
                                                                            </div>
                                                                            @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('examen_ginecologico.update',$examen_ginecologico->id_examen_ginecologico) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">

                                        @if($examen_ginecologico->vello_pubiano <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Vello pubiano</b></label>
                                                <input type="text" class="form-control" name="vello_pubiano" value="{{$examen_ginecologico->vello_pubiano}}" required>
                                            </div>
                                            @endif
                                            @if($examen_ginecologico->vulva <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Vulva</b></label>
                                                    <input type="text" class="form-control" name="vulva" value="{{$examen_ginecologico->vulva}}" required>
                                                </div>
                                                @endif
                                                @if($examen_ginecologico->uretra <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Uretra</b></label>
                                                        <input type="text" class="form-control" name="uretra" value="{{$examen_ginecologico->uretra}}" required>
                                                    </div>
                                                    @endif
                                                    @if($examen_ginecologico->glandulas_bys <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Glandulas ByS</b></label>
                                                            <input type="text" class="form-control" name="glandulas_bys" value="{{$examen_ginecologico->glandulas_bys}}" required>
                                                        </div>
                                                        @endif
                                                        @if($examen_ginecologico->clitoris <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Clitoris</b></label>
                                                                <input type="text" class="form-control" name="clitoris" value="{{$examen_ginecologico->clitoris}}" required>
                                                            </div>
                                                            @endif
                                                            @if($examen_ginecologico->perineo <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Perineo</b></label>
                                                                    <input type="text" class="form-control" name="perineo" value="{{$examen_ginecologico->perineo}}" required>
                                                                </div>
                                                                @endif

                                                                @if($examen_ginecologico->vagina <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Vagina</b></label>
                                                                        <input type="text" class="form-control" name="vagina" value="{{$examen_ginecologico->vagina}}" required>
                                                                    </div>
                                                                    @endif
                                                                    @if($examen_ginecologico->cuello_uterino <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Cuello uterino</b></label>
                                                                            <input type="text" class="form-control" name="cuello_uterino" value="{{$examen_ginecologico->cuello_uterino}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_ginecologico->cuerpo_uterino <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Cuerpo uterino</b></label>
                                                                                <input type="text" class="form-control" name="cuerpo_uterino" value="{{$examen_ginecologico->cuerpo_uterino}}" required>
                                                                            </div>
                                                                            @endif
                                                                            @if($examen_ginecologico->anexos <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Anexos</b></label>
                                                                                    <input type="text" class="form-control" name="anexos" value="{{$examen_ginecologico->anexos}}" required>
                                                                                </div>
                                                                                @endif


                                                                                @if($examen_ginecologico->especuloscopia <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Especuloscopia </b></label>
                                                                                        <input type="text" class="form-control" name="especuloscopia" value="{{$examen_ginecologico->especuloscopia}}" required>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($examen_ginecologico->tacto_rectal <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Tacto rectal</b></label>
                                                                                            <input type="text" class="form-control" name="tacto_rectal" value="{{$examen_ginecologico->tacto_rectal}}" required>
                                                                                        </div>
                                                                                        @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('examen_cardiovascular.update',$examen_cardiovascular->id_examen_cardiovascular) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($examen_cardiovascular->cardiovascular_palpacion <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Cardiovascular palpacion</b></label>
                                                <input type="text" class="form-control" name="cardiovascular_palpacion" value="{{$examen_cardiovascular->cardiovascular_palpacion}}" required>
                                            </div>
                                            @endif
                                            @if($examen_cardiovascular->cardiovascular_percusion <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Cardiovascular percusion</b></label>
                                                    <input type="text" class="form-control" name="cardiovascular_percusion" value="{{$examen_cardiovascular->cardiovascular_percusion}}" required>
                                                </div>
                                                @endif
                                                @if($examen_cardiovascular->cardiovascular_auscultacion <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Cardiovascular auscultacion</b></label>
                                                        <input type="text" class="form-control" name="cardiovascular_auscultacion" value="{{$examen_cardiovascular->cardiovascular_auscultacion}}" required>
                                                    </div>
                                                    @endif
                                                    @if($examen_cardiovascular->cardiovascular_agregados <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Cardiovascular agregados</b></label>
                                                            <input type="text" class="form-control" name="cardiovascular_agregados" value="{{$examen_cardiovascular->cardiovascular_agregados}}" required>
                                                        </div>
                                                        @endif
                                                        @if($examen_cardiovascular->cardiovascular_soplos <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Cardiovascular soplos </b></label>
                                                                <input type="text" class="form-control" name="cardiovascular_soplos" value="{{$examen_cardiovascular->cardiovascular_soplos}}" required>
                                                            </div>
                                                            @endif
                                                            @if($examen_cardiovascular->cardiovascular_fremito <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Cardiovascular fremito</b></label>
                                                                    <input type="text" class="form-control" name="cardiovascular_fremito" value="{{$examen_cardiovascular->cardiovascular_fremito}}" required>
                                                                </div>
                                                                @endif
                                                                @if($examen_cardiovascular->pulsos_perifericos <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Pulsos perifericos</b></label>
                                                                        <input type="text" class="form-control" name="pulsos_perifericos" value="{{$examen_cardiovascular->pulsos_perifericos}}" required>
                                                                    </div>
                                                                    @endif

                                                                    @if($examen_cardiovascular->branquial <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Branquial</b></label>
                                                                            <input type="text" class="form-control" name="branquial" value="{{$examen_cardiovascular->branquial}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_cardiovascular->femoral <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Femoral</b></label>
                                                                                <input type="text" class="form-control" name="femoral" value="{{$examen_cardiovascular->femoral}}" required>
                                                                            </div>
                                                                            @endif
                                                                            @if($examen_cardiovascular->tibia <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Tibia</b></label>
                                                                                    <input type="text" class="form-control" name="tibia" value="{{$examen_cardiovascular->tibia}}" required>
                                                                                </div>
                                                                                @endif
                                                                                @if($examen_cardiovascular->radial <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Radial</b></label>
                                                                                        <input type="text" class="form-control" name="radial" value="{{$examen_cardiovascular->radial}}" required>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($examen_cardiovascular->popliteo <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Popliteo </b></label>
                                                                                            <input type="text" class="form-control" name="popliteo" value="{{$examen_cardiovascular->popliteo}}" required>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($examen_cardiovascular->pedio <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Pedio</b></label>
                                                                                                <input type="text" class="form-control" name="pedio" value="{{$examen_cardiovascular->pedio}}" required>
                                                                                            </div>
                                                                                            @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('examen_genito_urinario.update',$examen_genito_urinario->id_examen_genitourinario) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($examen_genito_urinario->punio_percusion_renal <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Puño percusion renal </b></label>
                                                <input type="text" class="form-control" name="punio_percusion_renal" value="{{$examen_genito_urinario->punio_percusion_renal}}" required>
                                            </div>
                                            @endif
                                            @if($examen_genito_urinario->palpacion_renal <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Palpacion renal</b></label>
                                                    <input type="text" class="form-control" name="palpacion_renal" value="{{$examen_genito_urinario->palpacion_renal}}" required>
                                                </div>
                                                @endif
                                                @if($examen_genito_urinario->puntos_ureterales <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Puntos ureterales</b></label>
                                                        <input type="text" class="form-control" name="puntos_ureterales" value="{{$examen_genito_urinario->puntos_ureterales}}" required>
                                                    </div>
                                                    @endif
                                                    @if($examen_genito_urinario->genitales <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Genitales</b></label>
                                                            <input type="text" class="form-control" name="genitales" value="{{$examen_genito_urinario->genitales}}" required>
                                                        </div>
                                                        @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('examen_extremidades_superiores.update',$examen_extremidades_superiores->id_examen_extremidades_superiores) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($examen_extremidades_superiores->s_simetria <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Simetria</b></label>
                                                <input type="text" class="form-control" name="s_simetria" value="{{$examen_extremidades_superiores->s_simetria}}" required>
                                            </div>
                                            @endif
                                            @if($examen_extremidades_superiores->s_deformidades <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Deformidades </b></label>
                                                    <input type="text" class="form-control" name="s_deformidades" value="{{$examen_extremidades_superiores->s_deformidades}}" required>
                                                </div>
                                                @endif
                                                @if($examen_extremidades_superiores->s_articulaciones <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Articulaciones</b></label>
                                                        <input type="text" class="form-control" name="s_articulaciones" value="{{$examen_extremidades_superiores->s_articulaciones}}" required>
                                                    </div>
                                                    @endif
                                                    @if($examen_extremidades_superiores->s_piel <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Piel</b></label>
                                                            <input type="text" class="form-control" name="s_piel" value="{{$examen_extremidades_superiores->s_piel}}" required>
                                                        </div>
                                                        @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('examen_extremidades_inferiores.update',$examen_extremidades_inferiores->id_examen_extremidades_inferiores ) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($examen_extremidades_inferiores->i_simetria <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Simetria</b></label>
                                                <input type="text" class="form-control" name="i_simetria" value="{{$examen_extremidades_inferiores->i_simetria}}" required>
                                            </div>
                                            @endif
                                            @if($examen_extremidades_inferiores->i_deformidades <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Deformidades </b></label>
                                                    <input type="text" class="form-control" name="i_deformidades" value="{{$examen_extremidades_inferiores->i_deformidades}}" required>
                                                </div>
                                                @endif
                                                @if($examen_extremidades_inferiores->i_articulaciones <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Deformidades </b></label>
                                                        <input type="text" class="form-control" name="i_articulaciones" value="{{$examen_extremidades_inferiores->i_articulaciones}}" required>
                                                    </div>
                                                    @endif
                                                    @if($examen_extremidades_inferiores->i_piel <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Piel</b></label>
                                                            <input type="text" class="form-control" name="i_piel" value="{{$examen_extremidades_inferiores->i_piel}}" required>
                                                        </div>
                                                        @endif
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('dermatologia.update',$dermatologia->id_dermatologia) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($dermatologia->piel <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Piel</b></label>
                                                <input type="text" class="form-control" name="piel" value="{{$dermatologia->piel}}" required>
                                            </div>
                                            @endif
                                            @if($dermatologia->pelo <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Pelo </b></label>
                                                    <input type="text" class="form-control" name="pelo" value="{{$dermatologia->pelo}}" required>
                                                </div>
                                                @endif
                                                @if($dermatologia->unias <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Uñas </b></label>
                                                        <input type="text" class="form-control" name="unias" value="{{$dermatologia->unias}}" required>
                                                    </div>
                                                    @endif
                                                    @if($dermatologia->mucosas <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Mucosas</b></label>
                                                            <input type="text" class="form-control" name="mucosas" value="{{$dermatologia->mucosas}}" required>
                                                        </div>
                                                        @endif
                                                        @if($dermatologia->topografia <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Topografia</b></label>
                                                                <input type="text" class="form-control" name="topografia" value="{{$dermatologia->topografia}}" required>
                                                            </div>
                                                            @endif
                                                            @if($dermatologia->iconografia <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Iconografia</b></label>
                                                                    <input type="text" class="form-control" name="iconografia" value="{{$dermatologia->iconografia}}" required>
                                                                </div>
                                                                @endif
                                                                @if($dermatologia->morfologia <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Morfologia</b></label>
                                                                        <input type="text" class="form-control" name="morfologia" value="{{$dermatologia->morfologia}}" required>
                                                                    </div>
                                                                    @endif

                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('ganglios.update',$ganglios_linfaticos->id_ganglios) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Ganglios linfaticos </b></label>
                                            <input type="text" class="form-control" name="ganglios_linfaticos" value="{{$ganglios_linfaticos->ganglios_linfaticos}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('sistema_nervioso.update',$sistema_nervioso->id_sistema_nervioso) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <h5>Funciones cerebrales superiores</h5>
                                    <div class="row">
                                        @if($sistema_nervioso->piel <> 'N/A')
                                            <div class="col-12 col-md-6">
                                                <label><b>CONCIENCIA </b></label>
                                                <input type="text" class="form-control" name="conciencia" value="{{$sistema_nervioso->conciencia}}" required>
                                            </div>
                                            @endif
                                            @if($sistema_nervioso->piel <> 'N/A')
                                                <div class="col-12 col-md-6">
                                                    <label><b>GNOSIA</b></label>
                                                    <input type="text" class="form-control" name="gnosia" value="{{$sistema_nervioso->gnosia}}" required>
                                                </div>
                                                @endif
                                                @if($sistema_nervioso->piel <> 'N/A')
                                                    <div class="col-12 col-md-6">
                                                        <label><b>PRAXIA</b></label>
                                                        <input type="text" class="form-control" name="praxia" value="{{$sistema_nervioso->praxia}}" required>
                                                    </div>
                                                    @endif
                                                    @if($sistema_nervioso->piel <> 'N/A')
                                                        <div class="col-12 col-md-6">
                                                            <label><b>LENGUAJE</b></label>
                                                            <input type="text" class="form-control" name="lenguaje" value="{{$sistema_nervioso->lenguaje}}" required>
                                                        </div>
                                                        @endif
                                                        @if($sistema_nervioso->piel <> 'N/A')
                                                            <div class="col-12 col-md-6">
                                                                <label><b>MEMORIA</b></label>
                                                                <input type="text" class="form-control" name="memoria" value="{{$sistema_nervioso->memoria}}" required>
                                                            </div>
                                                            @endif
                                                            @if($sistema_nervioso->piel <> 'N/A')
                                                                <div class="col-12 col-md-6">
                                                                    <label><b>CALCULO</b></label>
                                                                    <input type="text" class="form-control" name="calculo" value="{{$sistema_nervioso->calculo}}" required>
                                                                </div>
                                                                @endif
                                                                @if($sistema_nervioso->piel <> 'N/A')
                                                                    <div class="col-12 col-md-6">
                                                                        <label><b>INTELIGENCIA</b></label>
                                                                        <input type="text" class="form-control" name="inteligencia" value="{{$sistema_nervioso->inteligencia}}" required>
                                                                    </div>
                                                                    @endif
                                                                    @if($sistema_nervioso->piel <> 'N/A')
                                                                        <div class="col-12 col-md-6">
                                                                            <label><b>ATENCION</b></label>
                                                                            <input type="text" class="form-control" name="atencion" value="{{$sistema_nervioso->atencion}}" required>
                                                                        </div>
                                                                        @endif
                                                                        @if($sistema_nervioso->piel <> 'N/A')
                                                                            <div class="col-12 col-md-6">
                                                                                <label><b>EMOTIVIDAD</b></label>
                                                                                <input type="text" class="form-control" name="emotividad" value="{{$sistema_nervioso->emotividad}}" required>
                                                                            </div>
                                                                            @endif
                                                                            @if($sistema_nervioso->piel <> 'N/A')
                                                                                <div class="col-12 col-md-6">
                                                                                    <label><b>PLANIFICACION</b></label>
                                                                                    <input type="text" class="form-control" name="planificacion" value="{{$sistema_nervioso->planificacion}}" required>
                                                                                </div>
                                                                                @endif
                                                                                @if($sistema_nervioso->piel <> 'N/A')
                                                                                    <div class="col-12 col-md-6">
                                                                                        <label><b>DECISION</b></label>
                                                                                        <input type="text" class="form-control" name="decision" value="{{$sistema_nervioso->decision}}" required>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($sistema_nervioso->piel <> 'N/A')
                                                                                        <div class="col-12 col-md-6">
                                                                                            <label><b>PERCEPCION</b></label>
                                                                                            <input type="text" class="form-control" name="percepcion" value="{{$sistema_nervioso->percepcion}}" required>
                                                                                        </div>
                                                                                        @endif
                                    </div>
                                    <h5>Paredes craneales</h5>

                                    <table id="table" class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">

                                        <tbody>
                                            <tr class="align-middle">
                                                <th style="width: 10%" rowspan="2">I</th>
                                                <th style="width: 40%"> Percepcion</th>
                                                <th style="width: 50%"> <input type="text" class="form-control" name="paredes_craneales_percepcion" value="{{$sistema_nervioso->paredes_craneales_percepcion}}" required></th>
                                            </tr>
                                            <tr class="align-middle">

                                                <th> Identificacion</th>
                                                <th><input type="text" class="form-control" name="identificacion" value="{{$sistema_nervioso->identificacion}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th rowspan="4">II</th>
                                                <th> Agudez visual</th>
                                                <th><input type="text" class="form-control" name="agudez_visual" value="{{$sistema_nervioso->agudez_visual}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th> Vision de color</th>
                                                <th><input type="text" class="form-control" name="vision_de_colores" value="{{$sistema_nervioso->vision_de_colores}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th> Campo visula</th>
                                                <th><input type="text" class="form-control" name="campo_visual" value="{{$sistema_nervioso->campo_visual}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th> Pupilas</th>
                                                <th><input type="text" class="form-control" name="pupilas" value="{{$sistema_nervioso->pupilas}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>III</th>
                                                <th> Motilidad del globo ocular</th>
                                                <th><input type="text" class="form-control" name="motilidad_del_globo_ocular" value="{{$sistema_nervioso->motilidad_del_globo_ocular}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>IV</th>
                                                <th> Reflejos fotomotor</th>
                                                <th><input type="text" class="form-control" name="reflejo_fotomotor" value="{{$sistema_nervioso->reflejo_fotomotor}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>V</th>
                                                <th> Reflejos de acomodacion</th>
                                                <th><input type="text" class="form-control" name="reflejos_de_acomodacion" value="{{$sistema_nervioso->reflejos_de_acomodacion}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th rowspan="4">VI</th>
                                                <th>Sensitivo</th>
                                                <th><input type="text" class="form-control" name="sensitivo" value="{{$sistema_nervioso->sensitivo}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Reflejos corneales</th>
                                                <th><input type="text" class="form-control" name="reflejo_corneal" value="{{$sistema_nervioso->reflejo_corneal}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Motor</th>
                                                <th><input type="text" class="form-control" name="motor" value="{{$sistema_nervioso->motor}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Reflejos maseteros</th>
                                                <th><input type="text" class="form-control" name="reflejo_maseterino" value="{{$sistema_nervioso->reflejo_maseterino}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>VII</th>
                                                <th>Valoracion muscular de la expresion facial</th>
                                                <th><input type="text" class="form-control" name="valora_musculos_expresion_facial" value="{{$sistema_nervioso->valora_musculos_expresion_facial}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th rowspan="2">VIII</th>
                                                <th>Audicion (prueba de Rinne, Weber)</th>
                                                <th><input type="text" class="form-control" name="audicion_prueba_rinnne_weber" value="{{$sistema_nervioso->audicion_prueba_rinnne_weber}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Vestibular</th>
                                                <th><input type="text" class="form-control" name="vestibular" value="{{$sistema_nervioso->vestibular}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>IX</th>
                                                <th>Reflejos nauseoso</th>
                                                <th><input type="text" class="form-control" name="reflejo_nauseoso" value="{{$sistema_nervioso->reflejo_nauseoso}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th rowspan="2">X</th>
                                                <th>Tos debil o disfonia</th>
                                                <th><input type="text" class="form-control" name="tos_debil_o_disfonia" value="{{$sistema_nervioso->tos_debil_o_disfonia}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Asimetria paladar blando/trapecio reflejos nauseoso</th>
                                                <th><input type="text" class="form-control" name="asimetria_paladar_blando_perdida_reflejo_nauseoso" value="{{$sistema_nervioso->asimetria_paladar_blando_perdida_reflejo_nauseoso}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>XI</th>
                                                <th>Valor fuerza de esternocleidomastoideo/trapecio</th>
                                                <th><input type="text" class="form-control" name="valor_fuerza_esternocleidomastoideo_trapecio" value="{{$sistema_nervioso->valor_fuerza_esternocleidomastoideo_trapecio}}" required></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>XII</th>
                                                <th>Desviacion de la lengua/fasciculacion de la lengua</th>
                                                <th><input type="text" class="form-control" name="desviacion_o_fasciculacion_de_lengua" value="{{$sistema_nervioso->desviacion_o_fasciculacion_de_lengua}}" required></th>
                                            </tr>
                                        </tbody>

                                    </table><br>

                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('sistema_motor.update',$sistema_motor->id_sistema_motor) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($sistema_motor->tono <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Tono </b></label>
                                                <input type="text" class="form-control" name="tono" value="{{$sistema_motor->tono}}" required>
                                            </div>
                                            @endif
                                            @if($sistema_motor->trofismo <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Trofismo</b></label>
                                                    <input type="text" class="form-control" name="trofismo" value="{{$sistema_motor->trofismo}}" required>
                                                </div>
                                                @endif
                                                @if($sistema_motor->reflejos_de_estiramiento <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Reflejos de estiramiento </b></label>
                                                        <input type="text" class="form-control" name="reflejos_de_estiramiento" value="{{$sistema_motor->reflejos_de_estiramiento}}" required>
                                                    </div>
                                                    @endif
                                    </div><br>
                                    <div class="row">
                                        <div class="col-1"></div>
                                        <div class="col-10">
                                            <table class="table table-bordered table-hover dt-responsive nowrap w-100" border="1" style="width: 100%; table-layout: fixed;">

                                                <thead>
                                                    <tr class="text-center">
                                                        <td colspan="3"><b>Balance muscular (Daniels)</b></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Segmento</th>
                                                        <th>Derecho</th>
                                                        <th>Izquierdo</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><b>Brazo</b></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_brazo_derecho" value="{{$sistema_motor->balance_muscular_brazo_derecho}}" required></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_brazo_izquierdo" value="{{$sistema_motor->balance_muscular_brazo_izquierdo}}" required></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Antebrazo</b></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_antebrazo_derecho" value="{{$sistema_motor->balance_muscular_antebrazo_derecho}}" required></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_antebrazo_izquierdo" value="{{$sistema_motor->balance_muscular_antebrazo_izquierdo}}" required></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Mano</b></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_mano_derecho" value="{{$sistema_motor->balance_muscular_mano_derecho}}" required></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_mano_izquierdo" value="{{$sistema_motor->balance_muscular_mano_izquierdo}}" required></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Muslo</b></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_muslo_derecho" value="{{$sistema_motor->balance_muscular_muslo_derecho}}" required></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_muslo_izquierdo" value="{{$sistema_motor->balance_muscular_muslo_izquierdo}}" required></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Pierna</b></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_pierna_derecho" value="{{$sistema_motor->balance_muscular_pierna_derecho}}" required></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_pierna_izquierdo" value="{{$sistema_motor->balance_muscular_pierna_izquierdo}}" required></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Pie</b></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_pie_derecho" value="{{$sistema_motor->balance_muscular_pie_derecho}}" required></td>
                                                        <td><input type="text" class="form-control" name="balance_muscular_pie_izquierdo" value="{{$sistema_motor->balance_muscular_pie_izquierdo}}" required></td>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('sistema_sensitivo.update',$sistema_sensitivo->id_sistema_sensitivo) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        @if($sistema_sensitivo->sensibilidad_superficial <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Sensibilidad superficial</b></label>
                                                <input type="text" class="form-control" name="sensibilidad_superficial" value="{{$sistema_sensitivo->sensibilidad_superficial}}" required>
                                            </div>
                                            @endif
                                            @if($sistema_sensitivo->sensibilidad_profunda_consciente <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Sensibilidad profunda consciente </b></label>
                                                    <input type="text" class="form-control" name="sensibilidad_profunda_consciente" value="{{$sistema_sensitivo->sensibilidad_profunda_consciente}}" required>
                                                </div>
                                                @endif
                                                @if($sistema_sensitivo->sensibilidad_profunda_inconsciente <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Sensibilidad profunda inconsciente </b></label>
                                                        <input type="text" class="form-control" name="sensibilidad_profunda_inconsciente" value="{{$sistema_sensitivo->sensibilidad_profunda_inconsciente}}" required>
                                                    </div>
                                                    @endif
                                                    @if($sistema_sensitivo->sistema_vestibulo_cerebeloso <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Sistema vestibulo cerebeloso</b></label>
                                                            <input type="text" class="form-control" name="sistema_vestibulo_cerebeloso" value="{{$sistema_sensitivo->sistema_vestibulo_cerebeloso}}" required>
                                                        </div>
                                                        @endif
                                                        @if($sistema_sensitivo->signos_irritacion_meningea <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Signos irritacion meningea</b></label>
                                                                <input type="text" class="form-control" name="signos_irritacion_meningea" value="{{$sistema_sensitivo->signos_irritacion_meningea}}" required>
                                                            </div>
                                                            @endif
                                                            @if($sistema_sensitivo->marcha <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Marcha</b></label>
                                                                    <input type="text" class="form-control" name="marcha" value="{{$sistema_sensitivo->marcha}}" required>
                                                                </div>
                                                                @endif

                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('diagnostico_sindromatico.update',$diagnostico_sindromatico->id_diagnostico) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b> Diagnostico sindromatico</b></label>
                                            <input type="text" class="form-control" name="diagnostico_sindromatico" value="{{$diagnostico_sindromatico->diagnostico_sindromatico}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('examenes_complementarios.update',$examenes_complementarios->id_examenes_complementarios) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b> Examenes complementarios</b></label>
                                            <input type="text" class="form-control" name="examenes_complementarios" value="{{$examenes_complementarios->examenes_complementarios}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('impresion_diadnostica.update',$impresion_diagnostica->id_impresion_diagnostica) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Impresion diagnostica </b></label>
                                            <input type="text" class="form-control" name="impresion_diagnostica" value="{{$impresion_diagnostica->impresion_diagnostica}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('comentarios.update',$comentarios->id_comentarios) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Comentarios </b></label>
                                            <input type="text" class="form-control" name="comentarios" value="{{$comentarios->comentarios}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
                                <form action="{{ route('interpretacion.update',$interpretacion_laboratorios->id_interpretacion) }}" method="POST" autocomplete="off" novalidate>
                                    @csrf @method('PUT')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label><b>Interpretacion laboratorios de estudio y gabinetes </b></label>
                                            <input type="text" class="form-control" name="laboratorios_de_estudio_y_gabinete_solicitados" value="{{$interpretacion_laboratorios->laboratorios_de_estudio_y_gabinete_solicitados}}" required>
                                        </div>
                                    </div><br>
                                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger btn-sm"><i class="fa fa-reply"></i> Cancelar</a>
                                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save "></i> Actualizar</button>
                                </form>
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
<script>
    document.getElementById('seleccion_usuario').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];

        document.getElementById('ci_oculto').value = selected.value;
        document.getElementById('nombres_oculto').value = selected.getAttribute('data-nombres') || '';
        document.getElementById('p_apellido_oculto').value = selected.getAttribute('data-p_apellido') || '';
        document.getElementById('s_apellido_oculto').value = selected.getAttribute('data-s_apellido') || '';
        document.getElementById('sexo_oculto').value = selected.getAttribute('data-sexo') || '';
        document.getElementById('fecha_nacimiento_oculto').value = selected.getAttribute('data-fecha_nacimiento') || '';
        document.getElementById('matricula_oculto').value = selected.getAttribute('data-matricula_seguro') || '';
        document.getElementById('nacionalidad_oculto').value = selected.getAttribute('data-nacionalidad') || '';
        document.getElementById('telefono_oculto').value = selected.getAttribute('data-telefono') || '';
        document.getElementById('residencia_oculto').value = selected.getAttribute('data-residencia') || '';
        document.getElementById('complemento_oculto').value = ''; // Si no tienes el dato
    });
</script>


@endsection