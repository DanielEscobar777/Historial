const modalElement = document.getElementById('soapPdfConfigModal');

if (modalElement) {
    const form = document.getElementById('soapPdfConfigForm');
    const evolutionId = document.getElementById('soapEvolutionId');
    const preview = document.getElementById('soapPdfPreview');
    const loading = document.getElementById('soapPreviewLoading');
    const status = document.getElementById('soapPreviewStatus');
    const alertBox = document.getElementById('soapPdfAlert');
    const pageSelect = document.getElementById('soapSelectedPage');
    const customPage = document.getElementById('soapCustomPage');
    const pageFields = document.getElementById('soapPageFields');
    const overridesInput = document.getElementById('soapPageOverrides');
    const storageKey = 'soap-pdf-settings-v1';
    let previewUrl = null;
    let pageOverrides = {};

    const presets = {
        preprinted: {font_family: 'verdana', font_size: 7, line_height: 1.15, paragraph_spacing: 3, margin_top: 2.5, margin_right: 3, margin_bottom: 2.5, margin_left: 3, left_column: 25, column_gap: 5},
        white: {font_family: 'dejavu', font_size: 9, line_height: 1.25, paragraph_spacing: 4, margin_top: 2, margin_right: 2, margin_bottom: 2, margin_left: 2, left_column: 25, column_gap: 5},
    };

    const showAlert = (message, type = 'danger') => {
        alertBox.className = `alert alert-${type}`;
        alertBox.textContent = message;
    };
    const hideAlert = () => alertBox.classList.add('d-none');
    const setBusy = (busy) => {
        loading.classList.toggle('d-none', !busy);
        preview.classList.toggle('d-none', busy);
        document.getElementById('soapRefreshPreview').disabled = busy;
        document.getElementById('soapOpenPdf').disabled = busy;
        status.textContent = busy ? 'Actualizando…' : 'Vista actualizada';
    };
    const field = (name) => form.elements.namedItem(name);

    const applyValues = (values) => {
        Object.entries(values).forEach(([name, value]) => {
            if (field(name)) field(name).value = value;
        });
        updateColumns();
    };

    const generalValues = () => Object.fromEntries(
        Array.from(form.querySelectorAll('.soap-setting')).map((input) => [input.name, input.value])
    );

    const saveSettings = () => {
        localStorage.setItem(storageKey, JSON.stringify(generalValues()));
        document.getElementById('soapPreset').value = 'custom';
    };

    const updateColumns = () => {
        const left = Number(field('left_column').value || 0);
        const gap = Number(field('column_gap').value || 0);
        const right = Math.max(0, 100 - left - gap);
        document.getElementById('soapLeftColumnBar').style.width = `${left}%`;
        document.getElementById('soapLeftColumnBar').textContent = `${left}%`;
        document.getElementById('soapColumnGapBar').style.width = `${gap}%`;
        document.getElementById('soapColumnGapBar').textContent = `${gap}%`;
        document.getElementById('soapRightColumnBar').style.width = `${right}%`;
        document.getElementById('soapRightColumnBar').textContent = `${right}%`;
    };

    const syncOverrideInput = () => {
        overridesInput.value = JSON.stringify(pageOverrides);
    };

    const renderPageFields = () => {
        const page = pageSelect.value;
        const values = pageOverrides[page] || {enabled: false, top: 0, right: 0, bottom: 0, left: 0, scale: 100};
        customPage.checked = Boolean(values.enabled);
        pageFields.classList.toggle('opacity-50', !values.enabled);
        pageFields.querySelectorAll('.soap-page-setting').forEach((input) => {
            input.disabled = !values.enabled;
            input.value = values[input.dataset.key] ?? (input.dataset.key === 'scale' ? 100 : 0);
        });
        document.getElementById('soapPageScaleValue').textContent = values.scale ?? 100;
    };

    const configurePages = (count) => {
        const previous = pageSelect.value;
        pageSelect.innerHTML = '';
        for (let page = 1; page <= count; page += 1) {
            pageSelect.add(new Option(`Hoja ${page}`, String(page)));
        }
        pageSelect.disabled = count < 1;
        customPage.disabled = count < 1;
        pageSelect.value = Number(previous) <= count ? previous : '1';
        document.getElementById('soapPageCount').textContent = `${count} ${count === 1 ? 'hoja' : 'hojas'}`;
        renderPageFields();
    };

    const responseMessage = async (response) => {
        try {
            const body = await response.json();
            const firstError = body.errors ? Object.values(body.errors).flat()[0] : null;
            return firstError || body.message || 'No se pudo generar la previsualización.';
        } catch {
            return 'No se pudo generar la previsualización. Intente nuevamente.';
        }
    };

    const refreshPreview = async () => {
        if (!evolutionId.value || !form.reportValidity()) return;
        hideAlert();
        syncOverrideInput();
        setBusy(true);
        const data = new FormData(form);
        data.set('output', 'preview');
        try {
            const response = await fetch(form.action, {
                method: 'POST',
                body: data,
                headers: {'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest'},
            });
            if (!response.ok) throw new Error(await responseMessage(response));
            if (previewUrl) URL.revokeObjectURL(previewUrl);
            previewUrl = URL.createObjectURL(await response.blob());
            preview.src = previewUrl;
            configurePages(Number(response.headers.get('X-PDF-Pages') || 1));
        } catch (error) {
            showAlert(error.message);
            status.dataset.error = 'true';
        } finally {
            setBusy(false);
            if (status.dataset.error) {
                status.textContent = 'No se pudo actualizar';
                delete status.dataset.error;
            }
        }
    };

    document.addEventListener('click', (event) => {
        const button = event.target.closest('.js-soap-pdf');
        if (!button) return;
        evolutionId.value = button.dataset.evolutionId;
        pageOverrides = {};
        syncOverrideInput();
        hideAlert();
        setTimeout(refreshPreview, 250);
    });

    document.getElementById('soapPreset').addEventListener('change', (event) => {
        if (presets[event.target.value]) {
            applyValues(presets[event.target.value]);
            localStorage.setItem(storageKey, JSON.stringify(generalValues()));
            refreshPreview();
        }
    });

    form.querySelectorAll('.soap-setting').forEach((input) => input.addEventListener('change', () => {
        saveSettings();
        updateColumns();
    }));

    pageSelect.addEventListener('change', renderPageFields);
    customPage.addEventListener('change', () => {
        const page = pageSelect.value;
        pageOverrides[page] = pageOverrides[page] || {top: 0, right: 0, bottom: 0, left: 0, scale: 100};
        pageOverrides[page].enabled = customPage.checked;
        syncOverrideInput();
        renderPageFields();
    });
    pageFields.querySelectorAll('.soap-page-setting').forEach((input) => input.addEventListener('input', () => {
        const page = pageSelect.value;
        pageOverrides[page] = pageOverrides[page] || {enabled: true};
        pageOverrides[page][input.dataset.key] = Number(input.value);
        if (input.dataset.key === 'scale') document.getElementById('soapPageScaleValue').textContent = input.value;
        syncOverrideInput();
    }));

    document.getElementById('soapRefreshPreview').addEventListener('click', refreshPreview);
    document.getElementById('soapResetSettings').addEventListener('click', () => {
        applyValues(presets.preprinted);
        pageOverrides = {};
        syncOverrideInput();
        document.getElementById('soapPreset').value = 'preprinted';
        localStorage.removeItem(storageKey);
        refreshPreview();
    });
    document.getElementById('soapOpenPdf').addEventListener('click', () => {
        if (!form.reportValidity()) return;
        syncOverrideInput();
        const output = document.createElement('input');
        output.type = 'hidden';
        output.name = 'output';
        output.value = 'preview';
        form.appendChild(output);
        const previousTarget = form.target;
        form.target = '_blank';
        form.submit();
        form.target = previousTarget;
        output.remove();
    });

    modalElement.addEventListener('hidden.bs.modal', () => {
        if (previewUrl) URL.revokeObjectURL(previewUrl);
        previewUrl = null;
        preview.removeAttribute('src');
    });

    try {
        const saved = JSON.parse(localStorage.getItem(storageKey));
        if (saved) {
            applyValues(saved);
            document.getElementById('soapPreset').value = 'custom';
        } else {
            applyValues(presets.preprinted);
        }
    } catch {
        applyValues(presets.preprinted);
    }
}
