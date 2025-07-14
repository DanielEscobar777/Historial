@extends('layouts.header')

@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b>PANEL DE SERVICIOS </b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <div class="col-12 text-center">
               
            <div id="actualizar-rn-vue"></div>

                <div class="row g-3">
                    @foreach( $servicios as $servicio)
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="mt-3">
                                    {{ $servicio->nombre_servicio}}
                                </h4>
                                <img src="{{ asset('images/HC.jfif') }}" alt="" style="width:150px; height:150px; border-radius:75px;">
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('historial.show', $servicio->id_servicio) }}" class="btn-outline-primary">
                                    ACTIVAR 
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@vite(['resources/js/buscarPaciente.js'])
@endsection