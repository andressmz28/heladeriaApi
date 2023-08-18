<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;
use App\Models\dulce_pedido;

class DulceController extends Controller
{
    //


public function index()
{
    $dulces = Dulce::all();
    return response()->json($dulces);
}

public function delete($id)
{
    $dulce = Dulce::find($id);
    if ($dulce) {
        $dulce->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 201);
    } else {
        return response()->json(['error' => 'No existe ese id'], 401);
    }
}

public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Dulce();
        $create->nombre = $data['nombre'];
        $create->gramos = $data['gramos'];
        $create->precio = $data['precio'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Dulce::find($id);
        $update->nombre = $data['nombre'];
        $update->gramos = $data['gramos'];
        $update->precio = $data['precio'];

        $update->save();
        return response()->json($update, 201);
    }



public function crearDulcePedido(Request $request)
{
    $dulcePedido = dulce_pedido::create($request->all());
    return response()->json($dulcePedido, 201);
}

public function cantidad()
{
    $count = Dulce::count();
    return response()->json([$count]);
}

}
