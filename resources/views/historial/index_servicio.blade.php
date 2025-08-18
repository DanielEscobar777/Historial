@extends('layouts.header')

@section('content')

<div class="col-12">
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a class="text-danger">Historial Clinico</a></li>
        <li class="breadcrumb-item"><a>TABLERO</a></li>
    </ol>
    <h1 class="page-header mb-3 text-danger">HISTORIAL</h1>
</div>

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b> REGISTRO DE HISTORIAS CLINICAS {{$servicio->nombre_servicio}} </b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>

        <div class="panel-body">

            <a href="{{ route('historial.formulario', $id_servicio)}}"><button class=" btn btn-warning"><i class="fa fa-plus"></i> Nueva historia</button></a><br>

            <table id="table" class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                <!-- buttons: agregar para botones-->
                <thead style="background-color: #c5cacf;">
                    <tr>
                        <th>ITEM</th>
                        <th>NOMBRE PACIENTE</th>
                        <th>MATRICULA</th>
                        <th>FECHA</th>
                        @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                        <th>FECHA NACIMIENTO</th>
                        <th>SEXO </th>
                        @endif
                        <th>CAMA</th>
                        <th>HC</th>
                        <th>SOAP</th>
                        @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                        <th>ESTADO</th>
                        @endif
                    </tr>
                </thead>
                @if($servicio->nombre_servicio != 'NEONATOLOGIA')
                <tbody>
                    @foreach( $historiales as $historial)
                    <tr class="align-middle">
                        <td>{{ $historial->id_historia}}</td>
                        <td>{{ $historial->nombres}} {{ $historial->p_apellido}} {{ $historial->s_apellido}}</td>
                   
                        <td>{{ $historial->matricula_seguro}}</td>
                        <td>{{ $historial->fecha_registro}}</td>

                        <td>{{ $historial->cama}}</td>
                        <td><a target="_blank" href="/generate-pdf/{{ $historial->id_historia }}"><button class=" btn btn-danger"><i class="fa fa-file-pdf"></i></button></a>
                            <a href="{{ route('historial.edit', $historial->id_historia)}}"><button class=" btn btn-warning"><i class="fa fa-edit"></i></button></a>
                        </td>
                        <td>
                            <a href="{{ route('evolucion.formulario', $historial->id_historia)}}"><button class=" btn btn-success"><i class="fa fa-plus"></i></button></a>
                            <a href="{{ route('evolucion.edit', $historial->id_historia)}}"><button class=" btn btn-info"><i class="fa fa-cog"></i></button></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <tbody>
                    @foreach( $historiaRN as $historialrn)
                    <tr class="align-middle">
                        <td>{{ $historialrn->id_historia}}</td>
                        <td>{{ $historialrn->nombre_recien_necido}}</td>
                          <td>{{ $historialrn->matricula}}</td>
                        <td>{{ $historialrn->fecha_registro}}</td>
                        <td>{{ $historialrn->fecha_recien_necido}} {{ $historialrn->hora_recien_necido}}</td>
                        @if($historialrn->sexo == 'M')
                        <td>Masculino</td>
                        @else
                        <td>Femenino</td>
                        @endif

                        <td>{{ $historialrn->cama}}</td>
                        <td><a target="_blank" href="/generate-pdf/{{ $historialrn->id_historia }}"><button class=" btn btn-danger"><i class="fa fa-file-pdf"></i></button></a>
                            <a href="{{ route('historial.edit', $historialrn->id_historia)}}"><button class=" btn btn-warning"><i class="fa fa-edit"></i></button></a>
                        </td>
                        <td>
                            <a href="{{ route('evolucion.formulario', $historialrn->id_historia)}}"><button class=" btn btn-success"><i class="fa fa-plus"></i></button></a>
                            <a href="{{ route('evolucion.edit', $historialrn->id_historia)}}"><button class=" btn btn-info"><i class="fa fa-cog"></i></button></a>
                        </td>
                        @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                        @if( $historialrn->id_paciente == '0')
                        <td>
                            <span class="btn btn-danger btn-sm">NO ACTUALIZADO</span>
                        </td>
                        @else
                        <td>
                            <span class="btn btn-success btn-s">ACTUALIZADO</span>
                        </td>
                        @endif
                        @endif
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>
        </div>
    </div>
</div>

@endsection