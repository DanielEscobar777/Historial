<div class="modal fade" id="soapPdfConfigModal" tabindex="-1" aria-labelledby="soapPdfConfigTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="soapPdfConfigTitle">Preparar hoja de evolución</h5>
                    <small class="text-muted">Ajuste la impresión y compruebe el resultado antes de abrir el PDF.</small>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <form id="soapPdfConfigForm" action="{{ route('pdf.generateSOAP') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_evolucion" id="soapEvolutionId">
                    <input type="hidden" name="page_overrides" id="soapPageOverrides" value="{}">

                    <div class="row g-0">
                        <div class="col-lg-5 border-end p-3 p-lg-4" style="max-height: 72vh; overflow-y: auto;">
                            <div id="soapPdfAlert" class="alert d-none" role="alert"></div>

                            <label class="form-label fw-semibold" for="soapPreset">Configuración rápida</label>
                            <select class="form-select mb-3" id="soapPreset">
                                <option value="preprinted">Hoja preimpresa (recomendado)</option>
                                <option value="white">Papel blanco</option>
                                <option value="custom">Personalizada</option>
                            </select>

                            <div class="card mb-3">
                                <div class="card-header fw-semibold">Texto</div>
                                <div class="card-body row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="soapFontFamily">Tipo de letra</label>
                                        <select class="form-select soap-setting" name="font_family" id="soapFontFamily">
                                            <option value="verdana">Verdana</option>
                                            <option value="dejavu">DejaVu Sans</option>
                                            <option value="helvetica">Helvetica</option>
                                            <option value="times">Times</option>
                                            <option value="courier">Courier</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="soapFontSize">Tamaño (pt)</label>
                                        <input class="form-control soap-setting" type="number" name="font_size" id="soapFontSize" value="7" min="4" max="36" step="0.5">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="soapLineHeight">Interlineado</label>
                                        <input class="form-control soap-setting" type="number" name="line_height" id="soapLineHeight" value="1.15" min="0.8" max="4" step="0.05">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="soapParagraphSpacing">Espacio entre párrafos (pt)</label>
                                        <input class="form-control soap-setting" type="number" name="paragraph_spacing" id="soapParagraphSpacing" value="3" min="0" max="72" step="0.5">
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header fw-semibold">Márgenes generales (cm)</div>
                                <p class="small text-muted px-3 pt-2 mb-0">A4: 21 × 29,7 cm. Deje al menos 4 cm de ancho y 3 cm de alto para el contenido. Al imprimir, seleccione tamaño real (100%).</p>
                                <div class="card-body row g-3">
                                    @foreach(['top' => 'Superior', 'right' => 'Derecho', 'bottom' => 'Inferior', 'left' => 'Izquierdo'] as $side => $label)
                                        <div class="col-6">
                                            <label class="form-label" for="soapMargin{{ ucfirst($side) }}">{{ $label }}</label>
                                            <input class="form-control soap-setting" type="number" name="margin_{{ $side }}" id="soapMargin{{ ucfirst($side) }}" value="{{ in_array($side, ['top', 'bottom']) ? '2.5' : '3' }}" min="0" max="{{ in_array($side, ['top', 'bottom']) ? 26 : 17 }}" step="0.1">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header fw-semibold">Distribución de las dos columnas</div>
                                <div class="card-body row g-3">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="soapLeftColumn">Columna de signos vitales (%)</label>
                                        <input class="form-control soap-setting" type="number" name="left_column" id="soapLeftColumn" value="25" min="5" max="90" step="1">
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label" for="soapColumnGap">Separación (%)</label>
                                        <input class="form-control soap-setting" type="number" name="column_gap" id="soapColumnGap" value="5" min="0" max="50" step="1">
                                    </div>
                                    <div class="col-12">
                                        <div class="progress" style="height: 22px;" aria-label="Distribución de columnas">
                                            <div id="soapLeftColumnBar" class="progress-bar bg-secondary">25%</div>
                                            <div id="soapColumnGapBar" class="progress-bar bg-light text-dark">5%</div>
                                            <div id="soapRightColumnBar" class="progress-bar bg-info text-dark">70%</div>
                                        </div>
                                        <small class="text-muted">Gris: signos vitales · Celeste: nota de evolución</small>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold">Márgenes por hoja</span>
                                    <span class="badge bg-secondary" id="soapPageCount">Sin previsualizar</span>
                                </div>
                                <div class="card-body">
                                    <label class="form-label" for="soapSelectedPage">Hoja que desea ajustar</label>
                                    <select class="form-select mb-3" id="soapSelectedPage" disabled>
                                        <option value="1">Hoja 1</option>
                                    </select>
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="soapCustomPage" disabled>
                                        <label class="form-check-label" for="soapCustomPage">Usar márgenes propios en esta hoja</label>
                                    </div>
                                    <div id="soapPageFields" class="row g-2 opacity-50">
                                        @foreach(['top' => 'Superior', 'right' => 'Derecha', 'bottom' => 'Inferior', 'left' => 'Izquierda'] as $side => $label)
                                            <div class="col-6">
                                                <label class="form-label small" for="soapPage{{ ucfirst($side) }}">Margen {{ strtolower($label) }} (cm)</label>
                                                <input class="form-control form-control-sm soap-page-setting" type="number" id="soapPage{{ ucfirst($side) }}" data-key="{{ $side }}" value="0" min="0" max="{{ in_array($side, ['top', 'bottom']) ? 26 : 17 }}" step="0.1" disabled>
                                            </div>
                                        @endforeach
                                        <div class="col-12">
                                            <label class="form-label small" for="soapPageScale">Escala del contenido (%)</label>
                                            <input class="form-range soap-page-setting" type="range" id="soapPageScale" data-key="scale" value="100" min="10" max="100" step="1" disabled>
                                            <div class="text-center small"><span id="soapPageScaleValue">100</span>%</div>
                                        </div>
                                    </div>
                                    <div class="alert alert-info py-2 px-3 small mt-3 mb-0">
                                        Estos valores alinean el contenido sobre una hoja preimpresa y sustituyen los márgenes generales en la hoja seleccionada. Para cambiar la cantidad de hojas, ajuste los márgenes generales, el tamaño de letra o el interlineado.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-7 bg-dark p-3 d-flex flex-column" style="min-height: 72vh;">
                            <div class="d-flex justify-content-between align-items-center text-white mb-2">
                                <span class="fw-semibold">Previsualización</span>
                                <span id="soapPreviewStatus" class="small">Seleccione una evolución</span>
                            </div>
                            <div id="soapPreviewLoading" class="d-none text-center text-white my-auto">
                                <div class="spinner-border mb-2" role="status"></div>
                                <div>Preparando la previsualización…</div>
                            </div>
                            <iframe id="soapPdfPreview" class="bg-white rounded flex-grow-1" title="Previsualización del PDF de evolución" style="width:100%; min-height:620px; border:0;"></iframe>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" id="soapResetSettings">Restablecer</button>
                <button type="button" class="btn btn-outline-primary" id="soapRefreshPreview"><i class="fa fa-rotate"></i> Actualizar vista</button>
                <button type="button" class="btn btn-outline-danger" id="soapDownloadPdf"><i class="fa fa-download"></i> Descargar PDF</button>
                <button type="button" class="btn btn-danger" id="soapOpenPdf"><i class="fa fa-file-pdf"></i> Abrir PDF para imprimir</button>
            </div>
        </div>
    </div>
</div>
