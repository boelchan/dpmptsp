<?php

namespace Database\Seeders;

use App\Models\Instansi;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $instansi = [
            'DPMPTSP',
            'DISDUKCAPIL',
            'PU. PRKP & Cipta Karya',
            'PU Sumber Daya Air',
            'PU Bina Marga',
            'DINAS LINGKUNGAN HIDUP',
            'Dinas Kesehatan',
            'BPPKAD',
            'BPJS Kesehatan',
            'BPJS Ketenagakerjaan',
            'Kantor Samsat',
            'Dinas Perhubungan',
            'BKPSDM',
            'BANK JATIM',
            'BPRS',
        ];
        foreach ($instansi as $key) {
            Instansi::create(
                [
                    'uuid' => $faker->uuid(),
                    'nama' => $key,
                    'slug' => Str::slug($key),
                ],
            );
        }
    }
}
