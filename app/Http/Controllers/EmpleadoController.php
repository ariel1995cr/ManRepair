<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestInciarSesion;
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

    public function index()
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

        return redirect()->back();
    }

    protected function guard()
    {
        return Auth::guard('empleados');
    }
}
