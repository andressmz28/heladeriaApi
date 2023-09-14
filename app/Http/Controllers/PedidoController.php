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
    try {
        $pedidos = Pedido::select([
            'pedidos.id AS id_pedido',
            'helados.nombre AS nombre_helado',
            Pedido::raw('(helados.precio +
                IFNULL((SELECT SUM(du.precio) FROM dulce_pedido dp
                         LEFT JOIN dulces du ON dp.dulce_id = du.id
                         WHERE dp.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT SUM(fr.precio) FROM fruta_pedido fp
                         LEFT JOIN frutas fr ON fp.fruta_id = fr.id
                         WHERE fp.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT SUM(e.precio) FROM especial_pedido ep
                         LEFT JOIN especiales e ON ep.especial_id = e.id
                         WHERE ep.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT SUM(l.precio) FROM licor_pedido lp
                         LEFT JOIN licor l ON lp.licor_id = l.id
                         WHERE lp.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT SUM(s.precio) FROM salsa_pedido sp
                         LEFT JOIN salsas s ON sp.salsa_id = s.id
                         WHERE sp.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT SUM(t.precio) FROM toping_pedido tp
                         LEFT JOIN topings t ON tp.toping_id = t.id
                         WHERE tp.pedido_id = pedidos.id), 0)
            ) AS suma_total_precio_pedido'),
            Pedido::raw('(IFNULL((SELECT COUNT(*) FROM dulce_pedido dp WHERE dp.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT COUNT(*) FROM fruta_pedido fp WHERE fp.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT COUNT(*) FROM especial_pedido ep WHERE ep.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT COUNT(*) FROM licor_pedido lp WHERE lp.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT COUNT(*) FROM salsa_pedido sp WHERE sp.pedido_id = pedidos.id), 0) +
                IFNULL((SELECT COUNT(*) FROM toping_pedido tp WHERE tp.pedido_id = pedidos.id), 0)
            ) AS suma_total_ingredientes_pedido')
        ])
        ->leftJoin('helados', 'pedidos.helado_id', '=', 'helados.id')
        ->where('pedidos.user_id', $userId)
        ->where('pedidos.atendido', 0)
        ->get();

        return response()->json($pedidos, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
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

public function eliminarPedido($id)
{
    $pedido = Pedido::find($id);

    if (!$pedido) {
        return response()->json(['error' => 'El pedido no existe'], 404);
    }

    $pedido->delete();

    return response()->json(['message' => 'Pedido eliminado correctamente'], 200);
}

public function sumaTotalPrecioPedidos($userId)
{
    $sumaTotalPrecioPedidos = Pedido::selectRaw('SUM(
        h.precio +
        IFNULL((SELECT SUM(du.precio) FROM dulce_pedido dp
                 LEFT JOIN dulces du ON dp.dulce_id = du.id
                 WHERE dp.pedido_id = pedidos.id), 0) +
        IFNULL((SELECT SUM(fr.precio) FROM fruta_pedido fp
                 LEFT JOIN frutas fr ON fp.fruta_id = fr.id
                 WHERE fp.pedido_id = pedidos.id), 0) +
        IFNULL((SELECT SUM(e.precio) FROM especial_pedido ep
                 LEFT JOIN especiales e ON ep.especial_id = e.id
                 WHERE ep.pedido_id = pedidos.id), 0) +
        IFNULL((SELECT SUM(l.precio) FROM licor_pedido lp
                 LEFT JOIN licor l ON lp.licor_id = l.id
                 WHERE lp.pedido_id = pedidos.id), 0) +
        IFNULL((SELECT SUM(s.precio) FROM salsa_pedido sp
                 LEFT JOIN salsas s ON sp.salsa_id = s.id
                 WHERE sp.pedido_id = pedidos.id), 0) +
        IFNULL((SELECT SUM(t.precio) FROM toping_pedido tp
                 LEFT JOIN topings t ON tp.toping_id = t.id
                 WHERE tp.pedido_id = pedidos.id), 0)
    ) as suma_total_precio_pedidos')
    ->leftJoin('helados as h', 'pedidos.helado_id', '=', 'h.id')
    ->where('pedidos.user_id', $userId)
    ->where('pedidos.atendido', 0)
    ->groupBy('pedidos.user_id')
    ->first();

    $sumaTotalPrecioPedidos = $sumaTotalPrecioPedidos ? $sumaTotalPrecioPedidos->suma_total_precio_pedidos : 0;

    return response()->json([$sumaTotalPrecioPedidos]);
}


public function borrarPedidosUsuario($userId)
{
    // Primero, consulta y obtén todos los pedidos del usuario
    $pedidos = Pedido::where('user_id', $userId)->get();

    // Luego, recorre los pedidos y elimínalos uno por uno
    foreach ($pedidos as $pedido) {
        $pedido->delete();
    }

    return response()->json(['message' => 'Pedidos eliminados correctamente'], 200);
}

public function marcarPedidosComoAtendidos(Request $request, $userId)
{
    // Actualiza todos los pedidos del usuario con el ID proporcionado
    Pedido::where('user_id', $userId)
        ->where('atendido', 0) // Asegura que solo actualices pedidos no atendidos
        ->update(['atendido' => 1]);

    return response()->json(['message' => 'Pedidos marcados como atendidos'], 200);
}

public function obtenerPedidosConSumaIngredientes(Request $request, $userId)
    {
        $pedidosConSumaIngredientes = Pedido::select('pedidos.id', 'users.nombre as nombre_usuario', 'helados.nombre as nombre_helado')
            ->leftJoin('helados', 'pedidos.helado_id', '=', 'helados.id')
            ->leftJoin('users', 'pedidos.user_id', '=', 'users.id')
            ->where('pedidos.atendido', '=', 0)
            ->where('pedidos.user_id', '=', $userId)
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



}
