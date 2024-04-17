<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Portfolio::truncate();

        $json = Storage::disk('local')->get('/public/portfolios.json');
        $portfolios = json_decode($json, true);

        foreach ($portfolios as $portfolio) {
            Portfolio::query()->updateOrCreate([
                'id' => $portfolio['id'],
                'title' => $portfolio['title'],
                'slug_title' => $portfolio['slug_title'],
                'service_id' => $portfolio['service_id'],
                'img_thumbnail' => $portfolio['img_thumbnail'],
                'url_portfolio' => $portfolio['url_portfolio'],
                'description' => $portfolio['description'],
                'description_excerpt' => $portfolio['description_excerpt'],
                'status_portfolio' => $portfolio['status_portfolio'],
            ]);
        }
    }
}
