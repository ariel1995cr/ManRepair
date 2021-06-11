<?php

namespace Database\Seeders;

use App\Models\Modelo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ModelosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayModelos = [['marca'=>'Samsung','modelo'=>'J7']];
        foreach ($arrayModelos as $modelo) {
            $nuevaMarca = new Modelo();
            $nuevaMarca->nombre = $modelo['modelo'];
            $nuevaMarca->nombre_marca = $modelo['marca'];
            $nuevaMarca->save();
        }
    }
}
