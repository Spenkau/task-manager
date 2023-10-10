<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Category::truncate();

        Category::create(['name' => 'Dom']);
        Category::create(['name' => "Sem'ya"]);
        Category::create(['name' => 'Rabota']);
        Category::create(['name' => 'Sport']);
    }
}
