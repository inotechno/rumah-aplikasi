<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();

        $json = Storage::disk('local')->get('/public/posts.json');
        $posts = json_decode($json, true);

        foreach ($posts as $post) {
            Post::query()->updateOrCreate([
                'id' => $post['id'],
                'title' => $post['title'],
                'slug_title' => $post['slug_title'],
                'category_id' => $post['category_id'],
                'img_thumbnail' => $post['img_thumbnail'],
                'description' => $post['description'],
                'description_excerpt' => $post['description_excerpt'],
                'status_post' => $post['status_post'],
            ]);
        }
    }
}
