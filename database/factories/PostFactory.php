<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => fake()->sentence(mt_rand(2, 8)),
            'likes_count' => fake()->randomNumber(5, false),
            'rate' => fake()->randomNumber(5, false),
            'user_id' => 1,
        ];
    }
}
