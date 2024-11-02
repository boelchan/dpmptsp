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
        Category::insert([
            ['nama' => 'Banner', 'slug' => 'banner', 'is_primary' => 1, 'add_to_header_menu' => 'tidak'],
            ['nama' => 'Pamflet', 'slug' => 'pamflet', 'is_primary' => 1, 'add_to_header_menu' => 'tidak'],
            ['nama' => 'Profil', 'slug' => 'profil', 'is_primary' => 1, 'add_to_header_menu' => 'ya'],
            ['nama' => 'Berita', 'slug' => 'berita', 'is_primary' => 1, 'add_to_header_menu' => 'tidak'],
            ['nama' => 'Kegiatan', 'slug' => 'kegiatan', 'is_primary' => 1, 'add_to_header_menu' => 'tidak'],
            ['nama' => 'Penghargaan', 'slug' => 'penghargaan', 'is_primary' => 1, 'add_to_header_menu' => 'tidak'],
        ]);

    }
}
