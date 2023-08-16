<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Licor;
use App\Models\licor_pedido;


class LicorController extends Controller
{
    //


    public function index()
    {
        $licores = Licor::all();
        return response()->json($licores);
    }
    public function crearLicorPedido(Request $request)
    {
        $licorPedido = licor_pedido::create($request->all());
        return response()->json($licorPedido, 201);
    }

}
