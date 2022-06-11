<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call(RoleSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(TypeUserSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SmEstadosSeeder::class);
        $this->call(SmTipoHabitacionesSeeder::class);
        $this->call(SmCategoriasSeeder::class);

    }
}
