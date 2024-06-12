<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GraduadoController;

Route::prefix('/graduados')->group(function () {
    Route::get('/', [GraduadoController::class, 'obtenerGraduadosConFiltros']);
    Route::middleware('auth:sanctum')->group( function () {
        Route::post('/', [GraduadoController::class, 'registrarNuevoGraduado']);
        Route::get('/enumerados', [GraduadoController::class, 'obtenerEnumerados']);
    });
    Route::middleware(['auth:sanctum', 'rol:admin'])->group(function () {
        Route::get('/validar', [GraduadoController::class, 'obtenerGraduadosPorValidar']);
        Route::patch('/validar/aprobar/{id}', [GraduadoController::class,'aprobarGraduado']);
        Route::delete('/validar/rechazar/{id}', [GraduadoController::class,'rechazarGraduado']);
    });
});