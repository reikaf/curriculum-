<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Todo;
use FakerGenerator as Faker;

class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return
            [
                'title' => $this->faker->realText(15),
                'content' => $this->faker->realText(15)
            ];
    }
}
