<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Contacto;
use App\Models\Telefono;
use Faker\Factory as Faker;

class CategoriasContactosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@agenda.com')->first();

        if (!$user) {
            return;
        }

        $faker = Faker::create('es_ES');

        // Crear categorías predefinidas
        $categorias = [
            ['nombre' => 'Familia', 'color' => '#ef4444', 'icono' => 'fa-home', 'es_predefinida' => true],
            ['nombre' => 'Amigos', 'color' => '#3b82f6', 'icono' => 'fa-user-friends', 'es_predefinida' => true],
            ['nombre' => 'Trabajo', 'color' => '#eab308', 'icono' => 'fa-briefcase', 'es_predefinida' => true],
            ['nombre' => 'Emergencia', 'color' => '#dc2626', 'icono' => 'fa-ambulance', 'es_predefinida' => true],
        ];

        $categoriasGuardadas = [];
        foreach ($categorias as $cat) {
            // Usamos firstOrCreate para evitar errores si la categoría ya existe
            $categoriasGuardadas[] = Categoria::firstOrCreate(
                [
                    'usuario_id' => $user->id,
                    'nombre'     => $cat['nombre'],
                ],
                [
                    'color'          => $cat['color'],
                    'icono'          => $cat['icono'],
                    'es_predefinida' => $cat['es_predefinida'],
                    'descripcion'    => 'Categoría predefinida de ' . $cat['nombre'],
                ]
            );
        }

        // Crear 15 contactos aleatorios usando Faker
        for ($i = 0; $i < 15; $i++) {
            $categoriaAleatoria = $faker->randomElement($categoriasGuardadas);
            
            $contacto = Contacto::create([
                'usuario_id'   => $user->id,
                'nombres'      => $faker->firstName,
                'apellidos'    => $faker->lastName . ' ' . $faker->lastName,
                'email'        => $faker->unique()->safeEmail,
                'categoria_id' => $categoriaAleatoria->id,
                'direccion'    => $faker->address,
                'notas'        => $faker->sentence(6),
            ]);

            // Agregar entre 1 y 2 teléfonos por contacto
            $numTelefonos = rand(1, 2);
            for ($j = 0; $j < $numTelefonos; $j++) {
                Telefono::create([
                    'contacto_id' => $contacto->id,
                    'tipo'        => $faker->randomElement(['Celular', 'Casa', 'Trabajo']),
                    'codigo_pais' => '+502',
                    'numero'      => $faker->numerify('########'), // Genera número de 8 dígitos
                ]);
            }
        }
    }
}
