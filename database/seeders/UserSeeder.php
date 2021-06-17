<?php

namespace Database\Seeders;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $empleado = new Empleado();
        $empleado->dni = 12345678;
        $empleado->email = 'demo@demo.com';
        $empleado->nombre = 'Demo';
        $empleado->apellido = 'Demo';
        $empleado->numero_de_telefono = '2974123123';
        $empleado->contrasena = 'demo';
        $empleado->rol = '1';
        $empleado->save();
        $cliente = new Empleado();
        $cliente->dni = 12345679;
        $cliente->email = 'empleado@empleado.com';
        $cliente->nombre = 'Empleado';
        $cliente->apellido = 'Empleado';
        $cliente->numero_de_telefono = '2974123124';
        $empleado->contrasena = 'empleado';
        $empleado->rol = '2';
        $empleado->save();
    }
}
