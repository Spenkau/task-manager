<?php

namespace Database\Factories;

use App\Models\Task;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'content' => fake()->text(),
            'category_id' => fake()->numberBetween(1, 3),
            'priority_id' => fake()->numberBetween(1, 3),
            'status_id' => fake()->numberBetween(1, 3),
            'owner_id' => fake()->numberBetween(1, 3),
            'parent_id' => null,
        ];
    }
}
