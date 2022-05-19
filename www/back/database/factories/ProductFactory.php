<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'name' => $this->faker->words(rand(2,3), true),
            'description' => $this->faker->realText(),
            'price' => rand(1,99) * 100,
            'article' => $this->faker->numerify('ABC###')
        ];
    }
}
