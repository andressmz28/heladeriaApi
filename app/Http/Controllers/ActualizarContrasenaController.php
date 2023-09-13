<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class ActualizarContrasenaController extends Controller
{
   // ...

public function actualizarContrasena(Request $request)
{
    // Verificar si el código de recuperación coincide
    $codigoRecuperacion = $request->input('codigo_recuperacion');
    $usuarioId = $request->input('usuario_id');

    if (Session::get('codigo_recuperacion') != $codigoRecuperacion || Session::get('usuario_id') != $usuarioId) {
        return response()->json(['error' => 'Código de recuperación no válido'], 400);
    }

    // Obtener el usuario
    $usuario = User::find($usuarioId);

    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }

    // Elimina la restricción 'required|min:6' si no la necesitas
    $request->validate([
        'contrasena' => 'required|min:6',
        'confirmarContrasena' => 'required|same:contrasena',
    ]);

    // Actualizar la contraseña del usuario
    $usuario->update([
        'password' => bcrypt($request->input('contrasena')),
    ]);

    // Limpiar la sesión después de cambiar la contraseña
    Session::forget('codigo_recuperacion');
    Session::forget('usuario_id');

    // Redirigir o responder con un mensaje de éxito
    return response()->json(['message' => 'Contraseña actualizada con éxito']);
}


}