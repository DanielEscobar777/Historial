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
                                <div class="col-md-6">
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
                        <textarea type="text" class="form-control" name="nombre_recien_necido">{{$historial->nombre_recien_necido}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label><b>Sexo</b></label>
                        <select class="form-control" name="sexo" required>
                            <option value="">Seleccione una opción</option>
                            <option value="M" {{ (old('sexo') ?? $historial->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ (old('sexo') ?? $historial->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label><b>Cama</b></label>
                        <textarea type="text" class="form-control" name="cama">{{$historial->cama}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label><b>Fecha de Nacimiento del RN</b></label>
                        <input type="date" class="form-control" name="fecha_recien_necido" value = "{{$historial->fecha_recien_necido}}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Hora de Nacimiento del RN</b></label>
                        <input type="time" class="form-control" name="hora_recien_necido" value = "{{$historial->hora_recien_necido}}">
                    </div>
                    <div class="col-md-6">
                        <label><b>Servicio</b></label>
                        <textarea type="text" class="form-control" disabled>{{$n_ser->nombre_servicio}}</textarea>
                        <input type="hidden" class="form-control" name="id_servicio" value="{{$n_ser->id_servicio}}">
                        <input type="hidden" class="form-control" name="nombre_servicio" value="{{$n_ser->nombre_servicio}}">
                    </div>
                    <div class="col-md-6">
                        <label><b>Referencia (Nombre y Teléfono)</b></label>
                        <textarea type="text" class="form-control" name="nombrenum_referencia">{{$historial->nombrenum_referencia}}</textarea>
                    </div>
                    @else

                    <div class="col-md-6">
                        <label><b>Paciente</b></label>
                        <textarea type="text" class="form-control" name="id_paciente" disabled>{{$paciente->nombres}} {{$paciente->p_apellido}} {{$paciente->s_apellido}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <textarea type="text" class="form-control" disabled>{{ $n_ser->nombre_servicio }}</textarea>
                        <input type="hidden" class="form-control" name="id_servicio" value="{{ $n_ser->id_servicio }}">
                        <input type="hidden" class="form-control" name="nombre_servicio" value="{{ $n_ser->nombre_servicio }}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Servicio</b></label>
                        <textarea type="text" class="form-control" disabled>{{$n_ser->nombre_servicio}}</textarea>
                        <input type="hidden" class="form-control" name="id_servicio" value="{{$n_ser->id_servicio}}">
                        <input type="hidden" class="form-control" name="nombre_servicio" value="{{$n_ser->nombre_servicio}}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Grado de Instrucción</b></label>
                        <textarea type="text" class="form-control" name="grado_instruccion" required>{{$historial->grado_instruccion}}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label><b>Religión</b></label>
                        <textarea type="text" class="form-control" name="religion"required>{{$historial->religion}}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label><b>Cama</b></label>
                        <textarea type="text" class="form-control" name="cama" required>{{$historial->cama}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label><b>Ocupacion</b></label>
                        <textarea type="text" class="form-control" name="ocupacion" required>{{$historial->ocupacion}}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label><b>Estado civil</b></label>
                        <textarea type="text" class="form-control" name="estado_civil" required>{{$historial->estado_civil}}</textarea>
                    </div>
                    <div class="col-md-6">
                        <label><b>Fuente de Información</b></label>
                        <textarea type="text" class="form-control" name="fuente_informacion" required>{{$historial->fuente_informacion}}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label><b>Referencia (Nombre y Teléfono)</b></label>
                        <textarea type="text" class="form-control" name="nombrenum_referencia" required>{{$historial->nombrenum_referencia}}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grado de Confiabilidad</b></label>
                        <textarea type="text" class="form-control" name="grado_confiabilidad" required>{{$historial->grado_confiabilidad}}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grupo Sanguíneo y Factor</b></label>
                        <textarea type="text" class="form-control" name="grupo_sanguineo_facto" required>{{$historial->grupo_sanguineo_facto}}</textarea>
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
                                            <textarea type="text" class="form-control" name="antecedentes_perinatologicos" required>{{$antecedentes_perinatologicos->antecedentes_perinatologicos}}</textarea>
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
                                            <textarea type="text" class="form-control" name="antecedentes_inmunizacion" required>{{$antecedentes_inmunizacion->antecedentes_inmunizacion}}</textarea>
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
                                            <textarea type="text" class="form-control" name="antecedentes_alimentarios" required>{{$antecedentes_alimentarios->antecedentes_alimentarios}}</textarea>
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
                                            <textarea type="text" class="form-control" name="antecedentes_familiares" required>{{$antecedentes_familiares->antecedentes_familiares}}</textarea>
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
                                            <textarea type="text" class="form-control" name="desarrollo_psicomotor" required>{{$desarrollo_psicomotor->desarrollo_psicomotor}}</textarea>
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
                                                <textarea type="text" class="form-control" name="padre" required>{{$antecedentes_heredofamiliares->padre}}</textarea>
                                            </div>
                                            @endif
                                            @if($antecedentes_heredofamiliares->madre <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Madre</b></label>
                                                    <textarea type="text" class="form-control" name="madre" required>{{$antecedentes_heredofamiliares->madre}}</textarea>
                                                </div>
                                                @endif
                                                @if($antecedentes_heredofamiliares->hermanos <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Hermano(s)</b></label>
                                                        <textarea type="text" class="form-control" name="hermanos" required>{{$antecedentes_heredofamiliares->hermanos}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($antecedentes_heredofamiliares->esposo <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Esposo</b></label>
                                                            <textarea type="text" class="form-control" name="esposo" required>{{$antecedentes_heredofamiliares->esposo}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($antecedentes_heredofamiliares->hijos <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Hijos</b></label>
                                                                <textarea type="text" class="form-control" name="hijos" required>{{$antecedentes_heredofamiliares->hijos}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($antecedentes_heredofamiliares->abuelos <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Abuelos</b></label>
                                                                    <textarea type="text" class="form-control" name="abuelos" required>{{$antecedentes_heredofamiliares->abuelos}}</textarea>
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
                                                <textarea type="text" class="form-control" name="clinicos" required>{{$antecedentes_patologicos->clinicos}}</textarea>
                                            </div>
                                            @endif
                                            @if($antecedentes_patologicos->quirurjicos <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Quirurjicos</b></label>
                                                    <textarea type="text" class="form-control" name="quirurjicos" required>{{$antecedentes_patologicos->quirurjicos}}</textarea>
                                                </div>
                                                @endif
                                                @if($antecedentes_patologicos->alergicos <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Alergias</b></label>
                                                        <textarea type="text" class="form-control" name="alergicos" required>{{$antecedentes_patologicos->alergicos}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($antecedentes_patologicos->otros <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Otros</b></label>
                                                            <textarea type="text" class="form-control" name="otros" required>{{$antecedentes_patologicos->otros}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($antecedentes_patologicos->internaciones <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Internaciones</b></label>
                                                                <textarea type="text" class="form-control" name="internaciones" required>{{$antecedentes_patologicos->internaciones}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($antecedentes_patologicos->cirugias <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Cirugias</b></label>
                                                                    <textarea type="text" class="form-control" name="cirugias" required>{{$antecedentes_patologicos->cirugias}}</textarea>
                                                                </div>
                                                                @endif
                                                                @if($antecedentes_patologicos->transfusion_de_sangre <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Transfusion de sangre</b></label>
                                                                        <textarea type="text" class="form-control" name="transfusion_de_sangre" required>{{$antecedentes_patologicos->transfusion_de_sangre}}</textarea>
                                                                    </div>
                                                                    @endif
                                                                    @if($antecedentes_patologicos->iras <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Iras</b></label>
                                                                            <textarea type="text" class="form-control" name="iras" required>{{$antecedentes_patologicos->iras}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($antecedentes_patologicos->gastroenteritis <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Gastroenteritis</b></label>
                                                                                <textarea type="text" class="form-control" name="gastroenteritis" required>{{$antecedentes_patologicos->gastroenteritis}}</textarea>
                                                                            </div>
                                                                            @endif
                                                                            @if($antecedentes_patologicos->traumatismos <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Traumatismos</b></label>
                                                                                    <textarea type="text" class="form-control" name="traumatismos" required>{{$antecedentes_patologicos->traumatismos}}</textarea>
                                                                                </div>
                                                                                @endif
                                                                                @if($antecedentes_patologicos->medicamentos <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Medicamentos</b></label>
                                                                                        <textarea type="text" class="form-control" name="medicamentos" required>{{$antecedentes_patologicos->medicamentos}}</textarea>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($antecedentes_patologicos->enfermedades <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Enfermedades</b></label>
                                                                                            <textarea type="text" class="form-control" name="enfermedades" required>{{$antecedentes_patologicos->enfermedades}}</textarea>
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
                                                <textarea type="text" class="form-control" name="vacunas" required>{{$antecedentes_no_patologicos->vacunas}}</textarea>
                                            </div>
                                            @endif
                                            @if($antecedentes_no_patologicos->vacunas_hpv <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Vacunas hpv</b></label>
                                                    <textarea type="text" class="form-control" name="vacunas_hpv" required>{{$antecedentes_no_patologicos->vacunas_hpv}}</textarea>
                                                </div>
                                                @endif
                                                @if($antecedentes_no_patologicos->habitos_toxicos <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Habitos toxicos</b></label>
                                                        <textarea type="text" class="form-control" name="habitos_toxicos" required>{{$antecedentes_no_patologicos->habitos_toxicos}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($antecedentes_no_patologicos->alimentacion <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Alimentacion</b></label>
                                                            <textarea type="text" class="form-control" name="alimentacion" required>{{$antecedentes_no_patologicos->alimentacion}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($antecedentes_no_patologicos->habito_miccional <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Habito miccional</b></label>
                                                                <textarea type="text" class="form-control" name="habito_miccional" required>{{$antecedentes_no_patologicos->habito_miccional}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($antecedentes_no_patologicos->habito_intestinal <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Habito intestinal</b></label>
                                                                    <textarea type="text" class="form-control" name="habito_intestinal" required>{{$antecedentes_no_patologicos->habito_intestinal}}</textarea>
                                                                </div>
                                                                @endif
                                                                @if($antecedentes_no_patologicos->vivienda_servicio_basico <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Vivienda servicio basico</b></label>
                                                                        <textarea type="text" class="form-control" name="vivienda_servicio_basico" required>{{$antecedentes_no_patologicos->vivienda_servicio_basico}}</textarea>
                                                                    </div>
                                                                    @endif
                                                                    @if($antecedentes_no_patologicos->habito_alcoholico <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Habito alcoholico</b></label>
                                                                            <textarea type="text" class="form-control" name="habito_alcoholico" required>{{$antecedentes_no_patologicos->habito_alcoholico}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($antecedentes_no_patologicos->habito_tabaquico <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Habito tabaquico</b></label>
                                                                                <textarea type="text" class="form-control" name="habito_tabaquico" required>{{$antecedentes_no_patologicos->habito_tabaquico}}</textarea>
                                                                            </div>
                                                                            @endif
                                                                            @if($antecedentes_no_patologicos->exposicion_biomasa <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Exposicion a biomasa</b></label>
                                                                                    <textarea type="text" class="form-control" name="exposicion_biomasa" required>{{$antecedentes_no_patologicos->exposicion_biomasa}}</textarea>
                                                                                </div>
                                                                                @endif
                                                                                @if($antecedentes_no_patologicos->contacto_con_tuberculosis <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Contacto con tuberculosis</b></label>
                                                                                        <textarea type="text" class="form-control" name="contacto_con_tuberculosis"  required>{{$antecedentes_no_patologicos->contacto_con_tuberculosis}}</textarea>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($antecedentes_no_patologicos->contacto_triatoma_infestans <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Contacto triatoma infestans</b></label>
                                                                                            <textarea type="text" class="form-control" name="contacto_triatoma_infestans"  required>{{$antecedentes_no_patologicos->contacto_triatoma_infestans}}</textarea>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($antecedentes_no_patologicos->toxicomanias_drogas <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Toxicomanias drogas</b></label>
                                                                                                <textarea type="text" class="form-control" name="toxicomanias_drogas"  required>{{$antecedentes_no_patologicos->toxicomanias_drogas}}</textarea>
                                                                                            </div>
                                                                                            @endif
                                                                                            @if($antecedentes_no_patologicos->inmunizaciones <> 'N/A')
                                                                                                <div class="col-md-12">
                                                                                                    <label><b>Inmunizaciones</b></label>
                                                                                                    <textarea type="text" class="form-control" name="inmunizaciones" required>{{$antecedentes_no_patologicos->inmunizaciones}}</textarea>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if($antecedentes_no_patologicos->antecedentes_sexuales <> 'N/A')
                                                                                                    <div class="col-md-12">
                                                                                                        <label><b>Antecedentes sexuales</b></label>
                                                                                                        <textarea type="text" class="form-control" name="antecedentes_sexuales" required>{{$antecedentes_no_patologicos->antecedentes_sexuales}}</textarea>
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
                                                <textarea type="text" class="form-control" name="fecha_ultima_menstruacion"  required>{{$Antecedentes_gineco_obsteticos->fecha_ultima_menstruacion}}</textarea>
                                            </div>
                                            @endif
                                            @if($Antecedentes_gineco_obsteticos->ritmo_menstrual <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Ritmo menstrual</b></label>
                                                    <textarea type="text" class="form-control" name="ritmo_menstrual" required>{{$Antecedentes_gineco_obsteticos->ritmo_menstrual}}</textarea>
                                                </div>
                                                @endif
                                                @if($Antecedentes_gineco_obsteticos->menopausia <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Menopausia</b></label>
                                                        <textarea type="text" class="form-control" name="menopausia"  required>{{$Antecedentes_gineco_obsteticos->menopausia}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($Antecedentes_gineco_obsteticos->gestaciones <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Gestaciones</b></label>
                                                            <textarea type="text" class="form-control" name="gestaciones"  required>{{$Antecedentes_gineco_obsteticos->gestaciones}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($Antecedentes_gineco_obsteticos->partos <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Partos</b></label>
                                                                <textarea type="text" class="form-control" name="partos" required>{{$Antecedentes_gineco_obsteticos->partos}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($Antecedentes_gineco_obsteticos->cesareas <> 'N/A') 
                                                                <div class="col-md-12">
                                                                    <label><b>Cesareas</b></label>
                                                                    <textarea type="text" class="form-control" name="cesareas" required>{{$Antecedentes_gineco_obsteticos->cesareas}}</textarea>
                                                                </div>
                                                                @endif
                                                                @if($Antecedentes_gineco_obsteticos->abortos <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Abortos</b></label>
                                                                        <textarea type="text" class="form-control" name="abortos" required>{{$Antecedentes_gineco_obsteticos->abortos}}</textarea>
                                                                    </div>
                                                                    @endif
                                                                    @if($Antecedentes_gineco_obsteticos->hijos_macrosomicos <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Hijos macrosomicos</b></label>
                                                                            <textarea type="text" class="form-control" name="hijos_macrosomicos"required>{{$Antecedentes_gineco_obsteticos->hijos_macrosomicos}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($Antecedentes_gineco_obsteticos->preeclampsia_eclampsia <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Preeclampsia eclampsia</b></label>
                                                                                <textarea type="text" class="form-control" name="preeclampsia_eclampsia" required>{{$Antecedentes_gineco_obsteticos->preeclampsia_eclampsia}}</textarea>
                                                                            </div>
                                                                            @endif
                                                                            @if($Antecedentes_gineco_obsteticos->anticonceptivos <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Anticonceptivos</b></label>
                                                                                    <textarea type="text" class="form-control" name="anticonceptivos" required>{{$Antecedentes_gineco_obsteticos->anticonceptivos}}</textarea>
                                                                                </div>
                                                                                @endif
                                                                                @if($Antecedentes_gineco_obsteticos->fecha_ultima_papanicolau <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Fecha ultima de papanicolau</b></label>
                                                                                        <textarea type="text" class="form-control" name="fecha_ultima_papanicolau" required>{{$Antecedentes_gineco_obsteticos->fecha_ultima_papanicolau}}</textarea>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($Antecedentes_gineco_obsteticos->fecha_ultima_mamografia <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Fecha ultima de mamografia</b></label>
                                                                                            <textarea type="text" class="form-control" name="fecha_ultima_mamografia" required>{{$Antecedentes_gineco_obsteticos->fecha_ultima_mamografia}}</textarea>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($Antecedentes_gineco_obsteticos->fecha_ultima_densitometria <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Fecha ultimo densitometria</b></label>
                                                                                                <textarea type="text" class="form-control" name="fecha_ultima_densitometria" required>{{$Antecedentes_gineco_obsteticos->fecha_ultima_densitometria}}</textarea>
                                                                                            </div>
                                                                                            @endif
                                                                                        @if($Antecedentes_gineco_obsteticos->fecha_ultimo_aborto <> 'N/A')
                                                                                                <div class="col-md-12">
                                                                                                    <label><b>Fecha ultimo aborto</b></label>
                                                                                                    <textarea type="text" class="form-control" name="fecha_ultimo_aborto" required>{{$Antecedentes_gineco_obsteticos->fecha_ultimo_aborto}}</textarea>
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
                                            <textarea type="text" class="form-control" name="cardiovascular_respiratorio" required>{{$anamnesis_sistema->cardiovascular_respiratorio}}</textarea>
                                        </div>
                                        @endif
                                        @if($anamnesis_sistema->gastro_intestinal <> 'N/A')
                                            <div class="col-md-12">
                                                <label><b>Gastro-intestinal</b></label>
                                                <textarea type="text" class="form-control" name="gastro_intestinal" required>{{$anamnesis_sistema->gastro_intestinal}}</textarea>
                                            </div>
                                            @endif
                                            @if($anamnesis_sistema->genito_urinario <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Genito-urinario</b></label>
                                                    <textarea type="text" class="form-control" name="genito_urinario" required>{{$anamnesis_sistema->genito_urinario}}</textarea>
                                                </div>
                                                @endif
                                                @if($anamnesis_sistema->hematologico <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Hematologico</b></label>
                                                        <textarea type="text" class="form-control" name="hematologico" required>{{$anamnesis_sistema->hematologico}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($anamnesis_sistema->dermatologico <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Dermatologico</b></label>
                                                            <textarea type="text" class="form-control" name="dermatologico"  required>{{$anamnesis_sistema->dermatologico}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($anamnesis_sistema->neurologico <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Neurologico</b></label>
                                                                <textarea type="text" class="form-control" name="neurologico" required>{{$anamnesis_sistema->neurologico}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($anamnesis_sistema->locomotor <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Locomotor</b></label>
                                                                    <textarea type="text" class="form-control" name="locomotor" required>{{$anamnesis_sistema->locomotor}}</textarea>
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
                                        <textarea type="text" class="form-control" name="motivo_de_internacion" required>{{$motivo_de_internacion->motivo_internacion}}</textarea>
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
                                        <textarea type="text" class="form-control" name="historia_de_enfermedad_actual" required>{{$historia_enfermedad_actual->historia_de_enfermedad_actual}}</textarea>
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
                                                <textarea type="text" class="form-control" name="examen_fisico_general" required>{{$examen_fisico_general->examen_fisico_general}}</textarea>
                                            </div>
                                            @endif
                                            @if($examen_fisico_general->estado_de_conciencia <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Estado de conciencia</b></label>
                                                    <textarea type="text" class="form-control" name="estado_de_conciencia"  required>{{$examen_fisico_general->estado_de_conciencia}}</textarea>
                                                </div>
                                                @endif
                                                @if($examen_fisico_general->color_piel_mucosa <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Color piel mucosa</b></label>
                                                        <textarea type="text" class="form-control" name="color_piel_mucosa" required>{{$examen_fisico_general->color_piel_mucosa}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($examen_fisico_general->constitucion <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Constitucion</b></label>
                                                            <textarea type="text" class="form-control" name="constitucion" required>{{$examen_fisico_general->constitucion}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($examen_fisico_general->marcha <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Marcha</b></label>
                                                                <textarea type="text" class="form-control" name="marcha" required>{{$examen_fisico_general->marcha}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($examen_fisico_general->posicion <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Posicion</b></label>
                                                                    <textarea type="text" class="form-control" name="posicion" required>{{$examen_fisico_general->posicion}}</textarea>
                                                                </div>
                                                                @endif
                                                                @if($examen_fisico_general->estado_hidratacion <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Estado hidratacion</b></label>
                                                                        <textarea type="text" class="form-control" name="estado_hidratacion" required>{{$examen_fisico_general->estado_hidratacion}}</textarea>
                                                                    </div>
                                                                    @endif

                                                                    @if($examen_fisico_general->biotipo <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Biotipo</b></label>
                                                                            <textarea type="text" class="form-control" name="biotipo"  required>{{$examen_fisico_general->biotipo}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_fisico_general->facies <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Facies</b></label>
                                                                                <textarea type="text" class="form-control" name="facies" required>{{$examen_fisico_general->facies}}</textarea>
                                                                            </div>
                                                                            @endif
                                                                            @if($examen_fisico_general->tension_arterial <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Tension arterial</b></label>
                                                                                    <textarea type="text" class="form-control" name="tension_arterial" required>{{$examen_fisico_general->tension_arterial}}</textarea>
                                                                                </div>
                                                                                @endif
                                                                                @if($examen_fisico_general->tension_arterial_media <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Tension arterial media</b></label>
                                                                                        <textarea type="text" class="form-control" name="tension_arterial_media" required>{{$examen_fisico_general->tension_arterial_media}}</textarea>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($examen_fisico_general->frecuencia_cardiaca <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Frecuencia cardiaca</b></label>
                                                                                            <textarea type="text" class="form-control" name="frecuencia_cardiaca" required>{{$examen_fisico_general->frecuencia_cardiaca}}</textarea>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($examen_fisico_general->temperatura <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Temperatura</b></label>

                                                                                                <textarea type="text" class="form-control" name="temperatura" required>{{$examen_fisico_general->temperatura}}</textarea>
                                                                                            </div>
                                                                                            @endif
                                                                                            @if($examen_fisico_general->peso <> 'N/A')
                                                                                                <div class="col-md-12">
                                                                                                    <label><b>Peso</b></label>
                                                                                                    <textarea type="text" class="form-control" name="peso" required>{{$examen_fisico_general->peso}}</textarea>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if($examen_fisico_general->talla <> 'N/A')
                                                                                                    <div class="col-md-12">
                                                                                                        <label><b>Talla</b></label>
                                                                                                        <textarea type="text" class="form-control" name="talla" required>{{$examen_fisico_general->talla}}</textarea>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    @if($examen_fisico_general->imc <> 'N/A')
                                                                                                        <div class="col-md-12">
                                                                                                            <label><b>IMC</b></label>
                                                                                                            <textarea type="text" class="form-control" name="imc" required>{{$examen_fisico_general->imc}}</textarea>
                                                                                                        </div>
                                                                                                        @endif
                                                                                                        @if($examen_fisico_general->spo2 <> 'N/A')
                                                                                                            <div class="col-md-12">
                                                                                                                <label><b>Sapo2</b></label>
                                                                                                                <textarea type="text" class="form-control" name="spo2" required>{{$examen_fisico_general->spo2}}</textarea>
                                                                                                            </div>
                                                                                                            @endif
                                                                                                            @if($examen_fisico_general->sato2 <> 'N/A')
                                                                                                                <div class="col-md-12">
                                                                                                                    <label><b>Sato2</b></label>
                                                                                                                    <textarea type="text" class="form-control" name="sato2" required>{{$examen_fisico_general->sato2}}</textarea>
                                                                                                                </div>
                                                                                                                @endif
                                                                                                                @if($examen_fisico_general->fio2 <> 'N/A')
                                                                                                                    <div class="col-md-12">
                                                                                                                        <label><b>Fio2</b></label>
                                                                                                                        <textarea type="text" class="form-control" name="fio2" required>{{$examen_fisico_general->fio2}}</textarea>
                                                                                                                    </div>
                                                                                                                    @endif
                                                                                                                    @if($examen_fisico_general->sc <> 'N/A')
                                                                                                                        <div class="col-md-12">
                                                                                                                            <label><b>SC</b></label>
                                                                                                                            <textarea type="text" class="form-control" name="sc" required>{{$examen_fisico_general->sc}}</textarea>
                                                                                                                        </div>
                                                                                                                        @endif
                                                                                                                        @if($examen_fisico_general->apgar <> 'N/A')
                                                                                                                            <div class="col-md-12">
                                                                                                                                <label><b>Apgar</b></label>
                                                                                                                                <textarea type="text" class="form-control" name="apgar" required>{{$examen_fisico_general->apgar}}</textarea>
                                                                                                                            </div>
                                                                                                                            @endif
                                                                                                                            @if($examen_fisico_general->silverman <> 'N/A')
                                                                                                                                <div class="col-md-12">
                                                                                                                                    <label><b>Silverman</b></label>
                                                                                                                                    <textarea type="text" class="form-control" name="silverman" required>{{$examen_fisico_general->silverman}}</textarea>
                                                                                                                                </div>
                                                                                                                                @endif
                                                                                                                                @if($examen_fisico_general->edad_por_capurro <> 'N/A')
                                                                                                                                    <div class="col-md-12">
                                                                                                                                        <label><b>Edad por capurro</b></label>
                                                                                                                                        <textarea type="text" class="form-control" name="edad_por_capurro" required>{{$examen_fisico_general->edad_por_capurro}}</textarea>
                                                                                                                                    </div>
                                                                                                                                    @endif
                                                                                                                                    @if($examen_fisico_general->pa <> 'N/A')
                                                                                                                                        <div class="col-md-12">
                                                                                                                                            <label><b>PA</b></label>
                                                                                                                                            <textarea type="text" class="form-control" name="pa" required>{{$examen_fisico_general->pa}}</textarea>
                                                                                                                                        </div>
                                                                                                                                        @endif
                                                                                                                                        @if($examen_fisico_general->somatometria <> 'N/A')
                                                                                                                                            <div class="col-md-12">
                                                                                                                                                <label><b>Somatometria</b></label>
                                                                                                                                                <textarea type="text" class="form-control" name="somatometria" required>{{$examen_fisico_general->somatometria}}</textarea>
                                                                                                                                            </div>
                                                                                                                                            @endif
                                                                                                                                            @if($examen_fisico_general->saturacion <> 'N/A')
                                                                                                                                                <div class="col-md-12">
                                                                                                                                                    <label><b>Saturacion</b></label>
                                                                                                                                                    <textarea type="text" class="form-control" name="saturacion"  required>{{$examen_fisico_general->saturacion}}</textarea>
                                                                                                                                                </div>
                                                                                                                                                @endif
                                                                                                                                                @if($examen_fisico_general->perimetro_cefalico <> 'N/A')
                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                        <label><b>Perimetro cefalico</b></label>
                                                                                                                                                        <textarea type="text" class="form-control" name="perimetro_cefalico" required>{{$examen_fisico_general->perimetro_cefalico}}</textarea>
                                                                                                                                                    </div>
                                                                                                                                                    @endif
                                                                                                                                                    @if($examen_fisico_general->perimetro_toracico <> 'N/A')
                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                            <label><b>Perimetro toracico</b></label>
                                                                                                                                                            <textarea type="text" class="form-control" name="perimetro_toracico" required>{{$examen_fisico_general->perimetro_toracico}}</textarea>
                                                                                                                                                        </div>
                                                                                                                                                        @endif
                                                                                                                                                        @if($examen_fisico_general->perimetro_abdominal <> 'N/A')
                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                <label><b>Perimetro abdominal</b></label>
                                                                                                                                                                <textarea type="text" class="form-control" name="perimetro_abdominal" required>{{$examen_fisico_general->perimetro_abdominal}}</textarea>
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
                                                <textarea type="text" class="form-control" name="cabeza" required>{{$examen_fisico_segmentado->cabeza}}</textarea>
                                            </div>
                                            @endif
                                            @if($examen_fisico_segmentado->frontales <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Frontales</b></label>
                                                    <textarea type="text" class="form-control" name="frontales" required>{{$examen_fisico_segmentado->frontales}}</textarea>
                                                </div>
                                                @endif
                                                @if($examen_fisico_segmentado->cabellos <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Cabellos</b></label>
                                                        <textarea type="text" class="form-control" name="cabellos" required>{{$examen_fisico_segmentado->cabellos}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($examen_fisico_segmentado->cara <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Cara</b></label>
                                                            <textarea type="text" class="form-control" name="cara" required>{{$examen_fisico_segmentado->cara}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($examen_fisico_segmentado->apertura_ocular <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Apertura ocular</b></label>
                                                                <textarea type="text" class="form-control" name="apertura_ocular" required>{{$examen_fisico_segmentado->apertura_ocular}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($examen_fisico_segmentado->ojos <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Ojos</b></label>
                                                                    <textarea type="text" class="form-control" name="ojos" required>{{$examen_fisico_segmentado->ojos}}</textarea>
                                                                </div>
                                                                @endif
                                                                @if($examen_fisico_segmentado->nariz <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Nariz</b></label>
                                                                        <textarea type="text" class="form-control" name="nariz" required>{{$examen_fisico_segmentado->nariz}}</textarea>
                                                                    </div>
                                                                    @endif
                                                                    @if($examen_fisico_segmentado->fosas_nasales <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Fosas nasales</b></label>
                                                                            <textarea type="text" class="form-control" name="fosas_nasales" required>{{$examen_fisico_segmentado->fosas_nasales}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_fisico_segmentado->piramide_nasal <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Piramide nasal</b></label>
                                                                                <textarea type="text" class="form-control" name="piramide_nasal" required>{{$examen_fisico_segmentado->piramide_nasal}}</textarea>
                                                                            </div>
                                                                            @endif
                                                                            @if($examen_fisico_segmentado->coanas <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Coanas</b></label>
                                                                                    <textarea type="text" class="form-control" name="coanas" required>{{$examen_fisico_segmentado->coanas}}</textarea>
                                                                                </div>
                                                                                @endif
                                                                                @if($examen_fisico_segmentado->pabellon_auricular <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Pabellon auricular</b></label>
                                                                                        <textarea type="text" class="form-control" name="pabellon_auricular" required>{{$examen_fisico_segmentado->pabellon_auricular}}</textarea>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($examen_fisico_segmentado->curvatura <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Curvatura</b></label>
                                                                                            <textarea type="text" class="form-control" name="curvatura" required>{{$examen_fisico_segmentado->curvatura}}</textarea>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($examen_fisico_segmentado->boca <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Boca</b></label>
                                                                                                <textarea type="text" class="form-control" name="boca" required>{{$examen_fisico_segmentado->boca}}</textarea>
                                                                                            </div>
                                                                                            @endif
                                                                                            @if($examen_fisico_segmentado->apertura_bucal <> 'N/A')
                                                                                                <div class="col-md-12">
                                                                                                    <label><b>Apertura bucal</b></label>
                                                                                                    <textarea type="text" class="form-control" name="apertura_bucal" required>{{$examen_fisico_segmentado->apertura_bucal}}</textarea>
                                                                                                </div>
                                                                                                @endif
                                                                                                @if($examen_fisico_segmentado->paladar <> 'N/A')
                                                                                                    <div class="col-md-12">
                                                                                                        <label><b>Paladar</b></label>
                                                                                                        <textarea type="text" class="form-control" name="paladar" required>{{$examen_fisico_segmentado->paladar}}</textarea>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    @if($examen_fisico_segmentado->mucosa_oral <> 'N/A')
                                                                                                        <div class="col-md-12">
                                                                                                            <label><b>Mucosa oral</b></label>
                                                                                                            <textarea type="text" class="form-control" name="mucosa_oral" required>{{$examen_fisico_segmentado->mucosa_oral}}</textarea>
                                                                                                        </div>
                                                                                                        @endif
                                                                                                        @if($examen_fisico_segmentado->pulmones <> 'N/A')
                                                                                                            <div class="col-md-12">
                                                                                                                <label><b>Pulmones</b></label>
                                                                                                                <textarea type="text" class="form-control" name="pulmones" required>{{$examen_fisico_segmentado->pulmones}}</textarea>
                                                                                                            </div>
                                                                                                            @endif
                                                                                                            @if($examen_fisico_segmentado->pulmones_inspeccion <> 'N/A')
                                                                                                                <div class="col-md-12">
                                                                                                                    <label><b>Pulmones inspeccion</b></label>
                                                                                                                    <textarea type="text" class="form-control" name="pulmones_inspeccion" required>{{$examen_fisico_segmentado->pulmones_inspeccion}}</textarea>
                                                                                                                </div>
                                                                                                                @endif
                                                                                                                @if($examen_fisico_segmentado->pulmones_palpacion <> 'N/A')
                                                                                                                    <div class="col-md-12">
                                                                                                                        <label><b>Pulmones palpacion</b></label>
                                                                                                                        <textarea type="text" class="form-control" name="pulmones_palpacion" required>{{$examen_fisico_segmentado->pulmones_palpacion}}</textarea>
                                                                                                                    </div>
                                                                                                                    @endif
                                                                                                                    @if($examen_fisico_segmentado->pulmones_percusion <> 'N/A')
                                                                                                                        <div class="col-md-12">
                                                                                                                            <label><b>Pulmones percusion</b></label>
                                                                                                                            <textarea type="text" class="form-control" name="pulmones_percusion" required>{{$examen_fisico_segmentado->pulmones_percusion}}</textarea>
                                                                                                                        </div>
                                                                                                                        @endif
                                                                                                                        @if($examen_fisico_segmentado->pulmones_auscultacion <> 'N/A')
                                                                                                                            <div class="col-md-12">
                                                                                                                                <label><b>Pulmones auscultacion</b></label>
                                                                                                                                <textarea type="text" class="form-control" name="pulmones_auscultacion" required>{{$examen_fisico_segmentado->pulmones_auscultacion}}</textarea>
                                                                                                                            </div>
                                                                                                                            @endif
                                                                                                                            @if($examen_fisico_segmentado->corazon <> 'N/A')
                                                                                                                                <div class="col-md-12">
                                                                                                                                    <label><b>Corazon</b></label>
                                                                                                                                    <textarea type="text" class="form-control" name="corazon" required>{{$examen_fisico_segmentado->corazon}}</textarea>
                                                                                                                                </div>
                                                                                                                                @endif
                                                                                                                                @if($examen_fisico_segmentado->corazon_inspeccion <> 'N/A')
                                                                                                                                    <div class="col-md-12">
                                                                                                                                        <label><b>Corazon inspeccion</b></label>
                                                                                                                                        <textarea type="text" class="form-control" name="corazon_inspeccion" required>{{$examen_fisico_segmentado->corazon_inspeccion}}</textarea>
                                                                                                                                    </div>
                                                                                                                                    @endif
                                                                                                                                    @if($examen_fisico_segmentado->corazon_palpacion <> 'N/A')
                                                                                                                                        <div class="col-md-12">
                                                                                                                                            <label><b>Corazon palpacion</b></label>
                                                                                                                                            <textarea type="text" class="form-control" name="corazon_palpacion" required>{{$examen_fisico_segmentado->corazon_palpacion}}</textarea>
                                                                                                                                        </div>
                                                                                                                                        @endif
                                                                                                                                        @if($examen_fisico_segmentado->corazon_percusion <> 'N/A')
                                                                                                                                            <div class="col-md-12">
                                                                                                                                                <label><b>Corazon percusion</b></label>
                                                                                                                                                <textarea type="text" class="form-control" name="corazon_percusion" required>{{$examen_fisico_segmentado->corazon_percusion}}</textarea>
                                                                                                                                            </div>
                                                                                                                                            @endif
                                                                                                                                            @if($examen_fisico_segmentado->corazon_auscultacion <> 'N/A')
                                                                                                                                                <div class="col-md-12">
                                                                                                                                                    <label><b>Corazon auscultacion</b></label>
                                                                                                                                                    <textarea type="text" class="form-control" name="corazon_auscultacion" required>{{$examen_fisico_segmentado->corazon_auscultacion}}</textarea>
                                                                                                                                                </div>
                                                                                                                                                @endif
                                                                                                                                                @if($examen_fisico_segmentado->abdomen <> 'N/A')
                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                        <label><b>Abdomen</b></label>
                                                                                                                                                        <textarea type="text" class="form-control" name="abdomen" required>{{$examen_fisico_segmentado->abdomen}}</textarea>
                                                                                                                                                    </div>
                                                                                                                                                    @endif
                                                                                                                                                    @if($examen_fisico_segmentado->abdomen_inspeccion <> 'N/A')
                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                            <label><b>Abdomen inspeccion</b></label>
                                                                                                                                                            <textarea type="text" class="form-control" name="abdomen_inspeccion" required>{{$examen_fisico_segmentado->abdomen_inspeccion}}</textarea>
                                                                                                                                                        </div>
                                                                                                                                                        @endif
                                                                                                                                                        @if($examen_fisico_segmentado->abdomen_palpacion <> 'N/A')
                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                <label><b>Abdomen palpacion</b></label>
                                                                                                                                                                <textarea type="text" class="form-control" name="abdomen_palpacion" required>{{$examen_fisico_segmentado->abdomen_palpacion}}</textarea>
                                                                                                                                                            </div>
                                                                                                                                                            @endif
                                                                                                                                                            @if($examen_fisico_segmentado->abdomen_percusion <> 'N/A')
                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                    <label><b>Abdomen percusion</b></label>
                                                                                                                                                                    <textarea type="text" class="form-control" name="abdomen_percusion" required>{{$examen_fisico_segmentado->abdomen_percusion}}</textarea>
                                                                                                                                                                </div>
                                                                                                                                                                @endif
                                                                                                                                                                @if($examen_fisico_segmentado->precordio <> 'N/A')
                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                        <label><b>Precordio</b></label>
                                                                                                                                                                        <textarea type="text" class="form-control" name="precordio" required>{{$examen_fisico_segmentado->precordio}}</textarea>
                                                                                                                                                                    </div>
                                                                                                                                                                    @endif
                                                                                                                                                                    @if($examen_fisico_segmentado->cordon_umbilical <> 'N/A')
                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                            <label><b>Cordon umbilical</b></label>
                                                                                                                                                                            <textarea type="text" class="form-control" name="cordon_umbilical" required>{{$examen_fisico_segmentado->cordon_umbilical}}</textarea>
                                                                                                                                                                        </div>
                                                                                                                                                                        @endif
                                                                                                                                                                        @if($examen_fisico_segmentado->relacion_arteriovenosa <> 'N/A')
                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                <label><b>Relacion arteriovenosa</b></label>
                                                                                                                                                                                <textarea type="text" class="form-control" name="relacion_arteriovenosa" required>{{$examen_fisico_segmentado->relacion_arteriovenosa}}</textarea>
                                                                                                                                                                            </div>
                                                                                                                                                                            @endif
                                                                                                                                                                            @if($examen_fisico_segmentado->genitales_acuerdo_sexo_edad <> 'N/A')
                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                    <label><b>Genitales de acuerdo a sexo y edad</b></label>
                                                                                                                                                                                    <textarea type="text" class="form-control" name="genitales_acuerdo_sexo_edad" required>{{$examen_fisico_segmentado->genitales_acuerdo_sexo_edad}}</textarea>
                                                                                                                                                                                </div>
                                                                                                                                                                                @endif
                                                                                                                                                                                @if($examen_fisico_segmentado->pies <> 'N/A')
                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                        <label><b>Pies</b></label>
                                                                                                                                                                                        <textarea type="text" class="form-control" name="pies" required>{{$examen_fisico_segmentado->pies}}</textarea>
                                                                                                                                                                                    </div>
                                                                                                                                                                                    @endif
                                                                                                                                                                                    @if($examen_fisico_segmentado->surcos_plantales <> 'N/A')
                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                            <label><b>Surcos plantales</b></label>
                                                                                                                                                                                            <textarea type="text" class="form-control" name="surcos_plantales" required>{{$examen_fisico_segmentado->surcos_plantales}}</textarea>
                                                                                                                                                                                        </div>
                                                                                                                                                                                        @endif
                                                                                                                                                                                        @if($examen_fisico_segmentado->reflejos_succion <> 'N/A')
                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                <label><b>Reflejos succion</b></label>
                                                                                                                                                                                                <textarea type="text" class="form-control" name="reflejos_succion" required>{{$examen_fisico_segmentado->reflejos_succion}}</textarea>
                                                                                                                                                                                            </div>
                                                                                                                                                                                            @endif
                                                                                                                                                                                            @if($examen_fisico_segmentado->genitourinarios <> 'N/A')
                                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                                    <label><b>Genitourinarios</b></label>
                                                                                                                                                                                                    <textarea type="text" class="form-control" name="genitourinarios" required>{{$examen_fisico_segmentado->genitourinarios}}</textarea>
                                                                                                                                                                                                </div>
                                                                                                                                                                                                @endif
                                                                                                                                                                                                @if($examen_fisico_segmentado->extremidades <> 'N/A')
                                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                                        <label><b>Extremidades</b></label>
                                                                                                                                                                                                        <textarea type="text" class="form-control" name="extremidades" required>{{$examen_fisico_segmentado->extremidades}}</textarea>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                    @endif
                                                                                                                                                                                                    @if($examen_fisico_segmentado->neurologico <> 'N/A')
                                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                                            <label><b>Neurologicos</b></label>
                                                                                                                                                                                                            <textarea type="text" class="form-control" name="neurologico" required>{{$examen_fisico_segmentado->neurologico}}</textarea>
                                                                                                                                                                                                        </div>
                                                                                                                                                                                                        @endif
                                                                                                                                                                                                        @if($examen_fisico_segmentado->craneo <> 'N/A')
                                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                                <label><b>Craneo</b></label>
                                                                                                                                                                                                                <textarea type="text" class="form-control" name="craneo" required>{{$examen_fisico_segmentado->craneo}}</textarea>
                                                                                                                                                                                                            </div>
                                                                                                                                                                                                            @endif
                                                                                                                                                                                                            @if($examen_fisico_segmentado->cavidad_bucal <> 'N/A')
                                                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                                                    <label><b>Cavidad bucal</b></label>
                                                                                                                                                                                                                    <textarea type="text" class="form-control" name="cavidad_bucal" required>{{$examen_fisico_segmentado->cavidad_bucal}}</textarea>
                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                @if($examen_fisico_segmentado->cuello <> 'N/A')
                                                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                                                        <label><b>Cuello</b></label>
                                                                                                                                                                                                                        <textarea type="text" class="form-control" name="cuello" required>{{$examen_fisico_segmentado->cuello}}</textarea>
                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                    @if($examen_fisico_segmentado->cuello_inspeccion <> 'N/A')
                                                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                                                            <label><b>Cuello inspeccion</b></label>
                                                                                                                                                                                                                            <textarea type="text" class="form-control" name="cuello_inspeccion" required>{{$examen_fisico_segmentado->cuello_inspeccion}}</textarea>
                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                        @if($examen_fisico_segmentado->cuello_palpacion <> 'N/A')
                                                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                                                <label><b>Cuello palpacion</b></label>
                                                                                                                                                                                                                                <textarea type="text" class="form-control" name="cuello_palpacion" required>{{$examen_fisico_segmentado->cuello_palpacion}}</textarea>
                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                            @if($examen_fisico_segmentado->cuello_auscultacion <> 'N/A')
                                                                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                                                                    <label><b>Cuello auscultacion</b></label>
                                                                                                                                                                                                                                    <textarea type="text" class="form-control" name="cuello_auscultacion" required>{{$examen_fisico_segmentado->cuello_auscultacion}}</textarea>
                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                @if($examen_fisico_segmentado->torax <> 'N/A')
                                                                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                                                                        <label><b>Torax</b></label>
                                                                                                                                                                                                                                        <textarea type="text" class="form-control" name="torax" required>{{$examen_fisico_segmentado->torax}}</textarea>
                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                    @endif

                                                                                                                                                                                                                                    @if($examen_fisico_segmentado->torax_inspeccion_estatico <> 'N/A')
                                                                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                                                                            <label><b>Torax inspeccion estatico</b></label>
                                                                                                                                                                                                                                            <textarea type="text" class="form-control" name="torax_inspeccion_estatico" required>{{$examen_fisico_segmentado->torax_inspeccion_estatico}}</textarea>
                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                        @if($examen_fisico_segmentado->torax_inspeccion_dinamico <> 'N/A')
                                                                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                                                                <label><b>Torax inspeccion dinamico</b></label>
                                                                                                                                                                                                                                                <textarea type="text" class="form-control" name="torax_inspeccion_dinamico" required>{{$examen_fisico_segmentado->torax_inspeccion_dinamico}}</textarea>
                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                            @endif
                                                                                                                                                                                                                                            @if($examen_fisico_segmentado->torax_palpacion <> 'N/A')
                                                                                                                                                                                                                                                <div class="col-md-12">
                                                                                                                                                                                                                                                    <label><b>Torax palpacion</b></label>
                                                                                                                                                                                                                                                    <textarea type="text" class="form-control" name="torax_palpacion" required>{{$examen_fisico_segmentado->torax_palpacion}}</textarea>
                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                @endif
                                                                                                                                                                                                                                                @if($examen_fisico_segmentado->torax_percusion <> 'N/A')
                                                                                                                                                                                                                                                    <div class="col-md-12">
                                                                                                                                                                                                                                                        <label><b>Torax percusion</b></label>
                                                                                                                                                                                                                                                        <textarea type="text" class="form-control" name="torax_percusion" required>{{$examen_fisico_segmentado->torax_percusion}}</textarea>
                                                                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                    @endif
                                                                                                                                                                                                                                                    @if($examen_fisico_segmentado->torax_auscultacion <> 'N/A')
                                                                                                                                                                                                                                                        <div class="col-md-12">
                                                                                                                                                                                                                                                            <label><b>Torax auscultacion</b></label>
                                                                                                                                                                                                                                                            <textarea type="text" class="form-control" name="torax_auscultacion" required>{{$examen_fisico_segmentado->torax_auscultacion}}</textarea>
                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                        @endif
                                                                                                                                                                                                                                                        @if($examen_fisico_segmentado->mamas <> 'N/A')
                                                                                                                                                                                                                                                            <div class="col-md-12">
                                                                                                                                                                                                                                                                <label><b>Mamas </b></label>
                                                                                                                                                                                                                                                                <textarea type="text" class="form-control" name="mamas" required>{{$examen_fisico_segmentado->mamas}}</textarea>
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
                                                <textarea type="text" class="form-control" name="genitales" required>{{$examen_obstetrico->genitales}}</textarea>
                                            </div>
                                            @endif
                                            @if($examen_obstetrico->flujos <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Flujos</b></label>
                                                    <textarea type="text" class="form-control" name="flujos" required>{{$examen_obstetrico->flujos}}</textarea>
                                                </div>
                                                @endif
                                                @if($examen_obstetrico->afu <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>AFU</b></label>
                                                        <textarea type="text" class="form-control" name="afu" required>{{$examen_obstetrico->afu}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($examen_obstetrico->situacion <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Situacion</b></label>
                                                            <textarea type="text" class="form-control" name="situacion" required>{{$examen_obstetrico->situacion}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($examen_obstetrico->posicion <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Posicion</b></label>
                                                                <textarea type="text" class="form-control" name="posicion" required>{{$examen_obstetrico->posicion}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($examen_obstetrico->tacto_vaginal <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Tacto vaginal</b></label>
                                                                    <textarea type="text" class="form-control" name="tacto_vaginal" required>{{$examen_obstetrico->tacto_vaginal}}</textarea>
                                                                </div>
                                                                @endif

                                                                @if($examen_obstetrico->fcf <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>FCF</b></label>
                                                                        <textarea type="text" class="form-control" name="fcf" required>{{$examen_obstetrico->fcf}}</textarea>
                                                                    </div>
                                                                    @endif
                                                                    @if($examen_obstetrico->presentacion <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Presentacion</b></label>
                                                                            <textarea type="text" class="form-control" name="presentacion" required>{{$examen_obstetrico->presentacion}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_obstetrico->movimientos_fetales <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Movimientos fetales </b></label>
                                                                                <textarea type="text" class="form-control" name="movimientos_fetales" required>{{$examen_obstetrico->movimientos_fetales}}</textarea>
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
                                                <textarea type="text" class="form-control" name="vello_pubiano" required>{{$examen_ginecologico->vello_pubiano}}</textarea>
                                            </div>
                                            @endif
                                            @if($examen_ginecologico->vulva <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Vulva</b></label>
                                                    <textarea type="text" class="form-control" name="vulva" required>{{$examen_ginecologico->vulva}}</textarea>
                                                </div>
                                                @endif
                                                @if($examen_ginecologico->uretra <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Uretra</b></label>
                                                        <textarea type="text" class="form-control" name="uretra" required>{{$examen_ginecologico->uretra}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($examen_ginecologico->glandulas_bys <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Glandulas ByS</b></label>
                                                            <textarea type="text" class="form-control" name="glandulas_bys" required>{{$examen_ginecologico->glandulas_bys}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($examen_ginecologico->clitoris <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Clitoris</b></label>
                                                                <textarea type="text" class="form-control" name="clitoris" required>{{$examen_ginecologico->clitoris}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($examen_ginecologico->perineo <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Perineo</b></label>
                                                                    <textarea type="text" class="form-control" name="perineo" required>{{$examen_ginecologico->perineo}}</textarea>
                                                                </div>
                                                                @endif

                                                                @if($examen_ginecologico->vagina <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Vagina</b></label>
                                                                        <textarea type="text" class="form-control" name="vagina" required>{{$examen_ginecologico->vagina}}</textarea>
                                                                    </div>
                                                                    @endif
                                                                    @if($examen_ginecologico->cuello_uterino <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Cuello uterino</b></label>
                                                                            <textarea type="text" class="form-control" name="cuello_uterino" required>{{$examen_ginecologico->cuello_uterino}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_ginecologico->cuerpo_uterino <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Cuerpo uterino</b></label>
                                                                                <textarea type="text" class="form-control" name="cuerpo_uterino" required>{{$examen_ginecologico->cuerpo_uterino}}</textarea>
                                                                            </div>
                                                                            @endif
                                                                            @if($examen_ginecologico->anexos <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Anexos</b></label>
                                                                                    <textarea type="text" class="form-control" name="anexos" required>{{$examen_ginecologico->anexos}}</textarea>
                                                                                </div>
                                                                                @endif


                                                                                @if($examen_ginecologico->especuloscopia <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Especuloscopia </b></label>
                                                                                        <textarea type="text" class="form-control" name="especuloscopia" required>{{$examen_ginecologico->especuloscopia}}</textarea>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($examen_ginecologico->tacto_rectal <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Tacto rectal</b></label>
                                                                                            <textarea type="text" class="form-control" name="tacto_rectal" required>{{$examen_ginecologico->tacto_rectal}}</textarea>
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
                                                <textarea type="text" class="form-control" name="cardiovascular_palpacion" required>{{$examen_cardiovascular->cardiovascular_palpacion}}</textarea>
                                            </div>
                                            @endif
                                            @if($examen_cardiovascular->cardiovascular_percusion <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Cardiovascular percusion</b></label>
                                                    <textarea type="text" class="form-control" name="cardiovascular_percusion" required>{{$examen_cardiovascular->cardiovascular_percusion}}</textarea>
                                                </div>
                                                @endif
                                                @if($examen_cardiovascular->cardiovascular_auscultacion <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Cardiovascular auscultacion</b></label>
                                                        <textarea type="text" class="form-control" name="cardiovascular_auscultacion" required>{{$examen_cardiovascular->cardiovascular_auscultacion}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($examen_cardiovascular->cardiovascular_agregados <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Cardiovascular agregados</b></label>
                                                            <textarea type="text" class="form-control" name="cardiovascular_agregados" required>{{$examen_cardiovascular->cardiovascular_agregados}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($examen_cardiovascular->cardiovascular_soplos <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Cardiovascular soplos </b></label>
                                                                <textarea type="text" class="form-control" name="cardiovascular_soplos" required>{{$examen_cardiovascular->cardiovascular_soplos}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($examen_cardiovascular->cardiovascular_fremito <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Cardiovascular fremito</b></label>
                                                                    <textarea type="text" class="form-control" name="cardiovascular_fremito" required>{{$examen_cardiovascular->cardiovascular_fremito}}</textarea>
                                                                </div>
                                                                @endif
                                                                @if($examen_cardiovascular->pulsos_perifericos <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Pulsos perifericos</b></label>
                                                                        <textarea type="text" class="form-control" name="pulsos_perifericos" required>{{$examen_cardiovascular->pulsos_perifericos}}</textarea>
                                                                    </div>
                                                                    @endif

                                                                    @if($examen_cardiovascular->branquial <> 'N/A')
                                                                        <div class="col-md-12">
                                                                            <label><b>Branquial</b></label>
                                                                            <textarea type="text" class="form-control" name="branquial" required>{{$examen_cardiovascular->branquial}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($examen_cardiovascular->femoral <> 'N/A')
                                                                            <div class="col-md-12">
                                                                                <label><b>Femoral</b></label>
                                                                                <textarea type="text" class="form-control" name="femoral" required>{{$examen_cardiovascular->femoral}}</textarea>
                                                                            </div>
                                                                            @endif
                                                                            @if($examen_cardiovascular->tibia <> 'N/A')
                                                                                <div class="col-md-12">
                                                                                    <label><b>Tibia</b></label>
                                                                                    <textarea type="text" class="form-control" name="tibia" required>{{$examen_cardiovascular->tibia}}</textarea>
                                                                                </div>
                                                                                @endif
                                                                                @if($examen_cardiovascular->radial <> 'N/A')
                                                                                    <div class="col-md-12">
                                                                                        <label><b>Radial</b></label>
                                                                                        <textarea type="text" class="form-control" name="radial" required>{{$examen_cardiovascular->radial}}</textarea>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($examen_cardiovascular->popliteo <> 'N/A')
                                                                                        <div class="col-md-12">
                                                                                            <label><b>Popliteo </b></label>
                                                                                            <textarea type="text" class="form-control" name="popliteo" required>{{$examen_cardiovascular->popliteo}}</textarea>
                                                                                        </div>
                                                                                        @endif
                                                                                        @if($examen_cardiovascular->pedio <> 'N/A')
                                                                                            <div class="col-md-12">
                                                                                                <label><b>Pedio</b></label>
                                                                                                <textarea type="text" class="form-control" name="pedio" required>{{$examen_cardiovascular->pedio}}</textarea>
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
                                                <textarea type="text" class="form-control" name="punio_percusion_renal" required>{{$examen_genito_urinario->punio_percusion_renal}}</textarea>
                                            </div>
                                            @endif
                                            @if($examen_genito_urinario->palpacion_renal <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Palpacion renal</b></label>
                                                    <textarea type="text" class="form-control" name="palpacion_renal" required>{{$examen_genito_urinario->palpacion_renal}}</textarea>
                                                </div>
                                                @endif
                                                @if($examen_genito_urinario->puntos_ureterales <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Puntos ureterales</b></label>
                                                        <textarea type="text" class="form-control" name="puntos_ureterales" required>{{$examen_genito_urinario->puntos_ureterales}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($examen_genito_urinario->genitales <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Genitales</b></label>
                                                            <textarea type="text" class="form-control" name="genitales" required>{{$examen_genito_urinario->genitales}}</textarea>
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
                                                <textarea type="text" class="form-control" name="s_simetria" required>{{$examen_extremidades_superiores->s_simetria}}</textarea>
                                            </div>
                                            @endif
                                            @if($examen_extremidades_superiores->s_deformidades <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Deformidades </b></label>
                                                    <textarea type="text" class="form-control" name="s_deformidades" required>{{$examen_extremidades_superiores->s_deformidades}}</textarea>
                                                </div>
                                                @endif
                                                @if($examen_extremidades_superiores->s_articulaciones <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Articulaciones</b></label>
                                                        <textarea type="text" class="form-control" name="s_articulaciones" required>{{$examen_extremidades_superiores->s_articulaciones}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($examen_extremidades_superiores->s_piel <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Piel</b></label>
                                                            <textarea type="text" class="form-control" name="s_piel" required>{{$examen_extremidades_superiores->s_piel}}</textarea>
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
                                                <textarea type="text" class="form-control" name="i_simetria" required>{{$examen_extremidades_inferiores->i_simetria}}</textarea>
                                            </div>
                                            @endif
                                            @if($examen_extremidades_inferiores->i_deformidades <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Deformidades </b></label>
                                                    <textarea type="text" class="form-control" name="i_deformidades" required>{{$examen_extremidades_inferiores->i_deformidades}}</textarea>
                                                </div>
                                                @endif
                                                @if($examen_extremidades_inferiores->i_articulaciones <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Deformidades </b></label>
                                                        <textarea type="text" class="form-control" name="i_articulaciones" required>{{$examen_extremidades_inferiores->i_articulaciones}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($examen_extremidades_inferiores->i_piel <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Piel</b></label>
                                                            <textarea type="text" class="form-control" name="i_piel" required>{{$examen_extremidades_inferiores->i_piel}}</textarea>
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
                                                <textarea type="text" class="form-control" name="piel" required>{{$dermatologia->piel}}</textarea>
                                            </div>
                                            @endif
                                            @if($dermatologia->pelo <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Pelo </b></label>
                                                    <textarea type="text" class="form-control" name="pelo" required>{{$dermatologia->pelo}}</textarea>
                                                </div>
                                                @endif
                                                @if($dermatologia->unias <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Uñas </b></label>
                                                        <textarea type="text" class="form-control" name="unias" required>{{$dermatologia->unias}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($dermatologia->mucosas <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Mucosas</b></label>
                                                            <textarea type="text" class="form-control" name="mucosas" required>{{$dermatologia->mucosas}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($dermatologia->topografia <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Topografia</b></label>
                                                                <textarea type="text" class="form-control" name="topografia" required>{{$dermatologia->topografia}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($dermatologia->iconografia <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Iconografia</b></label>
                                                                    <textarea type="text" class="form-control" name="iconografia" required>{{$dermatologia->iconografia}}</textarea>
                                                                </div>
                                                                @endif
                                                                @if($dermatologia->morfologia <> 'N/A')
                                                                    <div class="col-md-12">
                                                                        <label><b>Morfologia</b></label>
                                                                        <textarea type="text" class="form-control" name="morfologia" required>{{$dermatologia->morfologia}}</textarea>
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
                                            <textarea type="text" class="form-control" name="ganglios_linfaticos" required>{{$ganglios_linfaticos->ganglios_linfaticos}}</textarea>
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
                                                <textarea type="text" class="form-control" name="conciencia" required>{{$sistema_nervioso->conciencia}}</textarea>
                                            </div>
                                            @endif
                                            @if($sistema_nervioso->piel <> 'N/A')
                                                <div class="col-12 col-md-6">
                                                    <label><b>GNOSIA</b></label>
                                                    <textarea type="text" class="form-control" name="gnosia" required>{{$sistema_nervioso->gnosia}}</textarea>
                                                </div>
                                                @endif
                                                @if($sistema_nervioso->piel <> 'N/A')
                                                    <div class="col-12 col-md-6">
                                                        <label><b>PRAXIA</b></label>
                                                        <textarea type="text" class="form-control" name="praxia" required>{{$sistema_nervioso->praxia}}</textarea>
                                                    </div>
                                                    @endif
                                                    @if($sistema_nervioso->piel <> 'N/A')
                                                        <div class="col-12 col-md-6">
                                                            <label><b>LENGUAJE</b></label>
                                                            <textarea type="text" class="form-control" name="lenguaje" required>{{$sistema_nervioso->lenguaje}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($sistema_nervioso->piel <> 'N/A')
                                                            <div class="col-12 col-md-6">
                                                                <label><b>MEMORIA</b></label>
                                                                <textarea type="text" class="form-control" name="memoria" required>{{$sistema_nervioso->memoria}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($sistema_nervioso->piel <> 'N/A')
                                                                <div class="col-12 col-md-6">
                                                                    <label><b>CALCULO</b></label>
                                                                    <textarea type="text" class="form-control" name="calculo" required>{{$sistema_nervioso->calculo}}</textarea>
                                                                </div>
                                                                @endif
                                                                @if($sistema_nervioso->piel <> 'N/A')
                                                                    <div class="col-12 col-md-6">
                                                                        <label><b>INTELIGENCIA</b></label>
                                                                        <textarea type="text" class="form-control" name="inteligencia" required>{{$sistema_nervioso->inteligencia}}</textarea>
                                                                    </div>
                                                                    @endif
                                                                    @if($sistema_nervioso->piel <> 'N/A')
                                                                        <div class="col-12 col-md-6">
                                                                            <label><b>ATENCION</b></label>
                                                                            <textarea type="text" class="form-control" name="atencion" required>{{$sistema_nervioso->atencion}}</textarea>
                                                                        </div>
                                                                        @endif
                                                                        @if($sistema_nervioso->piel <> 'N/A')
                                                                            <div class="col-12 col-md-6">
                                                                                <label><b>EMOTIVIDAD</b></label>
                                                                                <textarea type="text" class="form-control" name="emotividad" required>{{$sistema_nervioso->emotividad}}</textarea>
                                                                            </div>
                                                                            @endif
                                                                            @if($sistema_nervioso->piel <> 'N/A')
                                                                                <div class="col-12 col-md-6">
                                                                                    <label><b>PLANIFICACION</b></label>
                                                                                    <textarea type="text" class="form-control" name="planificacion" required>{{$sistema_nervioso->planificacion}}</textarea>
                                                                                </div>
                                                                                @endif
                                                                                @if($sistema_nervioso->piel <> 'N/A')
                                                                                    <div class="col-12 col-md-6">
                                                                                        <label><b>DECISION</b></label>
                                                                                        <textarea type="text" class="form-control" name="decision" required>{{$sistema_nervioso->decision}}</textarea>
                                                                                    </div>
                                                                                    @endif
                                                                                    @if($sistema_nervioso->piel <> 'N/A')
                                                                                        <div class="col-12 col-md-6">
                                                                                            <label><b>PERCEPCION</b></label>
                                                                                            <textarea type="text" class="form-control" name="percepcion" required>{{$sistema_nervioso->percepcion}}</textarea>
                                                                                        </div>
                                                                                        @endif
                                    </div>
                                    <h5>Paredes craneales</h5>

                                    <table id="table" class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">

                                        <tbody>
                                            <tr class="align-middle">
                                                <th style="width: 10%" rowspan="2">I</th>
                                                <th style="width: 40%"> Percepcion</th>
                                                <th style="width: 50%"> <textarea type="text" class="form-control" name="paredes_craneales_percepcion" required>{{$sistema_nervioso->paredes_craneales_percepcion}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">

                                                <th> Identificacion</th>
                                                <th><textarea type="text" class="form-control" name="identificacion" required>{{$sistema_nervioso->identificacion}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th rowspan="4">II</th>
                                                <th> Agudez visual</th>
                                                <th><textarea type="text" class="form-control" name="agudez_visual" required>{{$sistema_nervioso->agudez_visual}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th> Vision de color</th>
                                                <th><textarea type="text" class="form-control" name="vision_de_colores" required>{{$sistema_nervioso->vision_de_colores}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th> Campo visula</th>
                                                <th><textarea type="text" class="form-control" name="campo_visual" required>{{$sistema_nervioso->campo_visual}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th> Pupilas</th>
                                                <th><textarea type="text" class="form-control" name="pupilas" required>{{$sistema_nervioso->pupilas}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>III</th>
                                                <th> Motilidad del globo ocular</th>
                                                <th><textarea type="text" class="form-control" name="motilidad_del_globo_ocular" required>{{$sistema_nervioso->motilidad_del_globo_ocular}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>IV</th>
                                                <th> Reflejos fotomotor</th>
                                                <th><textarea type="text" class="form-control" name="reflejo_fotomotor" required>{{$sistema_nervioso->reflejo_fotomotor}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>V</th>
                                                <th> Reflejos de acomodacion</th>
                                                <th><textarea type="text" class="form-control" name="reflejos_de_acomodacion" required>{{$sistema_nervioso->reflejos_de_acomodacion}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th rowspan="4">VI</th>
                                                <th>Sensitivo</th>
                                                <th><textarea type="text" class="form-control" name="sensitivo" required>{{$sistema_nervioso->sensitivo}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Reflejos corneales</th>
                                                <th><textarea type="text" class="form-control" name="reflejo_corneal" required>{{$sistema_nervioso->reflejo_corneal}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Motor</th>
                                                <th><textarea type="text" class="form-control" name="motor" required>{{$sistema_nervioso->motor}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Reflejos maseteros</th>
                                                <th><textarea type="text" class="form-control" name="reflejo_maseterino" required>{{$sistema_nervioso->reflejo_maseterino}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>VII</th>
                                                <th>Valoracion muscular de la expresion facial</th>
                                                <th><textarea type="text" class="form-control" name="valora_musculos_expresion_facial" required>{{$sistema_nervioso->valora_musculos_expresion_facial}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th rowspan="2">VIII</th>
                                                <th>Audicion (prueba de Rinne, Weber)</th>
                                                <th><textarea type="text" class="form-control" name="audicion_prueba_rinnne_weber" required>{{$sistema_nervioso->audicion_prueba_rinnne_weber}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Vestibular</th>
                                                <th><textarea type="text" class="form-control" name="vestibular" required>{{$sistema_nervioso->vestibular}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>IX</th>
                                                <th>Reflejos nauseoso</th>
                                                <th><textarea type="text" class="form-control" name="reflejo_nauseoso" required>{{$sistema_nervioso->reflejo_nauseoso}}</textarae></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th rowspan="2">X</th>
                                                <th>Tos debil o disfonia</th>
                                                <th><textarea type="text" class="form-control" name="tos_debil_o_disfonia" required>{{$sistema_nervioso->tos_debil_o_disfonia}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>Asimetria paladar blando/trapecio reflejos nauseoso</th>
                                                <th><textarea type="text" class="form-control" name="asimetria_paladar_blando_perdida_reflejo_nauseoso" required>{{$sistema_nervioso->asimetria_paladar_blando_perdida_reflejo_nauseoso}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>XI</th>
                                                <th>Valor fuerza de esternocleidomastoideo/trapecio</th>
                                                <th><textarea type="text" class="form-control" name="valor_fuerza_esternocleidomastoideo_trapecio" required>{{$sistema_nervioso->valor_fuerza_esternocleidomastoideo_trapecio}}</textarea></th>
                                            </tr>
                                            <tr class="align-middle">
                                                <th>XII</th>
                                                <th>Desviacion de la lengua/fasciculacion de la lengua</th>
                                                <th><textarea type="text" class="form-control" name="desviacion_o_fasciculacion_de_lengua" required>{{$sistema_nervioso->desviacion_o_fasciculacion_de_lengua}}</textarea></th>
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
                                                <textarea type="text" class="form-control" name="tono" required>{{$sistema_motor->tono}}</textarea>
                                            </div>
                                            @endif
                                            @if($sistema_motor->trofismo <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Trofismo</b></label>
                                                    <textarea type="text" class="form-control" name="trofismo" required>{{$sistema_motor->trofismo}}</textarea>
                                                </div>
                                                @endif
                                                @if($sistema_motor->reflejos_de_estiramiento <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Reflejos de estiramiento </b></label>
                                                        <textarea type="text" class="form-control" name="reflejos_de_estiramiento" required>{{$sistema_motor->reflejos_de_estiramiento}}</textarea>
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
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_brazo_derecho" required>{{$sistema_motor->balance_muscular_brazo_derecho}}</textarea></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_brazo_izquierdo" required>{{$sistema_motor->balance_muscular_brazo_izquierdo}}</textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Antebrazo</b></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_antebrazo_derecho" required>{{$sistema_motor->balance_muscular_antebrazo_derecho}}</textarea></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_antebrazo_izquierdo" required>{{$sistema_motor->balance_muscular_antebrazo_izquierdo}}</textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Mano</b></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_mano_derecho" required>{{$sistema_motor->balance_muscular_mano_derecho}}</textarea></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_mano_izquierdo" required>{{$sistema_motor->balance_muscular_mano_izquierdo}}</textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Muslo</b></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_muslo_derecho" required>{{$sistema_motor->balance_muscular_muslo_derecho}}</textarea></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_muslo_izquierdo" required>{{$sistema_motor->balance_muscular_muslo_izquierdo}}</textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Pierna</b></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_pierna_derecho" required>{{$sistema_motor->balance_muscular_pierna_derecho}}</textarea></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_pierna_izquierdo" required>{{$sistema_motor->balance_muscular_pierna_izquierdo}}</textarea></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Pie</b></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_pie_derecho" required>{{$sistema_motor->balance_muscular_pie_derecho}}</textarea></td>
                                                        <td><textarea type="text" class="form-control" name="balance_muscular_pie_izquierdo" required>{{$sistema_motor->balance_muscular_pie_izquierdo}}</textarea></td>
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
                                                <textarea type="text" class="form-control" name="sensibilidad_superficial" required>{{$sistema_sensitivo->sensibilidad_superficial}}</textarea>
                                            </div>
                                            @endif
                                            @if($sistema_sensitivo->sensibilidad_profunda_consciente <> 'N/A')
                                                <div class="col-md-12">
                                                    <label><b>Sensibilidad profunda consciente </b></label>
                                                    <textarea type="text" class="form-control" name="sensibilidad_profunda_consciente" required>{{$sistema_sensitivo->sensibilidad_profunda_consciente}}</textarea>
                                                </div>
                                                @endif
                                                @if($sistema_sensitivo->sensibilidad_profunda_inconsciente <> 'N/A')
                                                    <div class="col-md-12">
                                                        <label><b>Sensibilidad profunda inconsciente </b></label>
                                                        <textarea type="text" class="form-control" name="sensibilidad_profunda_inconsciente" required>{{$sistema_sensitivo->sensibilidad_profunda_inconsciente}}</texrtarea>
                                                    </div>
                                                    @endif
                                                    @if($sistema_sensitivo->sistema_vestibulo_cerebeloso <> 'N/A')
                                                        <div class="col-md-12">
                                                            <label><b>Sistema vestibulo cerebeloso</b></label>
                                                            <textarea type="text" class="form-control" name="sistema_vestibulo_cerebeloso" required>{{$sistema_sensitivo->sistema_vestibulo_cerebeloso}}</textarea>
                                                        </div>
                                                        @endif
                                                        @if($sistema_sensitivo->signos_irritacion_meningea <> 'N/A')
                                                            <div class="col-md-12">
                                                                <label><b>Signos irritacion meningea</b></label>
                                                                <textarea type="text" class="form-control" name="signos_irritacion_meningea" required>{{$sistema_sensitivo->signos_irritacion_meningea}}</textarea>
                                                            </div>
                                                            @endif
                                                            @if($sistema_sensitivo->marcha <> 'N/A')
                                                                <div class="col-md-12">
                                                                    <label><b>Marcha</b></label>
                                                                    <textarea type="text" class="form-control" name="marcha" required>{{$sistema_sensitivo->marcha}}</textarea>
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
                                            <textarea type="text" class="form-control" name="diagnostico_sindromatico" required>{{$diagnostico_sindromatico->diagnostico_sindromatico}}</textarea>
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
                                            <textarea type="text" class="form-control" name="examenes_complementarios" required>{{$examenes_complementarios->examenes_complementarios}}</textarea>
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
                                            <textarea type="text" class="form-control" name="impresion_diagnostica" required>{{$impresion_diagnostica->impresion_diagnostica}}</textarea>
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
                                            <textarea type="text" class="form-control" name="comentarios" required>{{$comentarios->comentarios}}</textarea>
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
                                            <textarea type="text" class="form-control" name="laboratorios_de_estudio_y_gabinete_solicitados" required>{{$interpretacion_laboratorios->laboratorios_de_estudio_y_gabinete_solicitados}}</textarea>
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