<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PuisiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2, 4)),
            'penulis' => $this->faker->name(),
            'body' => collect($this->faker->sentences(mt_rand(7, 18)))->map(fn ($p) => "<p>$p</p>")->implode(''),
            'author_id' => mt_rand(1, 3),
            'romlah' => Str::uuid(),
        ];
    }
}
