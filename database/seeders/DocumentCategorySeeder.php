<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DocumentCategory::insert([
            ['nama' => 'Sakip', 'slug' => 'sakip'],
            ['nama' => 'Lakip', 'slug' => 'lakip'],
            ['nama' => 'RKU', 'slug' => 'rku'],
            ['nama' => 'RKA', 'slug' => 'rka'],
        ]);
    }
}
