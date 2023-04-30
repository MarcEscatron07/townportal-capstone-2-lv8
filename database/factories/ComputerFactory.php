<?php

namespace Database\Factories;

use App\Models\Network;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComputerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status_id' => $this->faker->numberBetween(1, Status::count()),
            'network_id' => $this->faker->numberBetween(1, Network::count()),
            'name' => 'PC #'.$this->faker->numberBetween(1, 10),
            'unit' => $this->faker->randomElement(['Asus', 'Dell', 'HP', 'Lenovo']),
            'remarks' => $this->faker->realText(),
        ];
    }
}
