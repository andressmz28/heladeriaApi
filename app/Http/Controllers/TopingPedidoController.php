<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;
use App\Models\toping_pedido;

class TopingPedidoController extends Controller
{
    public function obtenerNombresTopingsPorPedido($pedidoId)
    {
        $nombresTopings = toping_pedido::select('topings.nombre')
            ->leftJoin('topings', 'toping_pedido.toping_id', '=', 'topings.id')
            ->where('toping_pedido.pedido_id', '=', $pedidoId)
            ->get();

        return response()->json($nombresTopings);
    }
}
