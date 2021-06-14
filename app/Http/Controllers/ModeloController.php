<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreModelo;
use App\Http\Requests\UpdateModelo;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;
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
        $marcas = new Marca();
        $marcas = $marcas->listarMarcas();
        return view('dashboard.modelo.create', ['modelo'=> new Modelo(), 'marcas'=>$marcas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreModelo $request)
    {
        $modelo = Modelo::create($request->validated());
        if($request->file()) {
            $fileName = time().'_'.$request->file('imagen')->getClientOriginalName();
            $filePath = $request->file('imagen')->storeAs('modelos', $fileName, 'public');
            $modelo->foto = '/storage/' . $filePath;
            $modelo->save();
        }
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
        $marcas = new Marca();
        $marcas = $marcas->listarMarcas();
        return view('dashboard.modelo.edit', ['modelo' => $modelo], ['marcas'=> $marcas]);
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
        
        $marcas = new Marca();
        $marcas = $marcas->listarMarcas();
        $modelo->update($request->validated());
        if($request->file()) {
            $fileName = time().'_'.$request->file('imagen')->getClientOriginalName();
            $filePath = $request->file('imagen')->storeAs('modelos', $fileName, 'public');
            $modelo->foto = '/storage/' . $filePath;
            $modelo->save();
        }
        $request->session()->flash('status','Modelo actualizado con exito!');
        return view('dashboard.modelo.edit', ['modelo' => $modelo], ['marcas'=> $marcas]);
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
