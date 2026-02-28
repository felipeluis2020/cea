<?php

namespace Database\Factories;

use App\Models\Permiso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PermisoFactory extends Factory
{
    protected $model = Permiso::class;

    public function definition()
    {
        return [
			'rol_id' => fake()->name(),
			'modulo_id' => fake()->name(),
			'crear' => fake()->name(),
			'ver' => fake()->name(),
			'editar' => fake()->name(),
			'borrar' => fake()->name(),
			'importar' => fake()->name(),
			'exportar' => fake()->name(),
			'borrado' => fake()->name(),
        ];
    }
}
