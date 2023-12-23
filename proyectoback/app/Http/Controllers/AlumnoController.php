<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class AlumnoController extends Controller
{
    public function index()
    {
        try {
            $alumnos = Alumno::all();
            return response()->json($alumnos);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la lista de alumnos'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nombre' => 'required|string',
                'edad' => 'required|integer',
                'correo' => 'required|email',
                
                // Agrega validaciones para otros campos si es necesario
            ]);

            $alumno = Alumno::create($data);

            return response()->json($alumno, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Error al crear un nuevo alumno'], 500);
        }
    }
    

    public function show($id)
    {
        try {
            $alumno = Alumno::findOrFail($id);
            return response()->json($alumno);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Alumno no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $alumno = Alumno::findOrFail($id);
            
            // Actualiza los datos del alumno con los nuevos datos proporcionados
            $alumno->nombre = $request->input('nombre'); // Reemplaza 'nombre' con los campos que quieras actualizar
            $alumno->correo = $request->input('correo');
            $alumno->edad = $request->input('edad');
            // Actualiza más campos según sea necesario

            $alumno->save();

            return response()->json($alumno);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el alumno'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $alumno = Alumno::findOrFail($id);
            $alumno->delete();
            return response()->json(['message' => 'Alumno eliminado']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el alumno'], 500);
        }
    }
    
}
