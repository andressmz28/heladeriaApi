<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;
use App\Models\fruta_pedido;

class FrutaPedidoController extends Controller
{
    public function obtenerNombresFrutasPorPedido($pedidoId)
    {
        $nombresFrutas = fruta_pedido::select('frutas.nombre')
            ->leftJoin('frutas', 'fruta_pedido.fruta_id', '=', 'frutas.id')
            ->where('fruta_pedido.pedido_id', '=', $pedidoId)
            ->get();

        return response()->json($nombresFrutas);
    }
}
