<?php
// File: database/factories/TodoFactory.php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // IMPROVEMENT: Use factories for relationships to ensure data integrity.
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => ucwords(fake()->sentence()),
            'is_done' => fake()->boolean(),
        ];
    }
}