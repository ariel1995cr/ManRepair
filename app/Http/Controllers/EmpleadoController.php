<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestInciarSesion;
use App\Http\Requests\StoreEmpleado;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    //
    public function __construct()
    {
        $this->empleado  = new Empleado();
    }

    public function iniciarSesion()
    {
        return view('Auth.iniciarSesion');
    }

    public function ingresar(RequestInciarSesion $request)
    {
        $credentials = [
            'email' => $request->email,
            'password'=> $request->contrasena,
        ];

        if($this->guard()->attempt($credentials)){
            return redirect()->route('admin.index');
        }

        return redirect()->back()->withErrors(['message'=>'Error de usuario y/o contraseña. Reintente.']);
    }

    public function cerrarSesion(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard('empleados');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::get();
        return view('dashboard.empleado.show', ['empleados'=> $empleados]);
    }

    ////// ////// GonzaWasJir ////// //////

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $empleados = Empleado::get();
        // return view('dashboard.empleado.show', ['empleados'=> $empleados]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.empleado.create', ['empleado'=> new Empleado()]);
        // $marca = Marca::pluck('nombre','logo');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        return view('dashboard.empleado.edit', ['empleado' => $empleado]);
    }


    //Ariel dijo que hagas esto !!!!!!!
    public function update(Request $request)
    {
        dd($request->all);
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmpleado $request)
    {
        // dd($request->validated());
        Empleado::create($request->validated());
        return back()->with('status', 'Empleado creado con exito');
    }

}
