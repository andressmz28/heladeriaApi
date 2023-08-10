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

}
