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
            ['nama' => 'Rencana Stratgis', 'slug' => 'renstra'],
            ['nama' => 'Rencana Kerja', 'slug' => 'renja'],
            ['nama' => 'Indikator Kinerja Utama', 'slug' => 'indikator-kinerja-utama'],
            ['nama' => 'Indikator Kinerja Individu', 'slug' => 'indikator-kinerja-individu'],
            ['nama' => 'Perjanjian Kerja', 'slug' => 'penjanjian-kerja'],
            ['nama' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintahan', 'slug' => 'laporan-kinerja'],
        ]);
    }
}
