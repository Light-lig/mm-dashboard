<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SmDepartamentos;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmDepartamentos::insert([
            ["dep_nombre" => "Ahuachapán", "created_at" => now()],
            ["dep_nombre" => "Santa Ana", "created_at" => now()],
            ["dep_nombre" => "Sonsonate", "created_at" => now()],
            ["dep_nombre" => "La Libertad", "created_at" => now()],
            ["dep_nombre" => "Chalatenango", "created_at" => now()],
            ["dep_nombre" => "San Salvador", "created_at" => now()],
            ["dep_nombre" => "Cuscatlán", "created_at" => now()],
            ["dep_nombre" => "La Paz", "created_at" => now()],
            ["dep_nombre" => "Cabañas", "created_at" => now()],
            ["dep_nombre" => "San Vicente", "created_at" => now()],
            ["dep_nombre" => "Usulután", "created_at" => now()],
            ["dep_nombre" => "Morazán", "created_at" => now()],
            ["dep_nombre" => "San Miguel", "created_at" => now()],
            ["dep_nombre" => "La Unión", "created_at" => now()],
        ]);
    }
}
