<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;

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





