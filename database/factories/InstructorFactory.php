<?php

namespace Database\Factories;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class InstructorFactory extends Factory
{
    protected $model = Instructor::class;

    public function definition()
    {
        return [
			'user_id' => fake()->name(),
			'sexo' => fake()->name(),
			'telefono' => fake()->name(),
			'edad' => fake()->name(),
			'cantidad_horas' => fake()->name(),
			'fecha_vencimiento_licencia' => fake()->name(),
			'tenant_id' => fake()->name(),
			'borrado' => fake()->name(),
        ];
    }
}
