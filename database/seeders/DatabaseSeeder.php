<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $this->call(EstadosSeeder::class);
        $this->call(MarcasSeeder::class);
        $this->call(ModelosSeeder::class);
        $this->call(UserSeeder::class);
        //\App\Models\UsuariosSmart::factory(267261)->create();
    }
}
