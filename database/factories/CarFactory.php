<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name('honda', 'toyota', 'suzuki'),
            'plat' => $this->faker->randomNumber(4),
            'status' => $this->faker->randomNumber(1),
            'price' => $this->faker->randomNumber(4),
            'description' => $this->faker->text()
        ];
    }
}