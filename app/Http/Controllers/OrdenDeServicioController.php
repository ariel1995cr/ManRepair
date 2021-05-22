<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\OrdenDeServicio;
use Illuminate\Http\Request;

class OrdenDeServicioController extends Controller
{
    //
    public function buscar(Request $request)
    {
        $nroOrdenDeServicio = $request->nroOrdenDeServicio;
        $ordenDeServicio = OrdenDeServicio::find($nroOrdenDeServicio);
        return view('ordenDeServicio', compact('nroOrdenDeServicio', 'ordenDeServicio'));
    }

    public function create(){
        $marcas = new Marca();
        $marcas = $marcas->listarMarcas();
        return view('Admin.OrdenDeServicio.create', compact('marcas'));
    }
}
