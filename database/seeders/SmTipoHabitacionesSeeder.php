<?php

namespace Database\Seeders;

use App\Models\SmTipoHabitaciones;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmTipoHabitacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SmTipoHabitaciones::insert([[
            'tipo'=>'Deluxe'
        ],[
            'tipo'=>'economica'
        ],[
            'tipo'=>'otra'
        ],]);
    }
}
