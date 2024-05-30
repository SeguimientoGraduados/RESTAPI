<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarreraController;

Route::prefix('carreras')->group(function () {
    Route::get('/', [CarreraController::class, 'obtenerTodasLasCarreras']);
});