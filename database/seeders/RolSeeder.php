<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $rols = [
            ['nombre_rol' => 'Super Administrador', 'borrado' => 0],
            ['nombre_rol' => 'Administrador', 'borrado' => 0],
            ['nombre_rol' => 'Usuario', 'borrado' => 0],
        ];

        foreach ($rols as $rol) {
            Rol::create($rol);
        }
    }
}
