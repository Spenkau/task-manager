<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UserSeeder::class,
            TagSeeder::class,
            TaskSeeder::class,
            CommentSeeder::class,
        ]);
        $this->command->info('Database fulfilled');
    }
}
