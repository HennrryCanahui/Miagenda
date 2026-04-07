<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role; // Asegúrate de que el modelo se llame Role

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar los roles requeridos por el PDF del proyecto final
        $roles = [
            ['nombre_rol' => 'Administrador'],
            ['nombre_rol' => 'Usuario estándar'],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                ['nombre_rol' => $role['nombre_rol']],
                $role
            );
        }
    }
}