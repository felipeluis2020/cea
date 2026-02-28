<?php

namespace Database\Factories;

use App\Models\Modulo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ModuloFactory extends Factory
{
    protected $model = Modulo::class;

    public function definition()
    {
        return [
			'nombre_modulo' => fake()->name(),
			'borrado' => fake()->name(),
        ];
    }
}
