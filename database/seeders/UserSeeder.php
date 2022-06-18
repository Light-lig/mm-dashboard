<?php

namespace Database\Seeders;

use App\Models\SmUsuarios;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SmUsuarios::create([
            "usr_correo" => "desarrollo1@gruporemor.com.sv",
            "usr_password" => Hash::make("1234"),
            "mun_id" => 5,
            "tusr_id" => 1,
            "usr_dui" => "0000000-0",
            "usr_nit" => "0000-000000-000-01",
            "usr_direccion" => "Mariona",
            "usr_nombre" => "Pastor",
            "usr_apellido" => "Quiterio",
            "usr_role" => "admin",
        ])->assignRole("admin");

        SmUsuarios::create([
            "usr_correo" => "root@correo.com",
            "usr_password" => Hash::make("1234"),
            "mun_id" => 5,
            "tusr_id" => 1,
            "usr_dui" => "0000000-0",
            "usr_nit" => "0000-000000-000-01",
            "usr_direccion" => "Mariona",
            "usr_nombre" => "Pedro",
            "usr_apellido" => "Perez",
            "usr_role" => "root",
        ])->assignRole("root");

        SmUsuarios::create([
            "usr_correo" => "correo2prueba@gmail.com",
            "usr_password" => Hash::make("1234"),
            "mun_id" => 5,
            "tusr_id" => 2,
            "usr_dui" => "0000000-0",
            "usr_nit" => "0000-000000-000-01",
            "usr_direccion" => "Mariona",
            "usr_nombre" => "Pastor",
            "usr_apellido" => "Quiterio",
            "usr_role" => "employee",
            "usr_id_padre" => 1,
        ])->assignRole("employee");
    }
}
