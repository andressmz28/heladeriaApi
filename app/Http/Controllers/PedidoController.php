<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    //
    use App\Models\Pedido;

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
    $pedido = Pedido::with(['user', 'helado', 'dulces', 'especiales', 'frutas', 'licores', 'topings', 'salsas'])
        ->findOrFail($id);
    return response()->json($pedido);
}

}
