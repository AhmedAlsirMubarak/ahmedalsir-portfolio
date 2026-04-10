<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SkillFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'       => $this->faker->word(),
            'category'   => $this->faker->randomElement(['frontend', 'backend', 'database', 'other']),
            'level'      => $this->faker->numberBetween(50, 100),
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
