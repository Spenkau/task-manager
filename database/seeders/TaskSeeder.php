<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 10; $i++) {
            Task::create([
                'title' => 'title' . $i,
                'content' => 'content' . $i,
                'priority_id' => 1,
                'status_id' => 2,
                'category_id' => 3,
                'user_id' => $i
            ]);
        }
    }
}
