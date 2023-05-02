<?php

namespace Database\Factories;

use App\Models\Type;
use App\Models\Computer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeripheralFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'computer_id' => $this->faker->numberBetween(1, Computer::count()),
            'type_id' => $this->faker->numberBetween(1, Type::count()),
            'name' => $this->faker->firstNameMale.' '.$this->faker->randomElement(['Headphone', 'Keyboard', 'Monitor', 'Mouse', 'Webcam']),
            'brand' => $this->faker->randomElement(['Logitech', 'HyperX', 'SteelSeries', 'Corsair']),
            'model' => $this->faker->randomElement(['G213', 'Death Adder', 'Rival', 'HS80']),
            'serial_number' => $this->faker->uuid,
            'cost' => $this->faker->randomFloat(2, 500, 10000),
            'remarks' => $this->faker->realText()
        ];
    }
}
