<?php

namespace Database\Seeders;

use App\Models\SmCategorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SmCategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        SmCategorias::insert([
            ['cat_tipo'=>'Familiar']
           ,['cat_tipo'=>'Otro']]);
    }
}
