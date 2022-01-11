<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BusinessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'adress' => $this->faker->address(),
            'chief_id' => random_int(1, 10),
            'INN' => random_int(10000000, 99999999),
        ];
    }
}
