@extends('layouts.header')

@section('content')

<div class="col-md-12 col-12">
    <div class="panel" data-sortable-id="ui-general-1">
        <div class="panel-heading" style="background-color: #c5cacf;">
            <h4 class="panel-title text-center"><b>Formulario Historia Clínica</b></h4>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <?php $n = 2 ?>

        <div class="panel-body">
            <form action="{{ route('historial.store') }}" method="POST" autocomplete="off" novalidate data-servicio="{{ $n_ser->nombre_servicio }}">
                @csrf
                <div class="row">

                    @if ($n_ser->nombre_servicio != 'NEONATOLOGIA')
                    <div class="col-md-6">
                        <label><b>Buscar por C.I.</b></label>
                        <input type="text" id="buscar_ci" class="form-control" placeholder="Ingrese CI del paciente" autocomplete="off">
                        <div id="lista_sugerencias" class="list-group" style="position: absolute; z-index: 1000;"></div>
                    </div>

                    <input type="hidden" name="nombres" value="{{ old('nombres') }}">
                    <input type="hidden" name="p_apellido" value="{{ old('p_apellido') }}">
                    <input type="hidden" name="s_apellido" value="{{ old('s_apellido') }}">
                    <input type="hidden" name="sexo" value="{{ old('sexo') }}">
                    <input type="hidden" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                    <input type="hidden" name="telefono" value="{{ old('telefono') }}">
                    <input type="hidden" name="ci" value="{{ old('ci') }}">
                    <input type="hidden" name="complemento" value="{{ old('complemento') }}">
                    <input type="hidden" name="nacionalidad" value="{{ old('nacionalidad') }}">
                    <input type="hidden" name="matricula_seguro" value="{{ old('matricula_seguro') }}">
                    <input type="hidden" name="residencia" value="{{ old('residencia') }}">
                    @endif

                    <h5 style="color:rgba(23, 93, 126, 0.87);">1.- Filiación</h5>

                    @if ($n_ser->nombre_servicio == 'NEONATOLOGIA')
                    <div class="col-md-6">
                        <label><b>Nombre del Recién Nacido</b></label>
                        <input type="text" class="form-control" name="nombre_recien_necido" value="{{ old('nombre_recien_necido') }}">
                    </div>

                    <div class="col-md-6"> 
                        <label><b>Sexo</b></label>
                        <select class="form-control" name="sexo" required>
                            <option value="">Seleccione una opción</option>
                            <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label><b>Cama</b></label>
                        <input type="text" class="form-control" name="cama" value="{{ old('cama') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Fecha de Nacimiento del RN</b></label>
                        <input type="date" class="form-control" name="fecha_recien_necido" value="{{ old('fecha_recien_necido') }}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Hora de Nacimiento del RN</b></label>
                        <input type="time" class="form-control" name="hora_recien_necido" value="{{ old('hora_recien_necido') }}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Servicio</b></label>
                        <input type="text" class="form-control" value="{{ $n_ser->nombre_servicio }}" disabled>
                        <input type="hidden" name="id_servicio" value="{{ $n_ser->id_servicio }}">
                        <input type="hidden" name="nombre_servicio" value="{{ $n_ser->nombre_servicio }}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Referencia (Nombre y Teléfono)</b></label>
                        <input type="text" class="form-control" name="nombrenum_referencia" value="{{ old('nombrenum_referencia') }}" required>
                    </div>
                    @else

                    <div class="col-md-6">
                        <label><b>Paciente</b></label>
                        <input type="text" class="form-control" name="id_paciente" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Servicio</b></label>
                        <input type="text" class="form-control" value="{{ $n_ser->nombre_servicio }}" disabled>
                        <input type="hidden" name="id_servicio" value="{{ $n_ser->id_servicio }}">
                        <input type="hidden" name="nombre_servicio" value="{{ $n_ser->nombre_servicio }}">
                    </div>

                    <div class="col-md-6">
                        <label><b>Ocupacion</b></label>
                        <input type="text" class="form-control" name="ocupacion" value="{{ old('ocupacion') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Estado civil</b></label>
                        <input type="text" class="form-control" name="estado_civil" value="{{ old('estado_civil') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grado de Instrucción</b></label>
                        <input type="text" class="form-control" name="grado_instruccion" value="{{ old('grado_instruccion') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Religión</b></label>
                        <input type="text" class="form-control" name="religion" value="{{ old('religion') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Cama</b></label>
                        <input type="text" class="form-control" name="cama" value="{{ old('cama') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Fuente de Información</b></label>
                        <input type="text" class="form-control" name="fuente_informacion" value="{{ old('fuente_informacion') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Referencia (Nombre y Teléfono)</b></label>
                        <input type="text" class="form-control" name="nombrenum_referencia" value="{{ old('nombrenum_referencia') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grado de Confiabilidad</b></label>
                        <input type="text" class="form-control" name="grado_confiabilidad" value="{{ old('grado_confiabilidad') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grupo Sanguíneo y Factor</b></label>
                        <input type="text" class="form-control" name="grupo_sanguineo_facto" value="{{ old('grupo_sanguineo_facto') }}" required>
                    </div>

                    @endif

                    <div class="col-md-12">
                        @foreach ($campos_organizados as $modulo => $grupo)
                        <div class="col-12">
                            <h5 style="color:rgba(23, 93, 126, 0.87);">{{ $n }}.- {{ ucwords(str_replace('_', ' ', $grupo['nombre'])) }}</h5>
                        </div>
                        @foreach ($grupo['subcampos'] as $subcampo)
                        <div class="col-md-12">
                            <label><b>{{ $subcampo['etiqueta'] == 'Unias' ? 'Uñas' : ($subcampo['etiqueta'] == 'Punio_percusion_renal' ? 'Puño Percusion Renal' : ucwords(str_replace('_', ' ', $subcampo['etiqueta']))) }}</b></label>
                            <textarea class="form-control" name="campos_dinamicos[{{ $subcampo['nombre'] }}]" placeholder="Escriba descripcion...">{{ old('campos_dinamicos.' . $subcampo['nombre']) }}</textarea>
                        </div>
                        @endforeach
                        <?php $n++ ?>
                        @endforeach
                    </div>
                </div>

                <br>
                <a href="{{ route('historial.show', $n_ser->id_servicio) }}" class="btn btn-danger"><i class="fa fa-reply"></i> Cancelar</a>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
@vite(['resources/js/boton.js'])

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ciInput = document.getElementById('buscar_ci');
    const listaSugerencias = document.getElementById('lista_sugerencias');

    if (!ciInput || !listaSugerencias) return;

    ciInput.addEventListener('input', function () {
        const term = ciInput.value.trim();
        if (term.length === 0) {
            listaSugerencias.innerHTML = '';
            listaSugerencias.style.display = 'none';
            return;
        }

        fetch(`/buscar-paciente?term=${encodeURIComponent(term)}`)
            .then(res => res.json())
            .then(data => {
                listaSugerencias.innerHTML = '';
                if (data.length === 0) {
                    listaSugerencias.style.display = 'none';
                    return;
                }

                data.forEach(usuario => {
                    const div = document.createElement('div');
                    div.classList.add('list-group-item', 'list-group-item-action');
                    div.style.cursor = 'pointer';
                    div.textContent = `${usuario.ci} - ${usuario.nombres} ${usuario.p_apellido}`;
                    div.dataset.usuario = JSON.stringify(usuario);
                    listaSugerencias.appendChild(div);
                });

                listaSugerencias.style.display = 'block';
            })
            .catch(err => {
                console.error('Error al buscar pacientes:', err);
                listaSugerencias.style.display = 'none';
            });
    });

    listaSugerencias.addEventListener('click', function (e) {
        if (e.target && e.target.dataset.usuario) {
            const user = JSON.parse(e.target.dataset.usuario);

            document.querySelector('input[name="nombres"]').value = user.nombres || '';
            document.querySelector('input[name="p_apellido"]').value = user.p_apellido || '';
            document.querySelector('input[name="s_apellido"]').value = user.s_apellido || '';
            document.querySelector('input[name="sexo"]').value = user.sexo || '';
            document.querySelector('input[name="fecha_nacimiento"]').value = user.fecha_nacimiento || '';
            document.querySelector('input[name="telefono"]').value = user.telefono || '';
            document.querySelector('input[name="ci"]').value = user.ci || '';
            document.querySelector('input[name="complemento"]').value = user.complemento || '';
            document.querySelector('input[name="nacionalidad"]').value = user.nacionalidad || '';
            document.querySelector('input[name="matricula_seguro"]').value = user.matricula_seguro || '';
            document.querySelector('input[name="residencia"]').value = user.residencia || '';
            document.querySelector('input[name="id_paciente"]').value = `${user.nombres} ${user.p_apellido} ${user.ci}`;

            listaSugerencias.style.display = 'none';
        }
    });

    document.addEventListener('click', function (e) {
        if (!listaSugerencias.contains(e.target) && e.target !== ciInput) {
            listaSugerencias.style.display = 'none';
        }
    });

    // Neonatología - generación automática de nombre
    const form = document.querySelector("form");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        const servicio = "{{ $n_ser->nombre_servicio }}";
        if (servicio === "NEONATOLOGIA") {
            let nombreInput = form.querySelector("input[name='nombre_recien_necido']");
            let camaInput = form.querySelector("input[name='cama']");
            let fechaInput = form.querySelector("input[name='fecha_recien_necido']");
            let horaInput = form.querySelector("input[name='hora_recien_necido']");

            if (nombreInput && nombreInput.value.trim() === "") {
                let cama = camaInput?.value || "CamaDesconocida";
                let fecha = fechaInput?.value || "FechaDesconocida";
                let hora = horaInput?.value || "HoraDesconocida";

                let nombreGenerado = `RN_${fecha.replaceAll("-", "")}_${hora.replaceAll(":", "")}_${cama.replaceAll(" ", "")}`;
                nombreInput.value = nombreGenerado;
            }
        }
    });
});
</script>
@endpush
