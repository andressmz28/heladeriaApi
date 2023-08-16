<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Toping;
use App\Models\toping_pedido;

class TopingController extends Controller
{
    //


public function index()
{
    $topings = Toping::all();
    return response()->json($topings);
}
public function crearTopingPedido(Request $request)
    {
        $topingPedido = toping_pedido::create($request->all());
        return response()->json($topingPedido, 201);
    }

}
