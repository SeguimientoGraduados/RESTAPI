<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('ciudades')->group(function () {
    Route::get('/');
});