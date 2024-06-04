<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginRegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(LoginRegisterController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);
});

Route::middleware(['auth:sanctum', 'rol:admin'])->prefix('admin')->group(function () {
    Route::get('/getAdmin', [UserController::class, 'obtenerAdmin']);
});

Route::middleware(['auth:sanctum', 'rol:user'])->prefix('user')->group(function () {
    Route::get('/getUser', [UserController::class, 'obtenerUser']);
});


include 'graduados.php';
include 'ciudades.php';
include 'carreras.php';