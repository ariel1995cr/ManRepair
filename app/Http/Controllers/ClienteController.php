<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCliente;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    //
    private $cliente;
    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function buscarCliente($campo, $dni)
    {
        return $this->cliente::buscarCliente($campo, $dni)->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::get();
        return view('dashboard.cliente.show', ['clientes'=> $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.cliente.create', ['cliente'=> new Cliente()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCliente $request)
    {
        Cliente::create($request->validated());
        return back()->with('status', 'Cliente creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $clientes = Cliente::get();
        // // dd($marcas);
        // return view('dashboard.cliente.show', ['clientes'=> $clientes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        return view('dashboard.cliente.edit', ['cliente' => $cliente]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCliente $request, Cliente $cliente)
    {
        $cliente->update($request->validated());
        return back()->with('status', 'Cliente actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
