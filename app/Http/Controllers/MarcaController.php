<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Response;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarca;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.marca.create');
        // $marca = Marca::pluck('nombre','logo');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarca $request)
    {
        // dd($request->validated());
        Marca::create($request->validated());
        return back()->with('status', 'Marca creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $marca = Marca::orderBy('nombre', 'asc');
        $marcas = Marca::get();
        // dd($marcas);
        return view('dashboard.marca.show', ['marcas'=> $marcas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
