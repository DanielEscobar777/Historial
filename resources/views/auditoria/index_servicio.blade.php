@extends('layouts.header')

@section('content')

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

            <table id="table" class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">
                <!-- buttons: agregar para botones-->
                <thead style="background-color: #c5cacf;">
                    <tr>
                        <th>ITEM</th>
                        <th>NOMBRE PACIENTE</th>
                        <th>FECHA</th>
                        @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                        <th>FECHA NACIMIENTO</th>
                        <th>SEXO </th>
                        @endif
                        <th>CAMA</th>
                        <th>AUDITORIA</th>

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
                        <td><a href="{{ route('auditoria.auditoria', $historial->id_historia)}}"><button class=" btn btn-primary"><i class="fa fa-search-plus"></i>Explorar</button></a></td>

                    </tr>
                    @endforeach
                </tbody>
                @else
                <tbody>
                    @foreach( $historiaRN as $historialrn)
                    <tr class="align-middle">
                        <td>{{ $historialrn->id_historia}}</td>
                        <td>{{ $historialrn->nombre_recien_necido}}</td>
                        <td>{{ $historialrn->fecha_registro}}</td>
                        <td>{{ $historialrn->fecha_recien_necido}} {{ $historialrn->hora_recien_necido}}</td>
                        @if($historialrn->sexo == 'M')
                        <td>Masculino</td>
                        @else
                        <td>Femenino</td>
                        @endif

                        <td>{{ $historialrn->cama}}</td>
                        <td><a href="{{ route('auditoria.auditoria', $historialrn->id_historia)}}"><button class=" btn btn-primary"><i class="fa fa-search-plus"></i>Explorar</button></a></td>

                    </tr>
                    @endforeach
                </tbody>
                @endif

            </table>
        </div>
    </div>
</div>

@endsection