<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CertificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title'      => $this->faker->sentence(3),
            'issuer'     => $this->faker->company(),
            'date'       => $this->faker->date('M Y'),
            'url'        => null,
            'sort_order' => $this->faker->numberBetween(0, 10),
        ];
    }
}
