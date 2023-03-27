<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'category_id'=> rand(1, 5),
            'title' => $this->faker->sentence(),
            'short_content'=>$this->faker->sentence(15),
            'content' => $this->faker->paragraph(5),

        ];
    }
}
