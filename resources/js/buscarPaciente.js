async function actualizarRecienNacidos() {
    try {
        const res = await fetch('/pacientes/actualizar-recien-nacidos');
        const text = await res.text(); // leer como texto primero

        console.log("Respuesta cruda:", text);
        let data;
        try {
            data = JSON.parse(text);
        } catch (e) {
            console.error('Error al parsear JSON:', text);
            throw new Error('La respuesta del servidor no es válida.');
        }

        
        console.log('Respuesta del backend:', data);

        // Solo ejecutar forEach si es un array
        if (Array.isArray(data)) {
            data.forEach(entry => {
                const tipo = entry.tipo || 'info';
                let icon = 'info';
                let title = 'Información del paciente';

                switch (tipo) {
                    case 'creado':
                        icon = 'success';
                        title = 'Paciente actualizado';
                        break;
                    case 'conflicto_api':
                    case 'conflicto_bd':
                        icon = 'warning';
                        title = 'Coincidencia múltiple';
                        break;
                    case 'no_encontrado':
                        icon = 'error';
                        title = 'Paciente no encontrado';
                        break;
                }

                Swal.fire({
                    title: title,
                    html: `
                        <div style="text-align: left; font-size: 15px;">
                            <p><strong>Nombre:</strong> ${entry.paciente}</p>
                            <p>${entry.mensaje}</p>
                        </div>
                    `,
                    icon: icon,
                  // position: 'top-end',
                    showConfirmButton: false,
                    showCloseButton: true,
                    background: '#f5f5f5'
                    
                });
            });

        } else if (typeof data === 'object' && data !== null) {
            // Manejo de respuesta con error o mensaje
            const mensaje = data.mensaje || data.error || 'Respuesta inesperada del servidor.';
            const estaSincronizando = data.estado === 'sincronizando';
            const icon = data.error ? 'error' : 'info';
            const title = estaSincronizando
                ? 'Datos de pacientes en actualización'
                : (data.error ? 'No se pudo completar la actualización' : 'Aviso');

            Swal.fire({
                title: title,
                text: mensaje,
                icon: icon,
                showCloseButton: true,
                confirmButtonText: 'Cerrar',
                background: '#fefefe',
                width: '30em'
            });

        } else {
            // En caso de respuesta extraña (ni objeto ni array)
            Swal.fire({
                title: 'Formato desconocido',
                text: JSON.stringify(data),
                icon: 'question',
                showCloseButton: true,
                confirmButtonText: 'Aceptar',
                background: '#fefefe'
            });
        }

    } catch (err) {
        console.error('Error al actualizar los pacientes recién nacidos:', err);
        Swal.fire({
            title: 'No se pudo consultar a los pacientes',
            text: 'No fue posible comunicarse con el servidor. Intente nuevamente en unos minutos.',
            icon: 'error',         
            showCloseButton: true,
            confirmButtonText: 'Cerrar',
            background: '#fefefe'
        });
    }
}

let yaActualizado = false;

document.addEventListener('DOMContentLoaded', () => {
    if (!yaActualizado) {
        actualizarRecienNacidos();
        yaActualizado = true;
    }
});







