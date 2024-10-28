<?php

namespace Database\Seeders;

use App\Models\Identity;
use Faker\Generator;
use Illuminate\Database\Seeder;

class IdentitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        Identity::insert(
            [
                [
                    'nama' => 'Logo',
                    'slug' => 'logo',
                    'value' => 'logo-0.20842800 1697546391.png',
                    'tipe' => 'website',
                ], [
                    'nama' => 'Gambar Breadcrumb ',
                    'slug' => 'breadcrumb',
                    'value' => 'breadcrumb-0.05101100 1698152817.jpg',
                    'tipe' => 'website',
                ], [
                    'nama' => 'Gambar Footer',
                    'slug' => 'footer',
                    'value' => 'footer-0.27850000 1698239965.jpg',
                    'tipe' => 'website',
                ], [
                    'nama' => 'Gambar Menu Samping',
                    'slug' => 'sidebar',
                    'value' => 'sidebar-0.53811300 1680224891.jpg',
                    'tipe' => 'website',
                ], [
                    'nama' => 'Nama Perusahaan',
                    'slug' => 'nama',
                    'value' => 'Sekolahku',
                    'tipe' => 'identitas',
                ], [
                    'nama' => 'Alamat',
                    'slug' => 'alamat',
                    'value' => 'Jl Imam bonjol no 90',
                    'tipe' => 'identitas',
                ], [
                    'nama' => 'Telepon',
                    'slug' => 'telepon',
                    'value' => '0987654311',
                    'tipe' => 'identitas',
                ], [
                    'nama' => 'Whatsapp',
                    'slug' => 'whatsapp',
                    'value' => '0987654321',
                    'tipe' => 'identitas',
                ], [
                    'nama' => 'Email',
                    'slug' => 'email',
                    'value' => 'sekolah@gmail.com',
                    'tipe' => 'identitas',
                ], [
                    'nama' => 'Youtube',
                    'slug' => 'youtube',
                    'value' => '',
                    'tipe' => 'sosmed',
                ], [
                    'nama' => 'Instagram',
                    'slug' => 'instagram',
                    'value' => 'instagram.com/asdas',
                    'tipe' => 'sosmed',
                ], [
                    'nama' => 'Facebook',
                    'slug' => 'facebook',
                    'value' => '',
                    'tipe' => 'sosmed',
                ], [
                    'nama' => 'Tiktok',
                    'slug' => 'tiktok',
                    'value' => '',
                    'tipe' => 'sosmed',
                ],
            ]
        );
    }
}
