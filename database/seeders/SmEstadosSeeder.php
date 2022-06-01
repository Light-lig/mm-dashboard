<?php

namespace Database\Seeders;

use App\Models\SmEstados;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmEstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SmEstados::insert([[
            "est_estado"=>"disponible",
            "est_orden" => 1
        ],
        [
            "est_estado"=>"limpieza",
            "est_orden" => 3
        ],
        [
            "est_estado"=>"ocupado",
            "est_orden" => 2
        ]]);
    }
}
