<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
            'service_name' => 'Pengembangan Situs Web',
            'service_slug'  => 'pengembangan-situs-web',
            'service_icon'  => 'bi bi-laptop',
            'service_description' => 'Website merupakan platform yang fleksibel digunakan untuk semua device dan mudah di akses, Website dapat menjadi solusi atas permasalahan bisnis anda.'
        ]);

        Service::create([
            'service_name' => 'IOS Developer',
            'service_slug'  => 'ios-developer',
            'service_icon'  => 'bi bi-apple',
            'service_description' => 'Selain aplikasi mobile untuk OS Android, kami juga men-support pengembangan pada platform IOS yang dapat memperluas jangkauan produk anda.'
        ]);

        Service::create([
            'service_name' => 'Android Developer',
            'service_slug'  => 'android-developer',
            'service_icon'  => 'bi bi-android2',
            'service_description' => 'Android merupakan Sistem Operasi yang banyak digunakan untuk pengembangan aplikasi mobile, karena lebih fleksibel dan friendly.'
        ]);

        Service::create([
            'service_name' => 'All Development',
            'service_slug'  => 'all-development',
            'service_icon'  => 'bi bi-pie-chart-fill',
            'service_description' => 'Aplikasi dibuat sesuai semua pengembangan kami.'
        ]);
    }
}
