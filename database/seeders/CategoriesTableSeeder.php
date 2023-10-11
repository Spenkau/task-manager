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

        Category::create([
            'name' => 'дом',
            'slug' => 'dom',
        ]);
        Category::create([
            'name' => "семья",
            'slug' => "sem'ya"
        ]);
        Category::create([
            'name' => 'работа',
            'slug' => 'rabota'
        ]);
        Category::create([
            'name' => 'спорт',
            'slug' => 'sport'
        ]);
    }
}
