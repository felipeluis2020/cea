<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modulos = [
            ['nombre_modulo' => 'Roles', 'borrado' => 0],
            ['nombre_modulo' => 'Modulos', 'borrado' => 0],
            ['nombre_modulo' => 'Permisos', 'borrado' => 0],
            ['nombre_modulo' => 'Usuarios', 'borrado' => 0],
        ];

        foreach ($modulos as $modulo) {
            Modulo::create($modulo);
        }
    }
}
