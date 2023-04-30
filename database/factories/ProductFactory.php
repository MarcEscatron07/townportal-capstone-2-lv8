<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => $this->faker->numberBetween(1, Category::count()),
            'name' => $this->faker->randomElement(['Chippy', 'Piattos', 'Coke', 'Pepsi']),
            'stock' => $this->faker->numberBetween(1, 20),
            'cost' => $this->faker->randomFloat(2, 500, 10000),
            'remarks' => $this->faker->realText()
        ];
    }
}
