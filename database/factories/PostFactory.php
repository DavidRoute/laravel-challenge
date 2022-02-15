<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'author_id' => User::inRandomOrder()->value('id'),
            'title' => $this->faker->title(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
