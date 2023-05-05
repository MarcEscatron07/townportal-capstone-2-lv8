<?php

namespace Database\Factories;

use App\Models\Provider;
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
            'provider_id' => $this->faker->numberBetween(1, Provider::count()),
            'name' => 'LAN '.$this->faker->numberBetween(1, 3),
            'cost' => $this->faker->randomFloat(2, 500, 10000),
            'remarks' => $this->faker->realText()
        ];
    }
}
