<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Fruta;
use App\Models\fruta_pedido;

class FrutaController extends Controller
{
    //


public function index()
{
    $frutas = Fruta::all();
    return response()->json($frutas);
}
public function crearFrutaPedido(Request $request)
    {
        $frutaPedido = fruta_pedido::create($request->all());
        return response()->json($frutaPedido, 201);
    }

}
