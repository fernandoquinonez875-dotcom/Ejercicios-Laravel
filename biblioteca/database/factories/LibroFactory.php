<?php

namespace Database\Factories;

use App\Models\Libro;
use Illuminate\Database\Eloquent\Factories\Factory;

class LibroFactory extends Factory
{
    protected $model = Libro::class;

    public function definition(): array
    {
        return [
            'codigo' => fake()->unique()->bothify('LIB-####'),
            'titulo' => fake()->sentence(4),
            'autor' => fake()->name(),
            'anio_publicacion' => fake()->numberBetween(1450, now()->year),
        ];
    }
}