@extends('layouts.header')
@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
        </div>

        <div class="panel-body">
            <h4 class="text-center" style="color:rgba(11, 107, 185, 0.65);">REGISTRO DE EVOLUCIONES</h4>

            <div class="col-12 text-center">
                <div class="row g-3">
                    @foreach( $evoluciones as $evolucion)
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="mt-3">
                                    {{ $evolucion->fecha_registro}}
                                </h4>
                                <h4 class="mt-3">
                                    {{ $evolucion->hora_registro}}
                                    {{ $evolucion->id_evolucion}}
                                </h4>
                                <img src="{{ asset('images/soap.png') }}" alt="" style="width:150px; height:150px; border-radius:75px;">
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-danger js-soap-pdf" data-evolution-id="{{ $evolucion->id_evolucion }}" data-bs-toggle="modal" data-bs-target="#soapPdfConfigModal">
                                    <i class="fa fa-file-pdf"></i> Reporte</button>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div><br>
                <div class="col-12" style="text-align: left;">
                    <a href="{{ route('Kardex.index')}}" class="btn btn-danger "><i class="fa fa-reply"></i> Cancelar</a>

                </div>
            </div>

        </div>
    </div>
</div>
<x-soap-pdf-configurator />
@vite(['resources/js/soapPdfConfigurator.js'])


@endsection
