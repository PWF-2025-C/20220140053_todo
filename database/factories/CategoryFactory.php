<?php
// File: database/factories/CategoryFactory.php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => ucwords(fake()->words(2, true)), // Using words() is often better for titles
            // IMPROVEMENT: Use the User factory to create a valid user association.
            'user_id' => User::factory(),
        ];
    }
}