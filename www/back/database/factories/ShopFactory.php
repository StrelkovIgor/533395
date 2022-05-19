<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(rand(2,3), true),
            'address' => $this->faker->address(),
            'zip' => rand(10, 999999) . '-' . rand(10, 999999)
        ];
    }
}
