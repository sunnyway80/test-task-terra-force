<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()
                ->sentence(3),
            'description' => $this->faker->text(25),
            'content' => $this->faker->text(25),
        ];
    }
}
