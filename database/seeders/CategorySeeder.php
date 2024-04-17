<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'category_name' => 'Web Programmer',
                'category_slug' => 'web-programmer',
                'category_icon' => null,
            ],
            [
                'category_name' => 'Teknologi',
                'category_slug' => 'teknologi',
                'category_icon' => null
            ],
            [
                'category_name' => 'Sosial Media',
                'category_slug' => 'sosial-media',
                'category_icon' => null
            ]
        ];

        Category::insert($data);
    }
}
