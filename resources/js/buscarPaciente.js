const statusStyles = {
    pending: { css: 'alert-warning', icon: 'fa-clock' },
    running: { css: 'alert-info', icon: 'fa-sync fa-spin' },
    completed: { css: 'alert-success', icon: 'fa-check-circle' },
    failed: { css: 'alert-danger', icon: 'fa-exclamation-circle' },
};

function renderSyncStatus(data) {
    const container = document.getElementById('estado-sincronizacion');
    if (!container) return;

    const style = statusStyles[data.state] || statusStyles.pending;
    container.className = `alert ${style.css} d-flex flex-wrap align-items-center justify-content-between text-start mb-4`;
    document.getElementById('estado-sincronizacion-titulo').innerHTML =
        `<i class="fa ${style.icon} me-2" aria-hidden="true"></i>${data.label || 'Estado de sincronización'}`;
    document.getElementById('estado-sincronizacion-mensaje').textContent =
        data.message || 'No hay información disponible.';
    document.getElementById('estado-sincronizacion-fecha').textContent = data.last_sync
        ? `Última sincronización correcta: ${data.last_sync}`
        : 'Todavía no existe una sincronización completada.';
}

async function cargarEstadoSincronizacion() {
    try {
        const response = await fetch('/pacientes/estado-sincronizacion', {
            headers: { Accept: 'application/json' },
        });
        if (!response.ok) throw new Error('No se pudo consultar el estado.');
        const data = await response.json();
        renderSyncStatus(data);
        return data;
    } catch (error) {
        renderSyncStatus({
            state: 'failed',
            label: 'Estado no disponible',
            message: 'No pudimos consultar el estado de la sincronización. Actualice la página para volver a intentarlo.',
        });
        return null;
    }
}

async function actualizarRecienNacidos() {
    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
        const response = await fetch('/pacientes/actualizar-recien-nacidos', {
            method: 'POST',
            headers: {
                Accept: 'application/json',
                'X-CSRF-TOKEN': csrfToken || '',
            },
        });
        const data = await response.json();

        if (!response.ok) {
            throw new Error(data.error || data.mensaje || 'No se pudo actualizar a los pacientes recién nacidos.');
        }

        if (!Array.isArray(data)) {
            if (data.estado) await cargarEstadoSincronizacion();
            return;
        }

        const totals = data.reduce((summary, entry) => {
            const type = entry.tipo || 'informacion';
            summary[type] = (summary[type] || 0) + 1;
            return summary;
        }, {});
        const updated = totals.creado || 0;
        const conflicts = (totals.conflicto_api || 0) + (totals.conflicto_bd || 0);
        const notFound = totals.no_encontrado || 0;

        if (updated + conflicts + notFound > 0 && typeof Swal !== 'undefined') {
            Swal.fire({
                title: updated > 0 ? 'Revisión de recién nacidos completada' : 'Revisión de recién nacidos',
                text: `${updated} paciente(s) actualizado(s). ${conflicts} caso(s) requieren revisión. ${notFound} paciente(s) aún no encontrado(s).`,
                icon: conflicts > 0 ? 'warning' : (updated > 0 ? 'success' : 'info'),
                confirmButtonText: 'Entendido',
            });
        }
    } catch (error) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'No se pudo completar la revisión',
                text: error.message || 'Intente nuevamente en unos minutos.',
                icon: 'error',
                confirmButtonText: 'Cerrar',
            });
        }
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    const status = await cargarEstadoSincronizacion();

    if (status?.state === 'completed') {
        await actualizarRecienNacidos();
    }

    if (status?.state === 'pending' || status?.state === 'running') {
        const intervalId = window.setInterval(async () => {
            const updatedStatus = await cargarEstadoSincronizacion();
            if (!updatedStatus || !['pending', 'running'].includes(updatedStatus.state)) {
                window.clearInterval(intervalId);
                if (updatedStatus?.state === 'completed') await actualizarRecienNacidos();
            }
        }, 15000);
    }
});
