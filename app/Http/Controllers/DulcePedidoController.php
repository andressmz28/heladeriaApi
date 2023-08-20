<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;
use App\Models\dulce_pedido;

class DulcePedidoController extends Controller
{
    public function obtenerNombresDulcesPorPedido($pedidoId)
    {
        $nombresDulces = dulce_pedido::select('dulces.nombre')
            ->leftJoin('dulces', 'dulce_pedido.dulce_id', '=', 'dulces.id')
            ->where('dulce_pedido.pedido_id', '=', $pedidoId)
            ->get();

        return response()->json($nombresDulces);
    }
}


