<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       $role1 =  Role::create(['name'=>'admin']);
       $role2 =  Role::create(['name'=>'root']);
       $role3 =  Role::create(['name'=>'employee']);
        // moteles permisos
       Permission::create(['name' => 'admin.motels.index'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.motels.create'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.motels.edit'])->syncRoles([$role1,$role2]);
       Permission::create(['name' => 'admin.motels.destroy'])->syncRoles([$role1,$role2]);

    }
}
