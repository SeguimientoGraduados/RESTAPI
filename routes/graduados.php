<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraduadoController;

Route::prefix('/graduados')->group(function () {
    Route::get('/', [GraduadoController::class, 'obtenerGraduadosConFiltros']);
});