<?php

namespace Database\Seeders;

use App\Models\Estado;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $arrayEstados = ['Recibido','Presupuestado','No reparado', 'En reparacion', 'Reparado', 'Listo para entrega', 'Entregado'];
        foreach ($arrayEstados as $estado) {
            $nuevoEstado = new Estado();
            $nuevoEstado->nombre = $estado;
            $nuevoEstado->save();
        }
    }
}
