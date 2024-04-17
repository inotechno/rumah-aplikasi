<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\Post;
use Spatie\Sitemap\Sitemap;
use Illuminate\Http\Request;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function generate()
    {
        $sitemap = Sitemap::create(config('app.url'));
        // ->add(Url::create('/about-us'))
        // ->add(Url::create('/contact_us'));

        $posts = Post::all();
        foreach ($posts as $post) {
            $sitemap->add(Url::create("/posts/{$post->slug_title}"));
        }

        $portfolios = Portfolio::all();
        foreach ($portfolios as $portfolio) {
            $sitemap->add(Url::create("/portfolios/{$portfolio->slug_title}"));
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
    }
}
