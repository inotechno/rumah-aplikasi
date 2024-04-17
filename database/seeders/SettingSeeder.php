<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'id' => '1',
            'name' => 'APP NAME',
            'name_slug' => 'APP_NAME',
            'value' => 'Rumah Aplikasi',
            'description' => 'Field ini digunakan untuk judul aplikasi',
            'created_at' => '2022-09-19 07:27:44',
            'updated_at' => '2022-09-20 05:42:19',
        ]);

        Setting::create([
            'id' => '3',
            'name' => 'APP LOGO FULL',
            'name_slug' => 'APP_LOGO_FULL',
            'value' => 'https://rumahaplikasi.co.id/assets/img/Rumah-Aplikasi-Logo-Full.png',
            'description' => 'Logo aplikasi',
            'created_at' => '2022-09-20 10:00:59',
            'updated_at' => '2022-09-21 11:45:06',
        ]);

        Setting::create([
            'id' => '4',
            'name' => 'APP LOGO',
            'name_slug' => 'APP_LOGO',
            'value' => 'https://rumahaplikasi.co.id/assets/img/rumahaplikasi.png',
            'description' => 'Logo',
            'created_at' => '2022-09-20 10:24:19',
            'updated_at' => '2022-09-21 11:45:53',
        ]);

        Setting::create([
            'id' => '5',
            'name' => 'APP LOGO CROP',
            'name_slug' => 'APP_LOGO_CROP',
            'value' => 'https://rumahaplikasi.co.id/assets/img/rumahaplikasi-crop.png',
            'description' => 'Logo rumah aplikasi crop',
            'created_at' => '2022-09-20 10:29:55',
            'updated_at' => '2022-09-21 11:45:29',
        ]);

        Setting::create([
            'id' => '6',
            'name' => 'Alamat',
            'name_slug' => 'ALAMAT',
            'value' => 'Kompleks Dutamas Fatmawati Blok B2 No. 26, RT.1/RW.5, Cipete Utara, Kec. Kby. Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12150',
            'description' => 'Alamat kantor rumah aplikasi',
            'created_at' => '2022-09-20 10:39:17',
            'updated_at' => NULL,
        ]);

        Setting::create([
            'id' => '7',
            'name' => 'Nomor Telepon',
            'name_slug' => 'NOMOR_TELEPON',
            'value' => '(021) 29305768',
            'description' => 'nomor telepon',
            'created_at' => '2022-09-20 10:43:54',
            'updated_at' => '2022-09-20 05:44:13',
        ]);

        Setting::create([
            'id' => '8',
            'name' => 'Email',
            'name_slug' => 'EMAIL',
            'value' => 'admin@mindotek.com',
            'description' => 'Email yang digunakan agar pengunjung dapat menghubungi',
            'created_at' => '2022-09-20 10:46:39',
            'updated_at' => NULL,
        ]);

        Setting::create([
            'id' => '9',
            'name' => 'Map Location',
            'name_slug' => 'MAP_LOCATION',
            'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.004649159653!2d106.79665111539254!3d-6.263116563061799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f1fac7af794d%3A0x374963aa271a0021!2sTPM%20Group!5e0!3m2!1sen!2sid!4v1662519080591!5m2!1sen!2sid',
            'description' => 'Map lokasi menggunakan google maps',
            'created_at' => '2022-09-20 10:52:34',
            'updated_at' => '2022-09-22 16:57:25',
        ]);

        Setting::create([
            'id' => '10',
            'name' => 'Facebook Link',
            'name_slug' => 'FACEBOOK_LINK',
            'value' => 'https://www.facebook.com',
            'description' => 'link facebook rumah aplikasi',
            'created_at' => '2022-09-20 10:57:01',
            'updated_at' => NULL,
        ]);

        Setting::create([
            'id' => '11',
            'name' => 'Instagram Link',
            'name_slug' => 'INSTAGRAM_LINK',
            'value' => 'https://instagram.com',
            'description' => '',
            'created_at' => '2022-09-20 10:57:19',
            'updated_at' => NULL,
        ]);

        Setting::create([
            'id' => '12',
            'name' => 'Twitter Link',
            'name_slug' => 'TWITTER_LINK',
            'value' => 'https://twitter.com',
            'description' => '',
            'created_at' => '2022-09-20 10:57:34',
            'updated_at' => '2022-09-20 05:57:32',
        ]);

        Setting::create([
            'id' => '13',
            'name' => 'Tiktok Link',
            'name_slug' => 'TIKTOK_LINK',
            'value' => 'https://titktok.com',
            'description' => '',
            'created_at' => '2022-09-20 10:58:32',
            'updated_at' => NULL,
        ]);

        Setting::create([
            'id' => '14',
            'name' => 'LinkedIn Link',
            'name_slug' => 'LINKEDIN_LINK',
            'value' => 'https://linkedin.com',
            'description' => '',
            'created_at' => '2022-09-20 10:59:04',
            'updated_at' => NULL,
        ]);

        Setting::create([
            'id' => '15',
            'name' => 'About Footer',
            'name_slug' => 'ABOUT_FOOTER',
            'value' => 'Rumah aplikasi adalah penyedia jasa pembuatan atau menjual aplikasi.',
            'description' => '',
            'created_at' => '2022-09-22 16:34:00',
            'updated_at' => NULL,
        ]);

        Setting::create([
            'id' => '16',
            'name' => 'Tentang Kami',
            'name_slug' => 'TENTANG_KAMI',
            'value' => 'Kami adalah Rumah Aplikasi sebagai pembuat dan penyedia software, Rumah Aplikasi memberikan layanan jasa pembuatan aplikasi Web, Android, dan iOS sesuai permintaan Anda. Selain itu, kami juga menjual beberapa produk andalan yang bisa langsung digunakan untuk menunjang kebutuhan bisnis Anda.',
            'description' => 'Tentang kami di masukan pada home\r\n',
            'created_at' => '2022-09-28 15:22:48',
            'updated_at' => '2022-09-28 15:23:38',
        ]);
    }
}
