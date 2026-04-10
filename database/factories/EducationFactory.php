<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'degree'      => $this->faker->sentence(4),
            'institution' => $this->faker->company() . ' University',
            'year'        => (string) $this->faker->year(),
            'location'    => $this->faker->city(),
            'description' => $this->faker->sentence(),
            'logo'        => null,
            'sort_order'  => $this->faker->numberBetween(0, 10),
        ];
    }
}
