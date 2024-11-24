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
            ['nama' => 'Standar Operasional Prosedur', 'slug' => 'standar-operasional-prosedur'],
            ['nama' => 'Standar Pelayanan Publik', 'slug' => 'standar-pelayanan-publik'],
            ['nama' => 'Maklumat Pelayanan', 'slug' => 'maklumat-pelayanan'],
            ['nama' => 'Rencana Strategis', 'slug' => 'rencana-strategis'],
            ['nama' => 'Rencana Kerja', 'slug' => 'rencana-kerja'],
            ['nama' => 'Indikator Kinerja Utama', 'slug' => 'indikator-kinerja-utama'],
            ['nama' => 'Indikator Kinerja Individu', 'slug' => 'indikator-kinerja-individu'],
            ['nama' => 'Perjanjian Kerja', 'slug' => 'penjanjian-kerja'],
            ['nama' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintahan', 'slug' => 'laporan-kinerja'],
        ]);
    }
}
