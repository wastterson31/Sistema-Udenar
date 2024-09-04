<?php

use App\Models\Programa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PantallasController;
use App\Http\Controllers\Administracion\Cohortes\CohorteController;
use App\Http\Controllers\Administracion\Docentes\DocenteController;
use App\Http\Controllers\Administracion\Programas\ProgramaController;
use App\Http\Controllers\Administracion\Estudiantes\EstudianteController;
use App\Http\Controllers\Administracion\Coordinadores\CoordinadorController;

// Ruta para la página principal
Route::get('/', function () {
    return view('welcome');
})->name('login');

//ruta para el dashboard
Route::get('/paginaPrincipal', [PantallasController::class, 'paginaPrincipal'])->name('paginaPrincipal');

//Ruta para la recuperación de contraseña
Route::get('/RecuperacionContraseña', [PantallasController::class, 'RecuperacionContraseña'])->name('RecuperacionContraseña');


// rutas para el coordinador (crud)
Route::get('coordinadores', [CoordinadorController::class, 'index'])->name('coordinadores.index');
Route::get('coordinadores/create', [CoordinadorController::class, 'create'])->name('coordinadores.create');
Route::post('coordinadores', [CoordinadorController::class, 'store'])->name('coordinadores.store');
Route::get('coordinadores/{coordinador}', [CoordinadorController::class, 'show'])->name('coordinadores.show');
Route::get('coordinadores/{coordinador}/edit', [CoordinadorController::class, 'edit'])->name('coordinadores.edit');
Route::put('/coordinadores/{coordinador}', [CoordinadorController::class, 'update'])->name('coordinadores.update');
Route::delete('coordinadores/{coordinador}', [CoordinadorController::class, 'destroy'])->name('coordinadores.destroy');


// Rutas para los programas
Route::get('/programas', [ProgramaController::class, 'index'])->name('programas.index');
Route::get('programas/create', [ProgramaController::class, 'create'])->name('programas.create');
Route::post('programas', [ProgramaController::class, 'store'])->name('programas.store');
Route::get('programas/{programa}', [ProgramaController::class, 'show'])->name('programas.show');
Route::get('programas/{programa}/edit', [ProgramaController::class, 'edit'])->name('programas.edit');
Route::put('programas/{programa}', [ProgramaController::class, 'update'])->name('programas.update');
Route::delete('programas/{programa}', [ProgramaController::class, 'destroy'])->name('programas.destroy');

// Rutas para los estudiantes
Route::prefix('administracion/estudiantes')->group(function () {
    Route::get('/', [EstudianteController::class, 'index'])->name('estudiantes.index');
    Route::get('/create', [EstudianteController::class, 'create'])->name('estudiantes.create');
    Route::post('/', [EstudianteController::class, 'store'])->name('estudiantes.store');
    Route::get('/{estudiante}', [EstudianteController::class, 'show'])->name('estudiantes.show');
    Route::get('/{estudiante}/edit', [EstudianteController::class, 'edit'])->name('estudiantes.edit');
    Route::put('/{estudiante}', [EstudianteController::class, 'update'])->name('estudiantes.update');
    Route::delete('/{estudiante}', [EstudianteController::class, 'destroy'])->name('estudiantes.destroy');
});

// Rutas para las cohortes
Route::prefix('cohortes')->name('cohortes.')->group(function () {
    Route::get('/', [CohorteController::class, 'index'])->name('index');
    Route::get('/create', [CohorteController::class, 'create'])->name('create');
    Route::post('/', [CohorteController::class, 'store'])->name('store');
    Route::get('/{cohorte}', [CohorteController::class, 'show'])->name('show');
    Route::get('/{cohorte}/edit', [CohorteController::class, 'edit'])->name('edit');
    Route::put('/{cohorte}', [CohorteController::class, 'update'])->name('update');
    Route::delete('/{cohorte}', [CohorteController::class, 'destroy'])->name('destroy');
});

// Rutas para los docentes
Route::prefix('docentes')->name('docentes.')->group(function () {
    Route::get('/', [DocenteController::class, 'index'])->name('index');
    Route::get('/create', [DocenteController::class, 'create'])->name('create');
    Route::post('/', [DocenteController::class, 'store'])->name('store');
    Route::get('/{docente}', [DocenteController::class, 'show'])->name('show');
    Route::get('/{docente}/edit', [DocenteController::class, 'edit'])->name('edit');
    Route::put('/{docente}', [DocenteController::class, 'update'])->name('update');
    Route::delete('/{docente}', [DocenteController::class, 'destroy'])->name('destroy');
});
