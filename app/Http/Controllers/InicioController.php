<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    //
    public function index()
    {
        $data = [
            'nroOrdenDeServicio' => 14213213
        ];
        return view('inicio', $data);
    }
}
