<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Empleado;
use App\Models\Model;
use App\Models\OrdenDeServicio;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrdenDeServicioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrdenDeServicio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'motivo_orden'=>$this->faker->text(10),
            'descripcion_estado_celular'=>$this->faker->text(20),
            'imei'=>$this->faker->numerify('###############'),
            'dni_empleado'=> Empleado::inRandomOrder()->select('dni')->first(),
            'dni_cliente'=> Cliente::inRandomOrder()->select('dni')->first(),
        ];
    }
}
