<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'role'             => $this->faker->jobTitle(),
            'company'          => $this->faker->company(),
            'location'         => 'Remote',
            'duration'         => '1 year',
            'type'             => 'full-time',
            'description'      => $this->faker->paragraph(),
            'responsibilities' => ['Built features', 'Wrote tests'],
            'tech_tags'        => ['Laravel', 'MySQL'],
            'sort_order'       => $this->faker->numberBetween(0, 10),
        ];
    }
}
