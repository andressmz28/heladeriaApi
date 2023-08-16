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


public function delete($id)
{
    $licor = Licor::find($id);
    if ($licor) {
        $licor->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 201);
    } else {
        return response()->json(['error' => 'No existe ese id'], 401);
    }
}

public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Licor();
        $create->nombre = $data['nombre'];
        $create->gramos = $data['gramos'];
        $create->precio = $data['precio'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Licor::find($id);
        $update->nombre = $data['nombre'];
        $update->gramos = $data['gramos'];
        $update->precio = $data['precio'];

        $update->save();
        return response()->json($update, 201);
    }



}
