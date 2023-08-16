<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function registrarUsuario(Request $request)
    {
        try {
            // Validar los datos del formulario aquí

            $usuario = new Usuario();
            $usuario->nombre = $request->input('nombre');
            $usuario->correo = $request->input('correo');
            $usuario->contrasena = $request->input('contrasena'); // Encripta la contraseña
            $usuario->permiso_id = 2;

            $usuario->save();

            return response()->json(['message' => 'Usuario registrado exitosamente'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}