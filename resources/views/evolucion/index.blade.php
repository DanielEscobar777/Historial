@extends('layouts.header')

@section('content')

<div class="col-12">
    <ol class="breadcrumb float-xl-end">
        <li class="breadcrumb-item"><a class="text-danger">SOAP</a></li>
        <li class="breadcrumb-item"><a>TABLERO</a></li>
    </ol>
    <h1 class="page-header mb-3 text-danger">NOTA DE EVOLUCION</h1>
</div>

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b> REGISTRO DE NOTAS DE EVOLUCION </b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>

        <div class="panel-body">

            <a href="{{ route('evolucion.formulario_soap')}}"><button class=" btn btn-warning"><i class="fa fa-plus"></i> Nueva evolucion</button></a><br>

            <table id="table" class="table table-bordered table-hover dt-responsive nowrap w-100" style="width: 100%">

                <thead style="background-color: #c5cacf;">
                    <tr>
                        <th>ITEM</th>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>DESCRIPCION</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $evoluciones as $evolucion)
                    <tr class="align-middle">
                        <td>{{ $evolucion->id_evolucion}}</td>
                        <td>{{ $evolucion->fecha_registro}}</td>
                        <td>{{$evolucion->hora_registro}}</td>
                        <td>{{ $evolucion->descripcion}}</td>
                        <td>
                            <a href="{{ route('evolucion.edit_interno', $evolucion->id_evolucion)}}"><button class=" btn btn-warning"><i class="fa fa-edit"></i></button></a>
                            <!-- <a target="_blank" href="{{ route('pdf.generateSOAP_internos', $evolucion->id_evolucion)}}"><button class=" btn btn-danger"><i class="fa fa-file-pdf"></i></button></a> -->
                            <button type="button" class="btn btn-danger js-soap-pdf" data-evolution-id="{{ $evolucion->id_evolucion }}" data-bs-toggle="modal" data-bs-target="#soapPdfConfigModal">
                                <i class="fa fa-file-pdf"></i></button>
                        </td>
                    </tr>

                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
<x-soap-pdf-configurator />
@vite(['resources/js/soapPdfConfigurator.js'])

@endsection
