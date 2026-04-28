<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Buscamos el ID del rol Administrador que creamos en el RoleSeeder
        $adminRole = Rol::where('nombre', 'Administrador')->first();

        User::create([
            'rol_id'            => $adminRole->id,
            'nombres'           => 'Hennrry',
            'apellidos'         => 'Canahui',
            'email'             => 'admin@agenda.com',
            'password'          => Hash::make('PasswordSeguro123!'),
            'pregunta_secreta'  => Crypt::encrypt('¿Nombre de mi primera mascota?'),
            'respuesta_secreta' => Crypt::encrypt('Scooby'),
            'estado'            => true,
        ]);
    }
}
