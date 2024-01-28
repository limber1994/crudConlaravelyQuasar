<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function pdf(){
        try {
            $tests = Test::all();
            $pdf = Pdf::loadView('tests.pdf', compact('tests'));
            return $pdf->stream();
        } catch (\Exception $e) {
            Log::error('Error al generar el PDF: ' . $e->getMessage());
            return response()->json(['error' => 'Error al generar el PDF'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nombre' => 'required|string',
                'uno' => 'required|string',
                'dos' => 'required|string',
                'tres' => 'required|string',
                // Agrega validaciones para otros campos si es necesario
            ]);

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

    public function update(Request $request, $id)
    {
        try {
            $test = Test::findOrFail($id);
            
            // Actualiza los datos del test con los nuevos datos proporcionados
            $test->nombre = $request->input('nombre'); // Reemplaza 'nombre' con los campos que quieras actualizar
            $test->uno = $request->input('uno');
            $test->dos = $request->input('dos');
            $test->tres = $request->input('tres');
            // Actualiza más campos según sea necesario

            $test->save();

            return response()->json($test);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el test'], 500);
        }
    }

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
