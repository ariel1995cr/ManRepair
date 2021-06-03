<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    private $cliente;
    public function __construct(){
        $this->cliente = new Cliente();
    }

    public function buscarCliente($campo, $dni){
        return $this->cliente::buscarCliente($campo, $dni)->first();
    }
}
