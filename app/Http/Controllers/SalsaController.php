<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salsa;
use App\Models\salsa_pedido;

class SalsaController extends Controller
{
    //


public function index()
{
    $salsas = Salsa::all();
    return response()->json($salsas);
}

    public function crearSalsaPedido(Request $request)
    {
        $salsaPedido = salsa_pedido::create($request->all());
        return response()->json($salsaPedido, 201);
    }
}
