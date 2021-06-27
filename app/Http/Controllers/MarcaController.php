<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Response;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMarca;
use App\Http\Requests\UpdateMarca;

class MarcaController extends Controller
{
    private $marca;

    function __construct(){
        $this->marca = new Marca();
        $this->marcasEliminadas = Marca::onlyTrashed();
    }
    //
    public function listarModelos(Marca $marca)
    {
        $this->marca = $marca;
        $modelos = $this->marca->modelos;
        return response()->json($modelos);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::withTrashed()->paginate(10);
        return view('dashboard.marca.show', ['marcas'=> $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.marca.create', ['marca'=> new Marca(), 'edit'=> false]);
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
        $marca = new Marca();
        $marca->nombre = $request->nombre;
        if($request->file()) {
            $fileName = time().'_'.$request->file('logo')->getClientOriginalName();
            $filePath = $request->file('logo')->storeAs('uploads', $fileName, 'public');

            $marca->logo = '/storage/' . $filePath;
        }

        $marca->save();
        return redirect()->route('marcas.index')->with('status', 'Marca creada con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $marcas = Marca::get();
        // return view('dashboard.marca.show', ['marcas'=> $marcas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Marca $marca)
    {
        // dd($marca->all());
        return view('dashboard.marca.edit', ['marca' => $marca, 'edit'=> true]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarca $request, Marca $marca)
    {
        $marca->nombre = $request->nombre;
        if($request->eliminarFotoValue == "on"){
            $marca->logo = null;
        }else{
            if($request->file()) {
                $fileName = time().'_'.$request->file('logo')->getClientOriginalName();
                $filePath = $request->file('logo')->storeAs('uploads', $fileName, 'public');
                $marca->logo = '/storage/' . $filePath;
            }
        }
        $marca->save();
        $request->session()->flash('status','Marca actualizada con exito!');
        return redirect()->route('marcas.index')->with('status', 'Marca actualizada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $this->marca = $this->marca->where('nombre',$request->nombre)->first();
        $this->marca->delete();
        return back()->with('status', 'Marca borrada con exito');
    }

    public function reactivar(Request $request)
    {
        $this->marcasEliminadas = $this->marcasEliminadas->where('nombre',$request->nombre)->first();
        $this->marcasEliminadas->restore();
        return back()->with('status', 'Marca recuperada con exito');
    }
}
