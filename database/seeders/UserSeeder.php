<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                "usr_correo" => "correoprueba@gmail.com",
                "usr_password" => bcrypt("1234"),
                "mun_id" => 5,
                "tusr_id" => 1,
                "usr_dui" => "0000000-0",
                "usr_nit" => "0000-000000-000-01",
                "usr_direccion" => "Mariona",
                "usr_nombre" => "Pastor",
                "usr_apellido" => "Quiterio",
            ],
        ]);
    }
}
