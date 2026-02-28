<?php

namespace Database\Factories;

use App\Models\Estadovehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstadovehiculoFactory extends Factory
{
    protected $model = Estadovehiculo::class;

    public function definition()
    {
        return [
			'nombre_estado_vehiculo' => fake()->name(),
			'borrado' => fake()->name(),
        ];
    }
}
