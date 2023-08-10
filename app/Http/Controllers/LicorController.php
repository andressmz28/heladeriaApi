<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Licor;


class LicorController extends Controller
{
    //


    public function index()
    {
        $licores = Licor::all();
        return response()->json($licores);
    }

}
