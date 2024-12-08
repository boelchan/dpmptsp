<?php

namespace Database\Seeders;

use App\Models\Bidang;
use Illuminate\Database\Seeder;

class BidangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bidang::insert([
            ['nama' => 'DPMPTSP'],
            ['nama' => 'Sekretariat'],
            ['nama' => 'Sub Bagian Umum Kearsipan dan Kepegawaian'],
            ['nama' => 'Kelompok Jabatan Substansi Program dan Perencanaan'],
            ['nama' => 'Kelompok Jabatan Fungsional Substansi Bagian Keuangan'],
            ['nama' => 'Kelompok Jabatan Fungsional Substansi Penanaman Modal'],
            ['nama' => 'Kelompok Jabatan Fungsional Substansi Pelayanan Terpadu Satu Pintu'],
        ]);
    }
}
