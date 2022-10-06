<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'companyName' => $this->faker->realText(15),
            'companyName_kana' => $this->faker->realText(15),
            'address' => $this->faker->realText(15),
            'phoneNumber' => $this->faker->realText(15),
            'name' => $this->faker->realText(15),
            'name_kana' => $this->faker->realText(15)
        ];
    }
}
