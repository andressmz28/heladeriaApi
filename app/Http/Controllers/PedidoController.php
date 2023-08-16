<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    //


    public function crearPedido(Request $request)
    {
        $pedido = Pedido::create($request->all());
        return response()->json($pedido, 201);
    }

public function store(Request $request)
{
    $pedido = Pedido::create([
        'atendido' => false,
        'user_id' => $request->input('user_id'),
        'helado_id' => $request->input('helado_id'),
        // Aquí podrías agregar lógica para guardar los demás elementos del pedido
    ]);

    return response()->json($pedido);
}

public function show($id)
{
    $pedido = Pedido::with(['user', 'helado', 'dulce_pedido', 'especial_pedido', 'fruta_pedido', 'licor_pedido', 'toping_pedido', 'salsa_pedido'])
        ->findOrFail($id);
    return response()->json($pedido);
}

}
