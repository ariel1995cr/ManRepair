<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayMarcas = ['Samsung','Motorola','Iphone', 'Xiaomi', 'Nokia', 'Lenovo', 'ZTL'];
        foreach ($arrayMarcas as $marca) {
            $nuevaMarca = new Marca();
            $nuevaMarca->nombre = $marca;
            $nuevaMarca->save();
        }
    }
}
