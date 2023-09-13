<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Mail;
use App\Mail\CodigoRecuperacionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; // Agrega esta línea para usar la sesión

class RecuperarContrasenaController extends Controller
{
    public function enviarCodigo(Request $request)
    {
        try {
            // Validar el correo electrónico ingresado por el usuario
            $request->validate([
                'email' => 'required|email',
            ]);

            // Generar un código aleatorio
            $codigoRecuperacion = rand(1000, 9999);

            // Envía el correo electrónico con el código de recuperación
            Mail::to($request->input('email'))->send(new CodigoRecuperacionMail($codigoRecuperacion));

            // Almacena el código generado en la sesión del usuario
            Session::put('codigo_recuperacion', $codigoRecuperacion);
            

            // Devuelve una respuesta
            return response()->json(['message' => 'Código de recuperación enviado con éxito']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

  
}
