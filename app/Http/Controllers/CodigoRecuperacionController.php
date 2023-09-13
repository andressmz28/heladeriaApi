<?php




namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CodigoRecuperacionController extends Controller
{
    public function obtenerCodigoRecuperacion()
    {
        // Obtén el código de recuperación almacenado en la sesión
        $codigoRecuperacion = Session::get('codigo_recuperacion');

        // Devuelve el código de recuperación como una respuesta JSON
        return response()->json(['codigoRecuperacion' => $codigoRecuperacion]);
    }
}
