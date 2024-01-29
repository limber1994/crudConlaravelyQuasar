<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $instituciones = Institucion::all();
            return response()->json($instituciones);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la lista de instituciones'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nombre' => 'required|string',
                'direccion' => 'required|string',
                'telefono' => 'required|integer',
                'tipo' => 'required|string',
                'turno' => 'required|string',
                'vacante' => 'required|integer',
                'informacion' => 'required|string',
                'foto' => 'required|url',
                'mensualidad' => 'required|integer',
                'tipo_ins' => 'required|string',

                // Agrega validaciones para otros campos si es necesario
            ]);

            $institucion = Institucion::create($data);

            return response()->json($institucion, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Error al crear una institucion'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $institucion = Institucion::findOrFail($id);
            return response()->json($institucion);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Institucion no encontrado'], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $institucion = Institucion::findOrFail($id);

            // Actualiza los datos de la institucion con los nuevos datos proporcionados
            $institucion->nombre = $request->input('nombre'); // Reemplaza 'nombre' con los campos que quieras actualizar
            $institucion->direccion = $request->input('direccion');
            $institucion->telefono = $request->input('telefono');
            $institucion->tipo = $request->input('tipo');
            $institucion->turno = $request->input('turno');
            $institucion->vacante = $request->input('vacante');
            $institucion->informacion = $request->input('informacion');
            $institucion->foto = $request->input('foto');
            $institucion->mensualidad = $request->input('mensualidad');
            $institucion->tipo_ins = $request->input('tipo_ins');
            // Actualiza más campos según sea necesario

            $institucion->save();

            return response()->json($institucion);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el institucion'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $institucion = Institucion::findOrFail($id);
            $institucion->delete();
            return response()->json(['message' => 'Institucion eliminado']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el Institucion'], 500);
        }
    }

}
