<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            $usuarios = Usuario::all();
            return response()->json($usuarios);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener la lista de usuarios'], 500);
        }
    }

    public function pdf(){
        try {
            $usuarios = Usuario::all();
            $pdf = Pdf::loadView('usuarios.pdf', compact('usuarios'));
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
                'apellido' => 'required|string',
                'telefono' => 'required|integer',
                'email' => 'required|email',
                'contrasenia' => 'required|string',
                // Agrega validaciones para otros campos si es necesario
            ]);

            $usuario = Usuario::create($data);

            return response()->json($usuario, 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Error al crear un nuevo usuario'], 500);
        }
    }
    

    public function show($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            
            // Actualiza los datos del usuario con los nuevos datos proporcionados
            $usuario->nombre = $request->input('nombre'); // Reemplaza 'nombre' con los campos que quieras actualizar
            $usuario->apellido = $request->input('apellido');
            $usuario->telefono = $request->input('telefono');
            $usuario->email = $request->input('email');
            $usuario->contrasenia = $request->input('contrasenia');
            // Actualiza más campos según sea necesario

            $usuario->save();

            return response()->json($usuario);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar el usuario'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            return response()->json(['message' => 'Usuario eliminado']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al eliminar el usuario'], 500);
        }
    }
    
}
