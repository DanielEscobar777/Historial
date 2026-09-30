@extends('layouts.header')

@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b>KARDEX </b></h4>
            <div class="panel-heading-btn">
                <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                <a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
            </div>
        </div>

        <div class="panel-body">
            <div class="col-12 text-center">
                <div class="row g-3">
                    @foreach( $servicios as $servicio)
                    <div class="card border-primary mb-3">
                        <div class="card-body text-primary">
                            <h5 class="card-title">{{ $servicio->nombre_servicio}}</h5>
                            <p class="card-text"><button type="button" class="btn btn-primary btnDetalleRegistro" idRegistro="{{$servicio->id_servicio }}" data-bs-toggle="modal" data-bs-target="#modalBuscarPaciente">
                                    <i class="fa fa-file-pdf"></i> REPORTE</button></p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>


            <div class="modal fade" id="modalBuscarPaciente" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Buscar Paciente</h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="{{ route('Kardex.consulta') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_servicio" id="inputServicioif">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <label><b>Paciente</b></label>
                                            <select class="form-control select2-modal" name="id_paciente" id="selectPaciente" required>
                                                <option value="">Seleccione un paciente</option>
                                                @foreach($pacientes as $paciente)
                                                <option value="{{ $paciente->id }}">
                                                    {{ $paciente->nombres }} {{ $paciente->p_apellido }} {{ $paciente->s_apellido }} - {{ $paciente->ci }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label><b>Desde</b></label>
                                            <input type="date" class="form-control" name="desde" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label><b>Hasta</b></label>
                                            <input type="date" class="form-control" name="hasta" required>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger"> Reporte</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            // Inicializar Select2 cuando el modal se muestra completamente
            $('#modalBuscarPaciente').on('shown.bs.modal', function() {
                $('.select2-modal').select2({
                    placeholder: "Buscar paciente...",
                    dropdownParent: $('#modalBuscarPaciente'),
                    width: '100%'
                });
            });

            // Limpiar Select2 cuando el modal se cierra
            $('#modalBuscarPaciente').on('hidden.bs.modal', function() {
                $('.select2-modal').select2('destroy');
            });

            // Manejar la selección del paciente
            $('#btnSeleccionar').click(function() {
                var pacienteId = $('#selectPaciente').val();
                var pacienteText = $('#selectPaciente option:selected').text();

                // Aquí puedes hacer lo que necesites con los datos seleccionados
                console.log("ID:", pacienteId, "Nombre:", pacienteText);

                // Cerrar el modal
                $('#modalBuscarPaciente').modal('hide');
            });
        });

        $(document).on("click", ".btnDetalleRegistro", function() {
            var idRegistro = $(this).attr("idRegistro");
            $('#inputServicioif').val(idRegistro);
        });
    </script>


    @endsection