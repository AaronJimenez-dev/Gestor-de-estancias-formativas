<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ResultadoAprendizajeController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\EntregaController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\GradosController;
use App\Http\Controllers\CompetenciaTecnicaController;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    // Usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // manejo de alumnos
    Route::get('/usuario/me', [UsuarioController::class, 'getAuthUser']);
    Route::get('/grados-con-alumnos', [UsuarioController::class, 'listarGradosConAlumnos']);
    Route::get('/alumnos-por-grado', [UsuarioController::class, 'listarAlumnosPorGrado']);
    Route::get('/alumno', [UsuarioController::class, 'getAlumno']);

    // tipos de usuario
    Route::get('/esTutorCentro', [UsuarioController::class, 'esTutorCentro']);
    Route::get('/esAlumno', [UsuarioController::class, 'esAlumno']);

    Route::post('/guardarRA', [ResultadoAprendizajeController::class, 'store']);

    Route::get('/grados', [GradosController::class, 'getGrados']);
    Route::post('/guardarAlumno', [AlumnoController::class, 'store']);
    Route::post('/guardarUsuario', [UsuarioController::class, 'store']);

    // Rutas de grados
    Route::get('/grados', [GradoController::class, 'index']);

    // Rutas de entregas y cuadernos
    Route::post('/entregas', [EntregaController::class, 'store']);
    Route::get('/entregas', [EntregaController::class, 'index']);
    Route::get('/cuadernos', [EntregaController::class, 'verCuadernos']);
    Route::post('/cuadernos', [EntregaController::class, 'subirCuaderno']);
    
    Route::post('/logout', [AuthController::class, 'logout']);
});

// Rutas públicas (temporales - considera moverlas a auth:sanctum)
Route::post('/guardarEmpresa', [EmpresaController::class, 'store']);
Route::get('/buscarUsuario', [UsuarioController::class, 'search']);
Route::post('/guardarRA', [ResultadoAprendizajeController::class, 'store']);
Route::post('/guardarCompetencia', [CompetenciaTecnicaController::class, 'store']);