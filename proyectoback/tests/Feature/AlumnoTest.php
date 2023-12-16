<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlumnoTest extends TestCase
{
    use RefreshDatabase;

    public function testCrearAlumnoExitoso(): void
    {
        $response = $this->post('/alumnos/nuevo', [
            'nombre' => 'Ejemplo Nombre',
            'edad' => 25,
            'correo' => 'ejemplo@correo.com',
            // Agrega otros campos necesarios aquí
        ]);

        $response->assertStatus(201); // Verifica que la creación se haya realizado con éxito (código 201)
    }
}
