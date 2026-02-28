<?php

namespace Database\Factories;

use App\Models\Estadolicenciainstructor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstadolicenciainstructorFactory extends Factory
{
    protected $model = Estadolicenciainstructor::class;

    public function definition()
    {
        return [
			'nombre_estado_licencia_instructor' => fake()->name(),
			'borrado' => fake()->name(),
        ];
    }
}
