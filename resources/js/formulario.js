document.addEventListener('DOMContentLoaded', function () {
    const ciInput = document.getElementById('buscar_ci');
    const listaSugerencias = document.getElementById('lista_sugerencias');

    ciInput.addEventListener('input', function () {
        const term = ciInput.value.trim();
        if (term.length === 0) {
            listaSugerencias.innerHTML = '';
            listaSugerencias.style.display = 'none';
            return;
        }
        
        fetch(`http://192.168.2.102:8000/buscar-paciente?term=${encodeURIComponent(term)}`)
        //fetch(`/buscar-paciente?term=${encodeURIComponent(term)}`)
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
        const nombreCompleto = `${user.nombres || ''} ${user.p_apellido || ''} ${user.ci || ''}`.trim();
       document.querySelector('input[name="id_paciente"]').value = nombreCompleto;


            listaSugerencias.style.display = 'none';
        }
    });

    document.addEventListener('click', function (e) {
        if (!listaSugerencias.contains(e.target) && e.target !== ciInput) {
            listaSugerencias.style.display = 'none';
        }
    });
});
