<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session; // Importa la clase Session
use App\Models\User;

class ActualizarContrasenaController extends Controller
{
    // ...

    public function actualizarContrasena(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'contrasena' => 'required|min:4', // Confirma la contraseña
        ]);
    
        // Obtener el correo electrónico de la sesión
        $correoRecuperacion = Session::get('correo_recuperacion');
    
        // Verificar si el correo electrónico de la sesión existe
        if ($correoRecuperacion) {
            // Encuentra al usuario por correo electrónico
            $usuario = User::where('email', $correoRecuperacion)->first();
    
            // Verificar si se encontró al usuario
            if ($usuario) {
                // Actualizar la contraseña del usuario
                $usuario->update([
                    'password' => $request->input('contrasena'), // Almacenar en texto plano
                ]);
    
                // Eliminar el correo de recuperación almacenado en la sesión
                Session::forget('correo_recuperacion');
    
                // Redirigir o responder con un mensaje de éxito
                return redirect()->route('dashboard')->with('success', 'Contraseña actualizada con éxito');
            }
        }
    
        try {
            // Validar y procesar la solicitud aquí
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
        // Si no se encuentra el correo de recuperación en la sesión o no se encuentra el usuario, mostrar un mensaje de error
        return redirect()->back()->with('error', 'No se pudo actualizar la contraseña');
    }
    
}