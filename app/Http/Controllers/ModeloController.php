<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModelo;
use App\Http\Requests\UpdateModelo;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Models\Modelo;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = Modelo::get();
        return view('dashboard.modelo.show', ['modelos'=> $modelos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.modelo.create', ['modelo'=> new Modelo()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModelo $request)
    {
        Modelo::create($request->validated());
        return back()->with('status', 'Modelo creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $modelos = Modelo::get();
        // return view('dashboard.modelo.show', ['modelos'=> $modelos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Modelo $modelo)
    {
        return view('dashboard.modelo.edit', ['modelo' => $modelo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModelo $request, Modelo $modelo)
    {
        $modelo->update($request->validated());
        // dd($modelo);
        // return back()->with('status', 'Modelo actualizado con exito');
        $request->session()->flash('status','Modelo actualizado con exito!');
        return view('dashboard.modelo.edit', ['modelo' => $modelo]);
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
