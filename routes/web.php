<?php

use App\Models\Programa;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PantallasController;
use App\Http\Controllers\Administracion\Cohortes\CohorteController;
use App\Http\Controllers\Administracion\Docentes\DocenteController;
use App\Http\Controllers\Administracion\Programas\ProgramaController;
use App\Http\Controllers\Administracion\Coordinadores\ProfileController;
use App\Http\Controllers\Administracion\Estudiantes\EstudianteController;
use App\Http\Controllers\Administracion\Presidentes\PresidenteController;
use App\Http\Controllers\Administracion\Programas\NuevoProgramaController;
use App\Http\Controllers\Administracion\Coordinadores\CoordinadorController;
use App\Http\Controllers\Administracion\Asistentes\AsistenteController;

// Ruta para la página principal
Route::get('/', function () {
    return view('welcome');
})->name('login');




//ruta de sección
Route::post('login', [AuthController::class, 'login'])->name('auth.login');
Route::post('logout', [AuthController::class, 'logout'])->name('auth.logout');

//ruta para el precidente
Route::resource('presidentes', PresidenteController::class);

//Ruta para la recuperación de contraseña
Route::get('/RecuperacionContraseña', [PantallasController::class, 'RecuperacionContraseña'])->name('RecuperacionContraseña');

//ruta para la pagina de error si no esta autenticado
Route::get('/pantallaError', [PantallasController::class, 'pantallaError'])->name('pantallaError');

Route::middleware(['pantallaError'])->group(function () {

    //ruta para el dashboard
    Route::get('/paginaPrincipal', [PantallasController::class, 'paginaPrincipal'])->name('paginaPrincipal');

    // rutas para el coordinador (crud)
    Route::get('coordinadores', [CoordinadorController::class, 'index'])->name('coordinadores.index');
    Route::get('coordinadores/create', [CoordinadorController::class, 'create'])->name('coordinadores.create');
    Route::post('coordinadores', [CoordinadorController::class, 'store'])->name('coordinadores.store');
    Route::get('coordinadores/{coordinador}', [CoordinadorController::class, 'show'])->name('coordinadores.show');
    Route::get('coordinadores/{coordinador}/edit', [CoordinadorController::class, 'edit'])->name('coordinadores.edit');
    Route::put('/coordinadores/{coordinador}', [CoordinadorController::class, 'update'])->name('coordinadores.update');
    Route::delete('coordinadores/{coordinador}', [CoordinadorController::class, 'destroy'])->name('coordinadores.destroy');

    // rutas para el asistente (crud)
    Route::get('asistentes', [AsistenteController::class, 'index'])->name('asistentes.index');
    Route::get('asistentes/create', [AsistenteController::class, 'create'])->name('asistentes.create');
    Route::post('asistentes', [AsistenteController::class, 'store'])->name('asistentes.store');
    Route::get('asistentes/{asistente}', [AsistenteController::class, 'show'])->name('asistentes.show');
    Route::get('asistentes/{asistente}/edit', [AsistenteController::class, 'edit'])->name('asistentes.edit');
    Route::put('/asistentes/{asistente}', [AsistenteController::class, 'update'])->name('asistentes.update');
    Route::delete('asistentes/{asistente}', [AsistenteController::class, 'destroy'])->name('asistentes.destroy');

    // Rutas para los programas
    Route::prefix('administracion/programas')->group(function () {
        Route::get('/', [NuevoProgramaController::class, 'index'])->name('programas.index');
        Route::get('programas/create', [NuevoProgramaController::class, 'create'])->name('programas.create');
        Route::post('/', [NuevoProgramaController::class, 'store'])->name('programas.store');
        Route::get('programas/{programa}', [NuevoProgramaController::class, 'show'])->name('programas.show');
        Route::get('programas/{programa}/edit', [NuevoProgramaController::class, 'edit'])->name('programas.edit');
        Route::put('programas/{programa}', [NuevoProgramaController::class, 'update'])->name('programas.update');
        Route::delete('programas/{programa}', [NuevoProgramaController::class, 'destroy'])->name('programas.destroy');
    });


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

    // rutas para el presidente (crud)
    Route::get('presidente', [PresidenteController::class, 'index'])->name('presidente.index');
    Route::get('presidente/create', [PresidenteController::class, 'create'])->name('presidente.create');
    Route::post('presidente', [PresidenteController::class, 'store'])->name('presidente.store');
    Route::get('presidente/{coordinador}', [PresidenteController::class, 'show'])->name('presidente.show');
    Route::get('presidente/{coordinador}/edit', [PresidenteController::class, 'edit'])->name('presidente.edit');
    Route::put('/presidente/{coordinador}', [PresidenteController::class, 'update'])->name('presidente.update');
    Route::delete('presidente/{coordinador}', [PresidenteController::class, 'destroy'])->name('presidente.destroy');


    //rutas para la configuracion del perfil del coordinador
    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/perfil', [ProfileController::class, 'update'])->name('profile.update');
});
