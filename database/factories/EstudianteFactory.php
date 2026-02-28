<?php

namespace Database\Factories;

use App\Models\Estudiante;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EstudianteFactory extends Factory
{
    protected $model = Estudiante::class;

    public function definition()
    {
        return [
			'numero_documento' => fake()->name(),
			'nombre' => fake()->name(),
			'apellido' => fake()->name(),
			'sexo' => fake()->name(),
			'edad' => fake()->name(),
			'estado_inscripcion' => fake()->name(),
			'estado_matricula' => fake()->name(),
			'curso' => fake()->name(),
			'valor_curso' => fake()->name(),
			'saldo' => fake()->name(),
			'clase_actual' => fake()->name(),
			'fecha_firma_contrato' => fake()->name(),
			'metodo_pago' => fake()->name(),
        ];
    }
}
