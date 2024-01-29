<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\InstitucionController;

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


    //Tests
    Route::get('/tests', 'TestController@index')->middleware('cors');


    // Obtener la lista de tests
    Route::get('/tests', [TestController::class, 'index']);

    // Crear un nuevo test
    Route::post('/tests/nuevo', [TestController::class, 'store']);

    // Crear reporteador
    Route::get('/tests/pdf', [TestController::class, 'pdf']);

    // Obtener un test específico por ID
    Route::get('/tests/{id}', [TestController::class, 'show']);

    // Actualizar un test específico por ID
    Route::put('/tests/update/{id}', [TestController::class, 'update'])
       ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
    // Eliminar un test específico por ID
    Route::delete('/tests/eliminar/{id}', [TestController::class, 'destroy'])
       ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    //Instituciones

    Route::get('/instituciones', 'InstitucionController@index')->middleware('cors');

    // Obtener la lista de alumnos
    Route::get('/instituciones', [InstitucionController::class, 'index']);

    // Crear un nuevo alumno
    Route::post('/instituciones/nuevo', [InstitucionController::class, 'store']);

    // Obtener un alumno específico por ID
    Route::get('/instituciones/{id}', [InstitucionController::class, 'show']);

    // Actualizar un alumno específico por ID
    Route::put('/instituciones/update/{id}', [InstitucionController::class, 'update'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    // Eliminar un alumno específico por ID
    Route::delete('/instituciones/eliminar/{id}', [InstitucionController::class, 'destroy'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
