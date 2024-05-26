<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CiudadController;

Route::prefix('ciudades')->group(function () {
    Route::get('/', [CiudadController::class, 'obtenerTodasLasCiudades']);
});