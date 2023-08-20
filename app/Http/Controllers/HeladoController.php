<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Helado;

class HeladoController extends Controller
{
    //


public function index()
{
    $helados = Helado::all();
    return response()->json($helados);
}

public function cantidad()
{
    $count = Helado::count();
    return response()->json([$count]);
}

public function create(Request $request)
    {
        $data = $request->json()->all();
        $create = new Helado();
        $create->nombre = $data['nombre'];
        $create->precio = $data['precio'];
        $create->save();

        return response()->json($create, 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->json()->all();
        $update = Helado::find($id);
        $update->nombre = $data['nombre'];
        $update->precio = $data['precio'];

        $update->save();
        return response()->json($update, 201);
    }

    public function delete($id)
{
    $dulce = Helado::find($id);
    if ($dulce) {
        $dulce->delete();
        return response()->json(['message' => 'Eliminado correctamente'], 201);
    } else {
        return response()->json(['error' => 'No existe ese id'], 401);
    }
}

}
