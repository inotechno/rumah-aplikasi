<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partners = [
            [
                'name' => 'Xendit',
                'logo'  => '1671520055.png',
                'website_link' => 'https://xendit.co',
            ],
            [
                'name' => 'Smartfren',
                'logo'  => '1671520083.png',
                'website_link' => 'https://smartfren.com',
            ],
            [
                'name' => 'Qontak',
                'logo'  => '1671520111.png',
                'website_link' => 'https://qontak.com',
            ],
            [
                'name' => 'Mitsubishi',
                'logo'  => '1671520139.png',
                'website_link' => 'https://www.mitsubishi-motors.co.id/',
            ],
            [
                'name' => 'Midtrans',
                'logo'  => '1671520156.png',
                'website_link' => 'https://www.midtrans.com',
            ],
            [
                'name' => 'Abhimata',
                'logo'  => '1671520194.png',
                'website_link' => 'http://www.abhimata.co.id',
            ]
        ];

        Partner::insert($partners);
    }
}
