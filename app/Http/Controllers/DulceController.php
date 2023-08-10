<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dulce;

class DulceController extends Controller
{
    //


public function index()
{
    $dulces = Dulce::all();
    return response()->json($dulces);
}

}
