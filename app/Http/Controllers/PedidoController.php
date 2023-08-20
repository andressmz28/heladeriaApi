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

public function cantidadPedidosNoAtendidos()
{
    $count = Pedido::where('atendido', 0)->count();
    return response()->json([$count]);
}

public function cantidadPedidosNoAtendidos2()
{
    $pedidosNoAtendidos = Pedido::select('pedidos.id', 'users.nombre as nombre_usuario', 'helados.nombre as nombre_helado')
    ->leftJoin('users', 'pedidos.user_id', '=', 'users.id')
    ->leftJoin('helados', 'pedidos.helado_id', '=', 'helados.id')
    ->where('pedidos.atendido', '=', 0)
    ->get();

return response()->json($pedidosNoAtendidos);
}

public function pedidosUsuario($userId)
{
    $pedidosConSumaIngredientes = Pedido::select('pedidos.id', 'helados.nombre as nombre_helado')
    ->leftJoin('helados', 'pedidos.helado_id', '=', 'helados.id')
    ->where('pedidos.user_id', '=', $userId)
    ->where('pedidos.atendido', '=', 0)
    ->selectRaw(
        'pedidos.id,
        helados.nombre as nombre_helado,
        (SELECT COUNT(*) FROM fruta_pedido fp WHERE fp.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM dulce_pedido dp WHERE dp.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM especial_pedido ep WHERE ep.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM licor_pedido lp WHERE lp.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM salsa_pedido sp WHERE sp.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM toping_pedido tp WHERE tp.pedido_id = pedidos.id) AS suma_total_ingredientes'
    )
    ->get();

return response()->json($pedidosConSumaIngredientes);
}

public function pedidosUsuariosAdmin()
{
    $pedidosConSumaIngredientes = Pedido::select('pedidos.id', 'users.nombre as nombre_usuario', 'helados.nombre as nombre_helado')
    ->leftJoin('helados', 'pedidos.helado_id', '=', 'helados.id')
    ->leftJoin('users', 'pedidos.user_id', '=', 'users.id')
    ->where('pedidos.atendido', '=', 0)
    ->selectRaw(
        'pedidos.id,
        users.nombre as nombre_usuario,
        helados.nombre as nombre_helado,
        (SELECT COUNT(*) FROM fruta_pedido fp WHERE fp.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM dulce_pedido dp WHERE dp.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM especial_pedido ep WHERE ep.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM licor_pedido lp WHERE lp.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM salsa_pedido sp WHERE sp.pedido_id = pedidos.id) +
        (SELECT COUNT(*) FROM toping_pedido tp WHERE tp.pedido_id = pedidos.id) AS suma_total_ingredientes'
    )
    ->get();

return response()->json($pedidosConSumaIngredientes);
}

public function marcarComoAtendido($pedidoId)
    {
        $pedido = Pedido::find($pedidoId);

        if (!$pedido) {
            return response()->json(['mensaje' => 'Pedido no encontrado'], 404);
        }

        $pedido->atendido = 1;
        $pedido->save();

        return response()->json(['mensaje' => 'Pedido marcado como atendido'], 200);
    }



}
