<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Especial;


class EspecialController extends Controller
{
    //


    public function index()
    {
        $especiales = Especial::all();
        return response()->json($especiales);
    }

}
