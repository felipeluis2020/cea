<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CursoFactory extends Factory
{
    protected $model = Curso::class;

    public function definition()
    {
        return [
			'nombre_curso' => fake()->name(),
			'descripcion_curso' => fake()->name(),
			'precio_curso' => fake()->name(),
			'tenant_id' => fake()->name(),
			'borrado' => fake()->name(),
        ];
    }
}
