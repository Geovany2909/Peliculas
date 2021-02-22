<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //roles
        Role::create(['name'=>'Administrador']);
        Role::create(['name'=>'Cliente']);

        //permissions
        Permission::updateOrCreate(['name' => 'create-peliculas']);
        Permission::updateOrCreate(['name' => 'show-peliculas']);
        Permission::updateOrCreate(['name' => 'edit-peliculas']);
        Permission::updateOrCreate(['name' => 'delete-peliculas']);
        Permission::updateOrCreate(['name' => 'assign-roles']);
        Permission::updateOrCreate(['name' => 'assign-permissions']);

        //roles que tienen permisos
        $admin = Role::findById(1);
        $admin->givePermissionTo('create-peliculas');
        $admin->givePermissionTo('show-peliculas');
        $admin->givePermissionTo('edit-peliculas');
        $admin->givePermissionTo('delete-peliculas');
        $admin->givePermissionTo('assign-roles');
        $admin->givePermissionTo('assign-permissions');

        $cliente = Role::findById(2);
        $cliente->givePermissionTo('show-peliculas');

        
    }
}
