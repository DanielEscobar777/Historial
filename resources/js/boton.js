document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[data-servicio]");
    if (!form) return;

    const submitButton = form.querySelector("button[type='submit']");
    if (!submitButton) return;

    const originalButtonHtml = submitButton.innerHTML;
    let submitting = false;

    const restoreButton = function () {
        submitButton.disabled = false;
        submitButton.innerHTML = originalButtonHtml;
        submitting = false;
    };

    // Si el navegador o una validación personalizada rechazan el formulario,
    // el botón debe permanecer disponible para volver a intentarlo.
    form.addEventListener("invalid", restoreButton, true);
    window.addEventListener("pageshow", restoreButton);

    form.addEventListener("submit", function (e) {
        if (submitting) {
            e.preventDefault();
            return;
        }

        if (e.defaultPrevented || !form.checkValidity()) {
            restoreButton();
            return;
        }

        const servicio = form.getAttribute("data-servicio");

        if (servicio === "NEONATOLOGIA") {
            let nombreInput = form.querySelector("input[name='nombre_recien_necido']");
            let camaInput = form.querySelector("input[name='cama']");
            let fechaInput = form.querySelector("input[name='fecha_recien_necido']");
            let horaInput = form.querySelector("input[name='hora_recien_necido']");

            let nombreOriginal = nombreInput?.value.trim() || "SinNombre";
            let cama = camaInput?.value || "CamaDesconocida";
            let fecha = fechaInput?.value || "FechaDesconocida";
            let hora = horaInput?.value || "HoraDesconocida";

            // Formato: RN_fecha_hora_cama_nombreOriginal
            let nombreGenerado = `RN_${fecha.replaceAll("-", "")}_${hora.replaceAll(":", "")}_${cama.replaceAll(" ", "")}_${nombreOriginal.replaceAll(" ", "")}`;

            if (nombreInput) {
                nombreInput.value = nombreGenerado;
            }
        }

        // Se ejecuta después de los demás validadores del formulario. De ese
        // modo no queda bloqueado si alguno cancela el envío.
        setTimeout(function () {
            if (e.defaultPrevented) {
                restoreButton();
                return;
            }

            submitting = true;
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
        }, 0);
    });
});
