<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\TestController;
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

   
    //TEST
    Route::get('/tests', 'TestController@index')->middleware('cors');

    
    // Obtener la lista de tests
    Route::get('/tests', [TestController::class, 'index']);

    // Crear un nuevo alumno
    Route::post('/tests/nuevo', [TestController::class, 'store']);

    // Obtener un alumno específico por ID
    Route::get('/tests/{id}', [TestController::class, 'show']);

    // Actualizar un alumno específico por ID
    Route::put('/tests/update/{id}', [TestController::class, 'update'])
       ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    // Eliminar un alumno específico por ID
    Route::delete('/tests/eliminar/{id}', [TestController::class, 'destroy'])
       ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    
    //USUARIOS
        //TEST
        Route::get('/usuarios', 'UsuarioController@index')->middleware('cors');

    
        // Obtener la lista de usuarios
        Route::get('/usuarios', [UsuarioController::class, 'index']);
    
        // Crear un nuevo alumno
        Route::post('/usuarios/nuevo', [UsuarioController::class, 'store']);
    
        // Obtener un alumno específico por ID
        Route::get('/usuarios/{id}', [UsuarioController::class, 'show']);
    
        // Actualizar un alumno específico por ID
        Route::put('/usuarios/update/{id}', [UsuarioController::class, 'update'])
           ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
        // Eliminar un alumno específico por ID
        Route::delete('/usuarios/eliminar/{id}', [UsuarioController::class, 'destroy'])
           ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);