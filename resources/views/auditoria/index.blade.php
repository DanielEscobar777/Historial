@extends('layouts.header')

@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b>AUDITORIA </b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <div class="col-12 text-center">
                <div class="row g-3">
                    @foreach( $servicios as $servicio)
                    <div class="col-12 col-md-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="mt-3">
                                    {{ $servicio->nombre_servicio}}
                                </h4>
                                <img src="{{ asset('images/auditoria.jfif') }}" alt="" style="width:150px; height:150px; border-radius:75px;">
                            </div>
                            <div class="card-footer bg-transparent border-top-0 text-center pb-3">
                                  <a href="{{ route('auditoria.show', $servicio->id_servicio) }}" class="btn btn-primary w-75">
                                    <i class="fas fa-eye me-1"></i> Activar
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

@endsection