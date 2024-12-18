<?php

namespace Database\Seeders;

use App\Models\Document;
use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Document::whereNotNull('id')->delete();
        DocumentCategory::whereNotNull('id')->delete();
        DocumentCategory::insert([
            ['nama' => 'Standar Operasional Prosedur', 'tipe' => 'layanan', 'slug' => 'standar-operasional-prosedur'],
            ['nama' => 'Standar Pelayanan Publik', 'tipe' => 'layanan', 'slug' => 'standar-pelayanan-publik'],
            ['nama' => 'Maklumat Pelayanan', 'tipe' => 'layanan', 'slug' => 'maklumat-pelayanan'],
            ['nama' => 'Rencana Strategis', 'tipe' => 'sakip', 'slug' => 'rencana-strategis'],
            ['nama' => 'Rencana Kerja', 'tipe' => 'sakip', 'slug' => 'rencana-kerja'],
            ['nama' => 'Indikator Kinerja Utama', 'tipe' => 'sakip', 'slug' => 'indikator-kinerja-utama'],
            ['nama' => 'Indikator Kinerja Individu', 'tipe' => 'sakip', 'slug' => 'indikator-kinerja-individu'],
            ['nama' => 'Perjanjian Kerja', 'tipe' => 'sakip', 'slug' => 'penjanjian-kerja'],
            ['nama' => 'Laporan Akuntabilitas Kinerja Instansi Pemerintahan', 'tipe' => 'sakip', 'slug' => 'laporan-kinerja'],
        ]);
    }
}
