<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\OpenGraph;

class HomeController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Rumah Aplikasi');
        SEOTools::setDescription(config('settings.about_us'));
        SEOTools::opengraph()->setUrl(URL::full());
        SEOTools::setCanonical(URL::full());
        SEOTools::opengraph()->addProperty('type', 'webpage');
        SEOTools::twitter()->setSite('@' . config('settings.app_name'));

        $posts = Post::select('img_thumbnail')->get();
        $portfolios = Portfolio::select('img_thumbnail')->get();

        foreach ($portfolios as $portfolio) {
            OpenGraph::addImage(['url' => url('storage/portfolios/' . $portfolio->img_thumbnail), 'size' => 300]);
        }
        foreach ($posts as $post) {
            OpenGraph::addImage(['url' => url('storage/posts/' . $post->img_thumbnail), 'size' => 300]);
        }

        return view('landing_page.home');
    }
}
