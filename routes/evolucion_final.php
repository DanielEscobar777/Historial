<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvolucionController;

Route::post('/evolucion/store', [EvolucionController::class, 'store'])->name('evolucion.store');
