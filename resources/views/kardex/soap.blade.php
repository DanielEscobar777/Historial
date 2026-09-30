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
                                <button type="button" class="btn btn-danger btnDetalleRegistro" idRegistro="{{$evolucion->id_evolucion }}" data-id="{{ $evolucion->id_evolucion }}" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fa fa-file-pdf"></i> Reporte</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">MARGEN SUPERIOR DEL SOAP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('pdf.generateSOAP') }}" method="POST" target="_blank">
                                         @csrf 
                                        <label for="margen_superior_cm">Margen superior (cm):</label>

                                        <input type="hidden" name="id_evolucion" id="inputEvolucionId">
                                        <input type="number" name="margen_superior_cm" value="5" step="0.1" min="0">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-danger">Generar PDF</button>
                                    </form>
                                </div>
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
<script type="text/javascript">
    $(document).on("click", ".btnDetalleRegistro", function() {
        var idRegistro = $(this).attr("idRegistro");
        $('#inputEvolucionId').val(idRegistro);
    });
</script>


@endsection