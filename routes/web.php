<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PantallasController;


// Ruta para la página principal
Route::get('/', function () {
    return view('welcome');
})->name('login');

//ruta para el dashboard
Route::get('/paginaPrincipal', [PantallasController::class, 'paginaPrincipal'])->name('paginaPrincipal');

//Ruta para la recuperación de contraseña.
Route::get('/RecuperacionContraseña', [PantallasController::class, 'RecuperacionContraseña'])->name('RecuperacionContraseña');
