<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'image'       => null,
            'tech_tags'   => ['Laravel', 'Vue.js'],
            'category'    => $this->faker->randomElement(['web', 'desktop', 'other']),
            'live_url'    => null,
            'repo_url'    => null,
            'featured'    => false,
            'sort_order'  => $this->faker->numberBetween(0, 10),
        ];
    }
}
