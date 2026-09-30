
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvolucionController;

Route::get('/evolucion/formulario/{id_historia}', [EvolucionController::class, 'formulario'])->name('evolucion.formulario');
Route::post('/evolucion/store_temp', [EvolucionController::class, 'store_temp'])->name('evolucion.store_temp');
Route::delete('/evolucion/delete/{id_temporal}', [EvolucionController::class, 'delete'])->name('evolucion.delete');
