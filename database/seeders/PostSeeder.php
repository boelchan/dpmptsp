<?php

namespace Database\Seeders;

use App\Models\Post;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        Post::insert([
            [
                'uuid' => $faker->uuid(),
                'kategori_id' => '1',
                'judul' => 'banner',
                'slug' => Str::slug('banner'),
                'konten' => $faker->paragraph(50),
                'publish_at' => now(),
                'add_to_submenu' => 'tidak',
            ],
            [
                'uuid' => $faker->uuid(),
                'kategori_id' => '2',
                'judul' => 'pamflet',
                'slug' => Str::slug('pamflet'),
                'konten' => $faker->paragraph(50),
                'publish_at' => now(),
                'add_to_submenu' => 'tidak',
            ],
            [
                'uuid' => $faker->uuid(),
                'kategori_id' => '3',
                'judul' => 'Sambutan Kepala Dinas',
                'slug' => Str::slug('Sambutan Kepala Dinas'),
                'konten' => $faker->paragraph(50),
                'publish_at' => now(),
                'add_to_submenu' => 'ya',
            ],
            [
                'uuid' => $faker->uuid(),
                'kategori_id' => '3',
                'judul' => 'Struktur Organisasi',
                'slug' => Str::slug('Struktur Organisasi'),
                'konten' => $faker->paragraph(50),
                'publish_at' => now(),
                'add_to_submenu' => 'ya',
            ],
            [
                'uuid' => $faker->uuid(),
                'kategori_id' => '3',
                'judul' => 'Letak Geografis',
                'slug' => Str::slug('Letak Geografis'),
                'konten' => $faker->paragraph(50),
                'publish_at' => now(),
                'add_to_submenu' => 'ya',
            ],
        ]);
    }
}
