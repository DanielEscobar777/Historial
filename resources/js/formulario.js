const apiBaseUrl = import.meta.env.VITE_APP_API_URL || '';

document.addEventListener('DOMContentLoaded', function () {
    const ciInput = document.getElementById('buscar_ci');
    const complementoInput = document.getElementById('buscar_complemento');
    const buscarButton = document.getElementById('buscar_paciente_btn');
    const listaSugerencias = document.getElementById('lista_sugerencias');

    if (!ciInput || !buscarButton || !listaSugerencias) return;

    let requestController;

    function limpiarSugerencias() {
        listaSugerencias.innerHTML = '';
        listaSugerencias.style.display = 'none';
    }

    function mostrarToast(icon, title) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon,
                title,
                showConfirmButton: false,
                timer: 3500,
                timerProgressBar: true,
            });
        }
    }

    function cambiarEstadoBusqueda(buscando) {
        buscarButton.disabled = buscando;
        buscarButton.innerHTML = buscando
            ? '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Buscando...'
            : '<i class="fa fa-search"></i> Buscar';
    }

    async function buscarPaciente() {
        const term = ciInput.value.trim();
        const complemento = complementoInput?.value.trim() || '';

        if (term.length < 3) {
            limpiarSugerencias();
            mostrarToast('info', 'Ingrese un C.I. válido para realizar la búsqueda.');
            ciInput.focus();
            return;
        }

        requestController?.abort();
        requestController = new AbortController();
        cambiarEstadoBusqueda(true);

        try {
            const params = new URLSearchParams({ term, complemento });
            const response = await fetch(`${apiBaseUrl}/buscar-paciente?${params.toString()}`, {
                signal: requestController.signal,
                headers: { Accept: 'application/json' },
            });
            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'No fue posible consultar el servicio de pacientes.');
            }

            limpiarSugerencias();

            if (!Array.isArray(data) || data.length === 0) {
                mostrarToast('info', 'No encontramos un paciente con ese C.I. y complemento.');
                return;
            }

            data.forEach(usuario => {
                const div = document.createElement('div');
                div.classList.add('list-group-item', 'list-group-item-action');
                div.style.cursor = 'pointer';
                div.textContent = `${usuario.ci}${usuario.complemento ? `-${usuario.complemento}` : ''} - ${usuario.nombres || ''} ${usuario.p_apellido || ''}`;
                div.dataset.usuario = JSON.stringify(usuario);
                listaSugerencias.appendChild(div);
            });

            listaSugerencias.style.display = 'block';
        } catch (error) {
            if (error.name === 'AbortError') return;

            console.error('Error al buscar pacientes:', error);
            limpiarSugerencias();
            mostrarToast('error', error.message || 'No pudimos consultar el servicio de pacientes.');
        } finally {
            cambiarEstadoBusqueda(false);
        }
    }

    function buscarConEnter(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            buscarPaciente();
        }
    }

    buscarButton.addEventListener('click', buscarPaciente);
    ciInput.addEventListener('keydown', buscarConEnter);
    complementoInput?.addEventListener('keydown', buscarConEnter);

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
        if (complementoInput) complementoInput.value = user.complemento || '';
        document.querySelector('input[name="nacionalidad"]').value = user.nacionalidad || '';
        document.querySelector('input[name="matricula_seguro"]').value = user.matricula_seguro || '';
        document.querySelector('input[name="residencia"]').value = user.residencia || '';
        const nombreCompleto = `${user.nombres || ''} ${user.p_apellido || ''} ${user.ci || ''}`.trim();
       document.querySelector('input[name="id_paciente"]').value = nombreCompleto;

            limpiarSugerencias();
            mostrarToast('success', 'Paciente seleccionado. Sus datos fueron cargados.');
        }
    });

    document.addEventListener('click', function (e) {
        if (!listaSugerencias.contains(e.target) && e.target !== ciInput) {
            listaSugerencias.style.display = 'none';
        }
    });
});
