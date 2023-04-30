<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NetworkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'LAN '.$this->faker->numberBetween(1, 3),
            'provider' => $this->faker->company,
            'cost' => $this->faker->randomFloat(2, 500, 10000),
            'remarks' => $this->faker->realText()
        ];
    }
}
