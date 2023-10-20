<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    public function generateRand(): ?int
    {
        return random_int(0, 1) ? 1 : null;

    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maxTaskId = Task::max('id');
        return [
            'title' => fake()->title(),
            'content' => fake()->text(),
            'category_id' => fake()->numberBetween(1, 3),
            'priority_id' => fake()->numberBetween(1, 3),
            'status_id' => fake()->numberBetween(1, 3),
            'user_id' => fake()->numberBetween(1, 3),
            'parent_id' => function () use ($maxTaskId) {
                if ($this->generateRand()) {
                    return fake()->numberBetween(1, $maxTaskId);
                }

                return null;
            },
            'tag_id' => fake()->unique()->numberBetween(1, 20),
        ];
    }
}
