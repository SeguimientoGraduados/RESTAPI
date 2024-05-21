<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('graduados')->group(function () {
    Route::get('/');
    Route::post('/registrar');
});