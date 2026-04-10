<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quote'      => $this->faker->paragraph(),
            'name'       => $this->faker->name(),
            'role'       => $this->faker->jobTitle(),
            'company'    => $this->faker->company(),
            'avatar'     => null,
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
