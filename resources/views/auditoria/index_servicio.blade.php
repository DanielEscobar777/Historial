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
                        <th>MATRICULA</th>
                        <th>FECHA</th>
                        @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                        <th>FECHA NACIMIENTO</th>
                        <th>SEXO </th>
                        @endif
                        <th>CAMA</th>
                        <th>AUDITORIA</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach( $historiales as $historial)
                    <tr class="align-middle">
                        <td>{{ $historial->id_historia}}</td>
                        @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                        <td>{{ $historial->nombre_recien_necido}}</td>
                        @else
                        <td>{{ $historial->nombres}}  {{$historial->p_apellido}} {{$historial->s_apellido}}</td>
                        @endif
                        <td>{{ $historial->matricula_seguro}} </td>
                        <td>{{ $historial->fecha_registro}} {{$historial->hora_registro}}</td>
                        @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                        <td>{{ $historial->fecha_recien_necido}} {{ $historial->hora_recien_necido}}</td>
                        <td>{{ $historial->sexo}}</td>
                        @endif
                        <td>{{ $historial->cama}}</td>
                        <td><a href="{{ route('auditoria.auditoria', $historial->id_historia)}}"><button class=" btn btn-primary"><i class="fa fa-search-plus"></i>Explorar</button></a></td>
                    </tr>

                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection