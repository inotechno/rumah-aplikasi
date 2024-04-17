<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        // \App\Models\User::factory(10)->create();
        $this->call(TagSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PartnerSeeder::class);
        // $this->call(SettingSeeder::class);
        $this->call(PortfolioSeeder::class);
        $this->call(PostSeeder::class);
        // DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
