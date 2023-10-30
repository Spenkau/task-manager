<?php

namespace Database\Seeders;

use Database\Factories\CommentFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommentFactory::new()->times(20)->create();
    }
}
