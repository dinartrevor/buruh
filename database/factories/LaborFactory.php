<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LaborFactory extends Factory
{
    /**
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'bonus' => 0,
        ];
    }
}
