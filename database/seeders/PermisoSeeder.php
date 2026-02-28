<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permisos = [
            ['rol_id' => 1, 'modulo_id' => 1, 'crear' => 1, 'ver' => 1, 'editar' => 1, 'borrar' => 1, 'importar' => 1, 'exportar' => 1, 'borrado' => 0],
            ['rol_id' => 1, 'modulo_id' => 2, 'crear' => 1, 'ver' => 1, 'editar' => 1, 'borrar' => 1, 'importar' => 1, 'exportar' => 1, 'borrado' => 0],
            ['rol_id' => 1, 'modulo_id' => 3, 'crear' => 1, 'ver' => 1, 'editar' => 1, 'borrar' => 1, 'importar' => 1, 'exportar' => 1, 'borrado' => 0],
            ['rol_id' => 1, 'modulo_id' => 4, 'crear' => 1, 'ver' => 1, 'editar' => 1, 'borrar' => 1, 'importar' => 1, 'exportar' => 1, 'borrado' => 0],
        ];

        foreach ($permisos as $permiso) {
            Permiso::create($permiso);
        }
    }
}
