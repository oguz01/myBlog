<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'the_comment' => $this->faker->paragraph(),
            'post_id' => \App\Models\Post::all()->random(1)->first()->id,
            'user_id' => \App\Models\User::all()->random(1)->first()->id,
        ];
    }
}
