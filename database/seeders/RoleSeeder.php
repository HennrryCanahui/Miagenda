<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['nombre' => 'Administrador'],
            ['nombre' => 'Usuario estándar'],
        ];

        foreach ($roles as $role) {
            Rol::updateOrCreate(
                ['nombre' => $role['nombre']],
                $role
            );
        }
    }
}