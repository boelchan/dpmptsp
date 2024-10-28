<?php

namespace Database\Seeders;

use App\Models\IndeksKepuasanMasyarakat;
use Faker\Generator;
use Illuminate\Database\Seeder;

class IKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Generator $faker): void
    {
        $ikm = [
            'Persyaratan Pelayanan',
            'Prosedur Pelayanan',
            'Kecepatan waktu Pelayanan',
            'Biaya/Tarif Pelayanan',
            'Produk Pelayanan',
            'Kompetensi Pelaksana',
            'Perilaku Pelaksana',
            'Sarana dan Prasarana',
            'Penanganan Pengaduan',
        ];
        foreach ($ikm as $key) {
            IndeksKepuasanMasyarakat::create(
                [
                    'unsur' => $key,
                ],
            );
        }
    }
}
