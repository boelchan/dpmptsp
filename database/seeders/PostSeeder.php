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
            ],
            [
                'uuid' => $faker->uuid(),
                'kategori_id' => '2',
                'judul' => 'pamflet',
                'slug' => Str::slug('pamflet'),
                'konten' => $faker->paragraph(50),
                'publish_at' => now(),
            ],
        ]);
    }
}
