<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
			'document_type_id' => fake()->name(),
			'document_number' => fake()->name(),
			'nombres' => fake()->name(),
			'apellidos' => fake()->name(),
			'email' => fake()->name(),
			'tenant_id' => fake()->name(),
			'rol_id' => fake()->name(),
        ];
    }
}
