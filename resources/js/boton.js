document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    if (!form) return;

    const submitButton = form.querySelector("button[type='submit']");

    form.addEventListener("submit", function (e) {
        // Desactiva el botón para prevenir múltiples envíos
        if (submitButton) {
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Guardando...';
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

            nombreInput.value = nombreGenerado;
        }
    });
});
