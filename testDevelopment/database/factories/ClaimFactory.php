<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\About;

class ClaimFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'billingName' => $this->faker->realText(15),
            'billingName_kana' => $this->faker->realText(15),
            'address' => $this->faker->realText(15),
            'phoneNumber' => $this->faker->realText(15),
            'department' => $this->faker->realText(15),
            'name' => $this->faker->realText(15),
            'name_kana' => $this->faker->realText(15),
            'about_id' => About::factory()
        ];
    }
}
