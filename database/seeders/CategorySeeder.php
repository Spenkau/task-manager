<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Category::truncate();

        Category::create([
            'name' => 'children',
            'parent_id' => null
        ]);
        Category::create([
            'name' => 'toys',
            'parent_id' => 1
        ]);
        Category::create([
            'name' => 'clothes',
            'parent_id' => 1
        ]);
        Category::create([
            'name' => 'lego',
            'parent_id' => 2
        ]);
        Category::create([
            'name' => 'barbie',
            'parent_id' => 2
        ]);
        Category::create([
            'name' => 'technik',
            'parent_id' => 4
        ]);
        Category::create([
            'name' => 'architecture',
            'parent_id' => 4
        ]);
        Category::create([
            'name' => '2018',
            'parent_id' => 6
        ]);
        Category::create([
            'name' => '2019',
            'parent_id' => 6
        ]);
        Category::create([
            'name' => 'dresses',
            'parent_id' => 3
        ]);
        Category::create([
            'name' => 'accessories',
            'parent_id' => 3
        ]);
        Category::create([
            'name' => 'frozen movie',
            'parent_id' => 10
        ]);
        Category::create([
            'name' => 'minnie mouse',
            'parent_id' => 10
        ]);
        Category::create([
                'name' => 'bracelets',
                'parent_id' => 11
            ]
        );
        Category::create([
            'name' => 'rings',
            'parent_id' => 11
        ]);
        Category::create([
            'name' => 'size xs',
            'parent_id' => 12
        ]);
        Category::create([
            'name' => 'size s',
            'parent_id' => 12
        ]);
        Category::create([
            'name' => 'size m',
            'parent_id' => 12
        ]);
        Category::create([
            'name' => 'разьём разъем раз ём раз4ём раз.е',
        ]);
    }
}
