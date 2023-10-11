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
            'name' => 'children',
            'category_id' => null
        ]);
        Category::create([
            'name' => 'toys',
            'category_id' => 1
        ]);
        Category::create([
                'name' => 'clothes',
                'category_id' => 1
            ]
        );
        Category::create([
                'name' => 'lego',
                'category_id' => 2
            ]
        );
        Category::create([
                'name' => 'barbie',
                'category_id' => 2
            ]
        );
        Category::create([
                'name' => 'technik',
                'category_id' => 4
            ]
        );
        Category::create([
                'name' => 'architecture',
                'category_id' => 4
            ]
        );
        Category::create([
                'name' => '2018',
                'category_id' => 6
            ]
        );
        Category::create([
                'name' => '2019',
                'category_id' => 6
            ]
        );
        Category::create([
                'name' => 'dresses',
                'category_id' => 3
            ]
        );
        Category::create([
                'name' => 'accessories',
                'category_id' => 3
            ]
        );
        Category::create([
                'name' => 'frozen movie',
                'category_id' => 10
            ]
        );
        Category::create([
                'name' => 'minnie mouse',
                'category_id' => 10
            ]
        );
        Category::create([
                'name' => 'bracelets',
                'category_id' => 11
            ]
        );
        Category::create([
                'name' => 'rings',
                'category_id' => 11
            ]
        );
        Category::create([
            'name' => 'size xs',
            'category_id' => 12
        ]);
        Category::create([
            'name' => 'size s',
            'category_id' => 12
        ]);
        Category::create([
            'name' => 'size m',
            'category_id' => 12
        ]);
    }
}
