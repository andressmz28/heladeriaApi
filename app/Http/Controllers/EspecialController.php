<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especial;
use App\Models\especial_pedido;


class EspecialController extends Controller
{
    //


    public function index()
    {
        $especiales = Especial::all();
        return response()->json($especiales);
    }
    public function crearEspecialPedido(Request $request)
    {
        $especialPedido = especial_pedido::create($request->all());
        return response()->json($especialPedido, 201);
    }

}
