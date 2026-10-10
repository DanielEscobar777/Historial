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
            <!-- <pre>{{ print_r(old(), true) }}</pre> -->

            <form action="{{ route('historial.store') }}" method="POST" autocomplete="off" novalidate data-servicio="{{ $n_ser->nombre_servicio }}">
                @csrf
                <div class="row">
                    @if ($n_ser->nombre_servicio!='NEONATOLOGIA')
                    <div class="col-md-4">
                        <label><b>Buscar por C.I.</b></label>
                        <input type="text" id="buscar_ci" class="form-control" placeholder="Ingrese CI del paciente" autocomplete="off">
                        <small class="text-muted">Ingrese el C.I. completo y presione Buscar.</small>
                        <div id="lista_sugerencias" class="list-group" aria-live="polite" style="position: absolute; z-index: 1000; width: 100%;"></div>
                    </div>
                    <div class="col-md-2">
                        <label><b>Complemento</b></label>
                        <input type="text" id="buscar_complemento" class="form-control" placeholder="Ej. LP" autocomplete="off">
                    </div>
                    <div class="col-md-2">
                        <label class="d-block" aria-hidden="true">&nbsp;</label>
                        <button type="button" id="buscar_paciente_btn" class="btn btn-primary w-100" style="height: 38px;">
                            <i class="fa fa-search"></i> Buscar
                        </button>
                    </div>

                    <input type="hidden" class="form-control" value="{{ old('nombres') }}" name="nombres">
                    <input type="hidden" class="form-control" value="{{ old('p_apellido') }}" name="p_apellido">
                    <input type="hidden" class="form-control" value="{{ old('s_apellido') }}" name="s_apellido">
                    <input type="hidden" class="form-control" value="{{ old('sexo') }}" name="sexo">
                    <input type="hidden" class="form-control" value="{{ old('fecha_nacimiento') }}" name="fecha_nacimiento">
                    <input type="hidden" class="form-control" value="{{ old('telefono') }}" name="telefono">
                    <input type="hidden" class="form-control" value="{{ old('ci') }}" name="ci">
                    <input type="hidden" class="form-control" value="{{ old('complemento') }}" name="complemento">
                    <input type="hidden" class="form-control" value="{{ old('nacionalidad') }}" name="nacionalidad">
                    <input type="hidden" class="form-control" value="{{ old('matricula_seguro') }}" name="matricula_seguro">
                    <input type="hidden" class="form-control" value="{{ old('residencia') }}" name="residencia">
                    @endif
                    <h5 style="color:rgba(23, 93, 126, 0.87);">1.- Filiación</h5>

                    @if ($n_ser->nombre_servicio=='NEONATOLOGIA')
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
                        <input type="text" class="form-control" name="cama" value="{{ old('cama') }}" placeholder="Ej. 12" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Fecha de Nacimiento del RN</b></label>
                        <input type="date" class="form-control" name="fecha_recien_necido" value="{{ old('fecha_recien_necido') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Hora de Nacimiento del RN</b></label>
                        <input type="time" class="form-control" name="hora_recien_necido" value="{{ old('hora_recien_necido') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label><b>Servicio</b></label>
                        <input type="text" class="form-control" value="{{$n_ser->nombre_servicio}} " disabled>
                        <input type="hidden" class="form-control" name="id_servicio" value="{{$n_ser->id_servicio}}">
                        <input type="hidden" class="form-control" name="nombre_servicio" value="{{$n_ser->nombre_servicio}}">
                    </div>
                    <div class="col-md-6">
                        <label><b>Referencia (Nombre y Teléfono)</b></label>
                        <input type="text" class="form-control" name="nombrenum_referencia" value="{{ old('nombrenum_referencia') }}" placeholder="Ej. María Pérez - 70000000" required>
                    </div>
                    @else

                    <div class="col-md-6">
                        <label><b>Paciente</b></label>
                        <input type="text" class="form-control" name="id_paciente" value="{{ old('id_paciente') }}" placeholder="Seleccione un paciente mediante la búsqueda por C.I." readonly required>
                        <div class="invalid-feedback">Busque y seleccione un paciente antes de guardar.</div>
                    </div>

                    <div class="col-md-6">
                        <label><b>Servicio</b></label>
                        <input type="text" class="form-control" value="{{$n_ser->nombre_servicio}} " disabled>
                        <input type="hidden" class="form-control" name="id_servicio" value="{{$n_ser->id_servicio}}">
                        <input type="hidden" class="form-control" name="nombre_servicio" value="{{$n_ser->nombre_servicio}}">

                    </div>
                    <div class="col-md-6">
                        <label><b>Ocupacion</b></label>
                        <input type="text" class="form-control" name="ocupacion" value="{{ old('ocupacion') }}" placeholder="Ej. Docente" required>
                    </div>
                    <div class="col-md-6">
                        <label><b>Estado civil</b></label>
                        <input type="text" class="form-control" name="estado_civil" value="{{ old('estado_civil') }}" placeholder="Ej. Soltero(a)" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grado de Instrucción</b></label>
                        <input type="text" class="form-control" name="grado_instruccion" value="{{ old('grado_instruccion') }}" placeholder="Ej. Secundaria completa" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Religión</b></label>
                        <input type="text" class="form-control" name="religion" value="{{ old('religion') }}" placeholder="Ej. Católica o Ninguna" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Cama</b></label>
                        <input type="text" class="form-control" name="cama" value="{{ old('cama') }}" placeholder="Ej. 12" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Fuente de Información</b></label>
                        <input type="text" class="form-control" name="fuente_informacion" value="{{ old('fuente_informacion') }}" placeholder="Ej. Paciente o familiar" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Referencia (Nombre y Teléfono)</b></label>
                        <input type="text" class="form-control" name="nombrenum_referencia" value="{{ old('nombrenum_referencia') }}" placeholder="Ej. María Pérez - 70000000" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grado de Confiabilidad</b></label>
                        <input type="text" class="form-control" name="grado_confiabilidad" value="{{ old('grado_confiabilidad') }}" placeholder="Ej. Buena" required>
                    </div>

                    <div class="col-md-6">
                        <label><b>Grupo Sanguíneo y Factor</b></label>
                        <input type="text" class="form-control" name="grupo_sanguineo_facto" value="{{ old('grupo_sanguineo_facto') }}" placeholder="Ej. O positivo" required>
                    </div>

                    @endif
                    <div class="col-md-12">
                        @php
                            $ayudaCampo = static function (string $etiqueta): string {
                                $campo = strtolower(\Illuminate\Support\Str::ascii($etiqueta));

                                if (str_contains($campo, 'presion arterial')) return 'Ingrese números y unidad. Ej.: 120/80 mmHg.';
                                if (str_contains($campo, 'temperatura')) return 'Ingrese el valor numérico en °C. Ej.: 36.5 °C.';
                                if (str_contains($campo, 'frecuencia cardiaca') || str_contains($campo, 'pulso')) return 'Ingrese el valor numérico. Ej.: 80 lpm.';
                                if (str_contains($campo, 'frecuencia respiratoria')) return 'Ingrese el valor numérico. Ej.: 18 rpm.';
                                if (str_contains($campo, 'saturacion')) return 'Ingrese el porcentaje. Ej.: 96%.';
                                if (str_contains($campo, 'peso')) return 'Ingrese el número y la unidad. Ej.: 70 kg.';
                                if (str_contains($campo, 'talla') || str_contains($campo, 'estatura')) return 'Ingrese el número y la unidad. Ej.: 1.70 m.';
                                if (str_contains($campo, 'escala') || str_contains($campo, 'grado')) return 'Ingrese el valor o grado y añada una descripción breve.';

                                return 'Describa el hallazgo con palabras claras. Si no presenta alteraciones, escriba “Sin alteraciones”.';
                            };
                        @endphp

                        @foreach ($campos_organizados as $modulo => $grupo)
                        <div class="col-12">
                            <h5 style="color:rgba(23, 93, 126, 0.87);">{{$n}}.- {{ ucwords(str_replace('_', ' ', $grupo['nombre']))}}</h5>
                        </div>
                        @foreach ($grupo['subcampos'] as $subcampo)
                        @php
                            $campoId = 'campo_' . md5($subcampo['nombre']);
                            $textoAyuda = $ayudaCampo($subcampo['etiqueta']);
                        @endphp
                        <div class="col-md-12 mb-3">
                            @switch($subcampo['etiqueta'])
                            @case('Unias')
                            <label for="{{ $campoId }}"><b>Uñas <span class="text-danger">*</span></b></label>
                            @break
                            @case('Punio_percusion_renal')
                            <label for="{{ $campoId }}"><b>Puño Percusión Renal <span class="text-danger">*</span></b></label>
                            @break
                            @default
                            <label for="{{ $campoId }}"><b>{{ ucwords(str_replace('_', ' ', $subcampo['etiqueta'])) }} <span class="text-danger">*</span></b></label>
                            @endswitch
                            <textarea
                                id="{{ $campoId }}"
                                class="form-control campo-dinamico"
                                name="campos_dinamicos[{{ $subcampo['nombre'] }}]"
                                rows="2"
                                maxlength="255"
                                placeholder="{{ $textoAyuda }}"
                                aria-describedby="{{ $campoId }}_ayuda {{ $campoId }}_error"
                                data-etiqueta="{{ ucwords(str_replace('_', ' ', $subcampo['etiqueta'])) }}"
                                required>{{ old('campos_dinamicos.' . $subcampo['nombre']) }}</textarea>
                            <small id="{{ $campoId }}_ayuda" class="form-text text-muted">{{ $textoAyuda }}</small>
                            <div id="{{ $campoId }}_error" class="invalid-feedback">El campo {{ ucwords(str_replace('_', ' ', $subcampo['etiqueta'])) }} es obligatorio.</div>
                        </div>
                        @endforeach
                        <?php $n++ ?>
                        @endforeach
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('historial.show', $n_ser->id_servicio)}}" class="btn btn-danger"><i class="fa fa-reply"></i> Cancelar</a>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@vite(['resources/js/formulario.js'])
<!--@vite(['resources/js/buscarPaciente.js'])-->
@vite(['resources/js/boton.js'])
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[data-servicio]");
    if (!form) return;

    const camposObligatorios = Array.from(form.querySelectorAll('[required]'));
    const erroresServidor = @json($errors->toArray());

    Object.entries(erroresServidor).forEach(function ([nombre, mensajes]) {
        if (nombre === 'error') return;

        const nombreHtml = nombre.replace(/^campos_dinamicos\.(.+)$/, 'campos_dinamicos[$1]');
        const campo = form.elements.namedItem(nombreHtml);
        if (!campo || typeof campo === 'string') return;

        const mensajeTexto = Array.isArray(mensajes) ? mensajes[0] : String(mensajes);
        let mensaje = campo.parentElement.querySelector('.invalid-feedback');

        if (!mensaje) {
            mensaje = document.createElement('div');
            mensaje.className = 'invalid-feedback';
            campo.insertAdjacentElement('afterend', mensaje);
        }

        campo.dataset.serverError = mensajeTexto;
        campo.classList.add('is-invalid');
        campo.setAttribute('aria-invalid', 'true');
        mensaje.textContent = mensajeTexto;

        const quitarErrorServidor = function () {
            delete campo.dataset.serverError;
            campo.classList.remove('is-invalid');
            campo.removeAttribute('aria-invalid');
        };

        campo.addEventListener('input', quitarErrorServidor, { once: true });
        campo.addEventListener('change', quitarErrorServidor, { once: true });
    });

    const primerErrorServidor = form.querySelector('.is-invalid');
    if (primerErrorServidor) {
        requestAnimationFrame(function () {
            primerErrorServidor.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(function () { primerErrorServidor.focus(); }, 350);
        });
    }

    const etiquetaCampo = function (campo) {
        return campo.dataset.etiqueta
            || campo.closest('.col-md-6, .col-md-12')?.querySelector('label')?.textContent.replace('*', '').trim()
            || 'Este campo';
    };

    const mensajeError = function (campo) {
        if (campo.dataset.serverError) {
            return campo.dataset.serverError;
        }

        const valor = String(campo.value || '').trim();
        const etiqueta = etiquetaCampo(campo);
        const maximo = Number(campo.getAttribute('maxlength'));

        if (valor === '') {
            return `El campo ${etiqueta} es obligatorio.`;
        }

        if (maximo > 0 && valor.length > maximo) {
            return `${etiqueta} tiene ${valor.length} caracteres. Reduzca el texto a un máximo de ${maximo}.`;
        }

        return '';
    };

    camposObligatorios.forEach(function (campo) {
        const contenedor = campo.parentElement;
        const tieneMensaje = Array.from(contenedor.children).some(function (elemento) {
            return elemento.classList?.contains('invalid-feedback');
        });

        if (!tieneMensaje) {
            const mensaje = document.createElement('div');
            mensaje.className = 'invalid-feedback';
            mensaje.textContent = `El campo ${etiquetaCampo(campo)} es obligatorio.`;
            campo.insertAdjacentElement('afterend', mensaje);
        }

        const limpiarError = function () {
            delete campo.dataset.serverError;
            const error = mensajeError(campo);
            const mensaje = campo.parentElement.querySelector('.invalid-feedback');

            if (mensaje) mensaje.textContent = error;

            if (error === '') {
                campo.classList.remove('is-invalid');
                campo.removeAttribute('aria-invalid');
            }
        };

        campo.addEventListener('input', limpiarError);
        campo.addEventListener('change', limpiarError);
    });

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

                // Formato automático: RN_[fecha]_[hora]_[cama]
                let nombreGenerado = `RN_${fecha.replaceAll("-", "")}_${hora.replaceAll(":", "")}_${cama.replaceAll(" ", "")}`;
                nombreInput.value = nombreGenerado;
            }
        }

        const camposInvalidos = camposObligatorios.filter(function (campo) {
            return mensajeError(campo) !== '';
        });

        camposObligatorios.forEach(function (campo) {
            const error = mensajeError(campo);
            const esInvalido = error !== '';
            const mensaje = campo.parentElement.querySelector('.invalid-feedback');
            campo.classList.toggle('is-invalid', esInvalido);

            if (mensaje) mensaje.textContent = error;

            if (esInvalido) {
                campo.setAttribute('aria-invalid', 'true');
            } else {
                campo.removeAttribute('aria-invalid');
            }
        });

        if (camposInvalidos.length > 0) {
            e.preventDefault();

            const primerCampo = camposInvalidos[0];
            primerCampo.scrollIntoView({ behavior: 'smooth', block: 'center' });
            setTimeout(function () { primerCampo.focus(); }, 350);

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'warning',
                    title: camposInvalidos.length === 1
                        ? 'Revise el campo marcado en rojo.'
                        : `Revise los ${camposInvalidos.length} campos marcados en rojo.`,
                    text: mensajeError(primerCampo),
                    showConfirmButton: false,
                    timer: 4500,
                    timerProgressBar: true,
                });
            }
        }
    });
});

</script>
@endsection
