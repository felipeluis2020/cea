<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition()
    {
        return [
			'name' => fake()->name(),
			'nit' => fake()->name(),
			'is_active' => fake()->name(),
        ];
    }
}
