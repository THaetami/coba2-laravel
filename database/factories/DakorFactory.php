<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DakorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'penulis' => $this->faker->name(),
            'body' => collect($this->faker->sentences(mt_rand(7, 18)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'author_id' => mt_rand(1, 4),
        ];
    }
}
