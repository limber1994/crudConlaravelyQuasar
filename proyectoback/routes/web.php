<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\UsuarioController;

    Route::get('/alumnos', 'AlumnoController@index')->middleware('cors');


    // Obtener la lista de alumnos
    Route::get('/alumnos', [AlumnoController::class, 'index']);

    // Crear un nuevo alumno
    Route::post('/alumnos/nuevo', [AlumnoController::class, 'store']);

    // Obtener un alumno específico por ID
    Route::get('/alumnos/{id}', [AlumnoController::class, 'show']);

    // Actualizar un alumno específico por ID
    Route::put('/alumnos/update/{id}', [AlumnoController::class, 'update'])
       ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    // Eliminar un alumno específico por ID
    Route::delete('/alumnos/eliminar/{id}', [AlumnoController::class, 'destroy'])
       ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    //Usuarios
    Route::get('/usuarios', 'UsuarioController@index')->middleware('cors');

    
    // Obtener la lista de usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index']);
    
    // Crear un nuevo usuario
    Route::post('/usuarios/nuevo', [UsuarioController::class, 'store']);

    // Crear reporteador
    Route::get('/usuarios/pdf', [UsuarioController::class, 'pdf']);
    
    // Obtener un usuario específico por ID
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
    
    // Actualizar un usuario específico por ID
    Route::put('/usuarios/update/{id}', [UsuarioController::class, 'update'])
       ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    // Eliminar un usuario específico por ID
    Route::delete('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy'])
       ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
