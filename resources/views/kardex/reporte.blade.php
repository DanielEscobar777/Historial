@extends('layouts.header')

@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b> KARDEX DE HISTORIAS CLINICAS de {{$paciente->nombres}} {{$paciente->p_apellido}} {{$paciente->s_apellido}}  EN {{$servicio->nombre_servicio}} </b></h4>
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
                        <th>HC</th>
                        <th>SOAP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $datos as $dato)
                    <tr class="align-middle">
                        <td>{{ $dato->id_historia}}</td>
                        @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                        <td>{{ $dato->nombre_recien_necido}}</td>
                        @else
                        <td>{{ $dato->nombres}} {{ $dato->p_apellido}} {{ $dato->s_apellido}}</td>
                        @endif
                        <td>{{ $dato->matricula_seguro}}</td>
                        <td>{{ $dato->fecha_registro}}</td>
                         @if($servicio->nombre_servicio == 'NEONATOLOGIA')
                         <td>{{ $dato->fecha_recien_necido}} {{ $dato->hora_recien_necido}}</td>
                         <td>{{ $dato->sexo}}</td>
                         @endif
                        <td>{{ $dato->cama}}</td>
                        <td><a target="_blank" href="/generate-pdf/{{ $dato->id_historia }}"><button class=" btn btn-danger"><i class="fa fa-file-pdf"></i></button></a>
                        </td>
                        <td>
                            <a href="{{ route('kardex.soap', $dato->id_historia)}}"><button class=" btn btn-info"><i class="fa fa-file"></i></button></a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection