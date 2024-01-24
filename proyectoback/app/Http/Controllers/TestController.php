<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function index()
    {
        try {
            $tests = Test::all();
            return response()->json($tests);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la lista de tests'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'fecha' => 'required|date',
            ]);
            
            $data['idUsuario'] = auth()->id();

            $test = Test::create($data);

            return response()->json($test, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Error al crear un nuevo test'], 500);
        }
    }

    public function show($id)
    {
        try {
            $test = Test::findOrFail($id);
            return response()->json($test);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Test no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $test = Test::findOrFail($id);
            
            // Actualiza los datos del alumno con los nuevos datos proporcionados
            $test->fecha = $request->input('fecha'); // Reemplaza 'nombre' con los campos que quieras actualizar
            // Actualiza más campos según sea necesario

            $test->save();

            return response()->json($test);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el test'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $test = Test::findOrFail($id);
            $test->delete();
            return response()->json(['message' => 'Test eliminado']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el test'], 500);
        }
    }
}
