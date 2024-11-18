<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence;

        return [
            'title' => $title,
            'body' => fake()->paragraph(2),
            'slug' => Str::Slug($title),
            'user_id' => \App\Models\User::factory()
        ];
    }
}
