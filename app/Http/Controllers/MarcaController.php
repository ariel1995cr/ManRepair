<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Response;

class MarcaController extends Controller
{
    private $marca;

    function __construct(){
        $this->marca = new Marca();
    }
    //
    public function listarModelos(Marca $marca)
    {
        $modelos = $this->marca->with('modelos')->first()->modelos;
        return response()->json($modelos);
    }
}
