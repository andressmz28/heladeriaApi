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

    public function index()
    {
        $usuarios = Usuario::all();
        return response()->json($usuarios);
    }

    public function delete($id)
    {
        $dulce = Usuario::find($id);
        if ($dulce) {
            $dulce->delete();
            return response()->json(['message' => 'Eliminado correctamente'], 201);
        } else {
            return response()->json(['error' => 'No existe ese id'], 401);
        }
    }

    public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Usuario();
        $create->nombre = $data['nombre'];
        $create->correo = $data['correo'];
        $create->contrasena = $data['contrasena'];
        $create->permiso_id = $data['permiso_id'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Usuario::find($id);
        $update->nombre = $data['nombre'];
        $update->correo = $data['correo'];
        $update->contrasena = $data['contrasena'];
        $update->permiso_id = $data['permiso_id'];

        $update->save();
        return response()->json($update, 201);
    }
}
