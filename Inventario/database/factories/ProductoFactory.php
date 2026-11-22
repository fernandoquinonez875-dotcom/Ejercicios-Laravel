<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('PRO-####'),
            'nombre' => fake()->words(3, true),
            'precio' => fake()->randomFloat(2, 0.01, 10000),
            'existencias' => fake()->numberBetween(0, 100),
        ];
    }
}
