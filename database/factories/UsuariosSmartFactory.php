<?php

namespace Database\Factories;

use App\Models\UsuariosSmart;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsuariosSmartFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsuariosSmart::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hclinica' => $this->faker->numerify('########'),
            'apellido_nombre' => $this->faker->name,
            'fecha_nacimiento'=>$this->faker->dateTimeBetween('-90 years','-2 years'),
            'dni_tipo_id'=>$this->faker->numberBetween(1,12),
            'sexo'=>$this->faker->randomElement(['M','F']),
            'dni'=>$this->faker->numerify('########'),
            'telefono'=>$this->faker->numerify('##########'),
            'telefono_fijo'=>$this->faker->numerify('#######'),
            'direccion'=>$this->faker->address,
            'obrasocial_id'=>$this->faker->numberBetween(1,1000),
            'nacionalidad_id'=>$this->faker->numberBetween(1,30),
        ];
    }
}
