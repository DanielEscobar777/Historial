<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\LoginExternoController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\kardexController;

Route::get('/kardex/index', [kardexController::class, 'index'])->name('kardex.index');


require __DIR__.'/evolucion_temp.php';
require __DIR__.'/evolucion_final.php';

Route::get('/pacientes/buscar-recien-nacidos', [PacienteController::class, 'buscarRecienNacidos']);
Route::get('/pacientes/actualizar-recien-nacidos', [PacienteController::class, 'actualizarRecienNacidosDesdeApi']);

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name("login");
    Route::get('/registro', [AuthController::class, 'registro'])->name("registro");
    Route::post('/registrar', [AuthController::class, 'registrar'])->name("registrar");
    //Route::post('/loguear', [AuthController::class, 'loguear'])->name("loguear");
    Route::post('/loguear', [AuthController::class, 'loguear'])->name("loguear");
});
Route::middleware([RolAdministrador::class])->group(function () {
    Route::resource('usuarios', UsuarioController::class);
});
Route::middleware(['auth', 'externalauth'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
});

Route::middleware(['auth', 'externalauth'])->group(function () {
        Route::get('/ping-session', function () {
        return response()->json(['status' => 'ok']);
    });
Route::get('/welcome', [AuthController::class, 'welcome'])->name("welcome");
Route::get('/logout', [AuthController::class, 'logout'])->name("logout");
Route::get('/buscar-paciente', [PacienteController::class, 'buscarPorCI'])->name('buscar.paciente');
Route::get('/servicios/index', [App\Http\Controllers\ServiciosController::class, 'index'])->name('servicios.index');
Route::post('/servicios/store', [App\Http\Controllers\ServiciosController::class, 'store'])->name('servicios.store');
Route::get('/servicios/administrar/{id_servicio}', [App\Http\Controllers\ServiciosController::class, 'administrar'])->name('servicios.administrar');
Route::post('/servicios/store_permisos', [App\Http\Controllers\ServiciosController::class, 'store_permisos'])->name('servicios.store_permisos');

Route::get('/historial/index', [App\Http\Controllers\HistorialController::class, 'index'])->name('historial.index');
Route::get('/historial/formulario/{id_servicio}', [App\Http\Controllers\HistorialController::class, 'formulario'])->name('historial.formulario');
Route::get('/historial/show/{id_servicio}', [App\Http\Controllers\HistorialController::class, 'show'])->name('historial.show');
Route::get('/historial/edit/{id_historial}', [App\Http\Controllers\HistorialController::class, 'edit'])->name('historial.edit');
Route::post('/historial/store', [App\Http\Controllers\HistorialController::class, 'store'])->name('historial.store');

Route::put('/historial/update/{id_historial}', [App\Http\Controllers\HistorialController::class, 'update'])->name('historial.update');


Route::get('/servicios/acceso-areas', function () {
    return view('servicios.acceso_areas');
})->name('servicios.acceso_areas');
Route::post('/historial/guardar', [HistorialController::class, 'store'])->name('historial.store');
Route::post('/historial', [HistorialController::class, 'store'])->name('historial.store');
Route::get('/historial/secciones/{id_servicio}', [HistorialController::class, 'editSecciones'])->name('historial.secciones.edit');
Route::post('/historial/secciones/{id_servicio}', [HistorialController::class, 'updateSecciones'])->name('historial.secciones.update');
Route::get('/historial/edit/{id_historia}', [HistorialController::class, 'edit'])->name('historial.edit');
Route::put('/historial/update/{id_historia}', [App\Http\Controllers\HistorialController::class, 'update'])->name('historial.update');
Route::put('/antecedentes_perinatologicos/update/{id_antecedentes_perinatologicos}', [App\Http\Controllers\Antecedentes_perinatologicosController::class, 'update'])->name('antecedentes_perinatologicos.update');
Route::put('/antecedentes_inmunizacion/update/{id_antecedentes_perinatologicos}', [App\Http\Controllers\Antecedentes_inmunizacionsController::class, 'update'])->name('antecedentes_inmunizacion.update');
Route::put('/antecedentes_alimentarios/update/{id_antecedentes_perinatologicos}', [App\Http\Controllers\Antecedentes_alimentariosController::class, 'update'])->name('antecedentes_alimentarios.update');
Route::put('/antecedentes_familiares/update/{id_antecedentes_familiares}', [App\Http\Controllers\Antecedentes_familiaresController::class, 'update'])->name('antecedentes_familiares.update');
Route::put('/desarrollo_psicomotor/update/{id_desarrollo_psicomotor}', [App\Http\Controllers\Desarrollo_psicomotorsController::class, 'update'])->name('desarrollo_psicomotor.update');
Route::put('/antecedentes_heredofamiliares/update/{id_antecedentes_heredofamiliares}', [App\Http\Controllers\Antecedentes_heredofamiliaresController::class, 'update'])->name('antecedentes_heredofamiliares.update');
Route::put('/antecedentes_patologicos/update/{id_antecedentes_patologicos}', [App\Http\Controllers\Antecedentes_patologicosController::class, 'update'])->name('antecedentes_patologicos.update');
Route::put('/antecedentes_no_patologicos/update/{id_antecedentes_no_patologicos}', [App\Http\Controllers\Antecedentes_no_patologicosController::class, 'update'])->name('antecedentes_no_patologicos.update');
Route::put('/antecedentes_gineco_obsteticos/update/{id_antecedentes_gineco}', [App\Http\Controllers\Antecedentes_gineco_obstetricosController::class, 'update'])->name('antecedentes_gineco_obsteticos.update');
Route::put('/anamnesis_sistemas/update/{id_anamnesis_sistema}', [App\Http\Controllers\Anamnesis_sistemasController::class, 'update'])->name('anamnesis_sistemas.update');
Route::put('/motivo_de_internacion/update/{id_motivo_de_internacion}', [App\Http\Controllers\Motivo_de_internacionController::class, 'update'])->name('motivo_de_internacion.update');
Route::put('/examen_fisico_general/update/{id_examen_general}', [App\Http\Controllers\Examen_fisico_generalController::class, 'update'])->name('examen_fisico_general.update');
Route::put('/examen_fisico_segmentado/update/{id_examen_fisico_segmentado}', [App\Http\Controllers\Examen_fisico_segmentadoController::class, 'update'])->name('examen_fisico_segmentado.update');
Route::put('/examen_obstetrico/update/{id_examen_obstetrico}', [App\Http\Controllers\Examen_obstetricoController::class, 'update'])->name('examen_obstetrico.update');
Route::put('/examen_ginecologico/update/{id_examen_ginecologico}', [App\Http\Controllers\Examen_ginecologicoController::class, 'update'])->name('examen_ginecologico.update');
Route::put('/examen_cardiovascular/update/{id_examen_cardiovascular}', [App\Http\Controllers\Examen_cardiovascularController::class, 'update'])->name('examen_cardiovascular.update');
Route::put('/examen_genito_urinario/update/{id_examen_genitourinario}', [App\Http\Controllers\Examen_genito_urinarioController::class, 'update'])->name('examen_genito_urinario.update');
Route::put('/examen_extremidades_superiores/update/{id_extremidades_superiores}', [App\Http\Controllers\Examen_extremidades_superioresController::class, 'update'])->name('examen_extremidades_superiores.update');
Route::put('/examen_extremidades_inferiores/update/{id_extremidades_inferiores}', [App\Http\Controllers\Examen_extremidades_inferioresController::class, 'update'])->name('examen_extremidades_inferiores.update');
Route::put('/dermatologia/update/{id_dermatologia}', [App\Http\Controllers\DermatologiaController::class, 'update'])->name('dermatologia.update');
Route::put('/ganglios/update/{id_ganglios}', [App\Http\Controllers\Ganglios_linfaticosController::class, 'update'])->name('ganglios.update');
Route::put('/sistema_nervioso/update/{id_sistema_nervioso}', [App\Http\Controllers\Sistema_nerviosoController::class, 'update'])->name('sistema_nervioso.update');
Route::put('/sistema_motor/update/{id_sistema_motor}', [App\Http\Controllers\Sistema_motorController::class, 'update'])->name('sistema_motor.update');
Route::put('/sistema_sensitivo/update/{id_sistema_sensitivo}', [App\Http\Controllers\Sistema_sensitivoController::class, 'update'])->name('sistema_sensitivo.update');
Route::put('/diagnostico_sindromatico/update/{id_diagnostico}', [App\Http\Controllers\Diagnostico_sindromaticoController::class, 'update'])->name('diagnostico_sindromatico.update');
Route::put('/examenes_complementarios/update/{id_examenes_complementarios}', [App\Http\Controllers\Examenes_complementariosController::class, 'update'])->name('examenes_complementarios.update');
Route::put('/impresion_diadnostica/update/{id_impresion_diagnostica}', [App\Http\Controllers\Impresion_diagnosticaController::class, 'update'])->name('impresion_diadnostica.update');
Route::put('/comentarios/update/{id_comentarios}', [App\Http\Controllers\ComentariosController::class, 'update'])->name('comentarios.update');
Route::put('/interpretacion/update/{id_interpretacion}', [App\Http\Controllers\Interpretacion_laboratoriosController::class, 'update'])->name('interpretacion.update');
Route::put('/historia_enfermedad_actual/update/{id_historia_enfermedad}', [App\Http\Controllers\historia_enfermedad_actualController::class, 'update'])->name('historia_enfermedad_actual.update');


Route::resource('usuarios', UsuarioController::class);

Route::get('/generate-pdf/{id_historial}', [PdfController::class, 'generatePdf'])->name('pdf.generatePdf');
////////////////////////
Route::post('/pdf', [App\Http\Controllers\PdfController::class, 'generateSOAP'])->name('pdf.generateSOAP');
Route::get('/generate_soap', [App\Http\Controllers\PdfController::class, 'generateSOAP_internos'])->name('pdf.generateSOAP_internos');

Route::get('/pdf/', [PdfController::class, 'pdf'])->name('pdf.pdf');

Route::get('/evolucion/edit/{id_historial}', [App\Http\Controllers\EvolucionController::class, 'edit'])->name('evolucion.edit');
Route::get('/evolucion/edit_evolucion/{id_evolucion}', [App\Http\Controllers\EvolucionController::class, 'edit_evolucion'])->name('evolucion.edit_evolucion');
Route::put('/evolucion/update/{id_evolucion}', [App\Http\Controllers\EvolucionController::class, 'update'])->name('evolucion.update');

Route::put('/diagnostico/update/{id_diagnostico}', [App\Http\Controllers\DiagnosticoSoapController::class, 'update'])->name('diagnostico.update');

Route::get('/evolucion/index', [App\Http\Controllers\EvolucionController::class, 'index'])->name('evolucion.index');
Route::get('/evolucion/formulario_soap', [App\Http\Controllers\EvolucionController::class, 'formulario_soap'])->name('evolucion.formulario_soap');
Route::post('/evolucion/store_temp_internos', [App\Http\Controllers\EvolucionController::class, 'store_temp_internos'])->name('evolucion.store_temp_internos');
Route::delete('/evolucion/delete_internos/{id_temporal}', [App\Http\Controllers\EvolucionController::class, 'delete_internos'])->name('evolucion.delete_internos');
Route::post('/evolucion/store_internos', [App\Http\Controllers\EvolucionController::class, 'store_internos'])->name('evolucion.store_internos');
Route::get('/evolucion/edit_evolucion_interno/{id_evolucion}', [App\Http\Controllers\EvolucionController::class, 'edit_interno'])->name('evolucion.edit_interno');


Route::get('/auditoria/index', [App\Http\Controllers\AuditoriaController::class, 'index'])->name('auditoria.index');
Route::get('/auditoria/show/{id_servicio}', [App\Http\Controllers\AuditoriaController::class, 'show'])->name('auditoria.show');
Route::get('/auditoria/auditoria/{id_historia}', [App\Http\Controllers\AuditoriaController::class, 'auditoria'])->name('auditoria.auditoria');


Route::get('/preview-soap/{id_evolucion}', [PdfController::class, 'previewSOAP'])->name('preview.soap');


Route::get('/kardex/index', [App\Http\Controllers\kardexController::class, 'index'])->name('kardex.index');
Route::post('/kardex/consulta', [App\Http\Controllers\kardexController::class, 'consulta'])->name('kardex.consulta');
Route::get('/kardex/reporte', [App\Http\Controllers\kardexController::class, 'reporte'])->name('kardex.reporte');
Route::get('/kardex/soap/{id_historia}', [App\Http\Controllers\kardexController::class, 'soap'])->name('kardex.soap');


});