<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //se crea un usuario admin
        $admin = User::create([
            'name' => 'Geovany Marroquin',
            'email' => 'geovanimarroquin114@gmail.com',
            'password' => bcrypt('Pa$$w0rd'),
        ]);
        //se le asigna el rol admin
        $admin->assignRole('Administrador');

        //se crea un usuario cliente
        $cliente = User::create([
            'name' => 'Pablo Marroquin',
            'email' => 'pablomarroquin114@gmail.com',
            'password' => bcrypt('Pa$$w0rd'),
        ]);
        //se le asigna el rol cliente
        $cliente->assignRole('Cliente');
    }
}
