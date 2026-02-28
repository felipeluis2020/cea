<?php

namespace Database\Factories;

use App\Models\Estadomantenimiento;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstadomantenimientoFactory extends Factory
{
    protected $model = Estadomantenimiento::class;

    public function definition()
    {
        return [
			'nombre_estado_mantenimiento' => fake()->name(),
			'borrado' => fake()->name(),
        ];
    }
}
