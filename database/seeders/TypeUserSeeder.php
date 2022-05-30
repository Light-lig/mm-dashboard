<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TypeUser;

class TypeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeUser::insert([
            [
                "tusr_tipo_usuario" => "root",
            ],
            [
                "tusr_tipo_usuario" => "admin",
            ],
            [
                "tusr_tipo_usuario" => "empleado",
            ],
        ]);
    }
}
