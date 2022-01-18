<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => mt_rand(1, 3),
            'puisi_id' => mt_rand(1, 1000),
            'komentator' => "Tatang Haetami",
            'comentar' => $this->faker->sentence(mt_rand(2, 4)),
        ];
    }
}
