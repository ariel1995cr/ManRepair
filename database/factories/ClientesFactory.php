<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'dni'=>$this->faker->unique()->numberBetween(8000000,40000000),
            'email'=>$this->faker->unique()->email,
            'nombre'=>$this->faker->firstName,
            'apellido'=>$this->faker->lastName,
            'numero_de_telefono'=>$this->faker->numerify('##########'),
        ];
    }
}
