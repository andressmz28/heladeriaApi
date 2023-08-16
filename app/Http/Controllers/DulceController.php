<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;
use App\Models\dulce_pedido;

class DulceController extends Controller
{
    //


public function index()
{
    $dulces = Dulce::all();
    return response()->json($dulces);
}

public function crearDulcePedido(Request $request)
{
    $dulcePedido = dulce_pedido::create($request->all());
    return response()->json($dulcePedido, 201);
}

}
