<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Date;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'content' => fake()->words(45, true),
            'is_archived' => false,
            'last_edited_at' => Date::now(),
        ];
    }
}
