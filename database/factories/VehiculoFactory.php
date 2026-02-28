<?php

namespace Database\Factories;

use App\Models\Vehiculo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VehiculoFactory extends Factory
{
    protected $model = Vehiculo::class;

    public function definition()
    {
        return [
			'placa_vehiculo' => fake()->name(),
			'marca_vehiculo' => fake()->name(),
			'cantidad_horas' => fake()->name(),
			'fecha_vencimiento_soat' => fake()->name(),
			'fecha_vencimiento_tecnomecanica' => fake()->name(),
			'fecha_vencimiento_tarjeta_operacion' => fake()->name(),
			'estadovehiculo_id' => fake()->name(),
			'estadomantenimiento_id' => fake()->name(),
			'tenant_id' => fake()->name(),
			'borrado' => fake()->name(),
        ];
    }
}
