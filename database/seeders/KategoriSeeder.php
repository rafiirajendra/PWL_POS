<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'MRR01',
                'kategori_nama' => 'Monitor',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'MRR02',
                'kategori_nama' => 'Keyboard',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'MRR03',
                'kategori_nama' => 'Mouse',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'MRR04',
                'kategori_nama' => 'Headset',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'MRR05',
                'kategori_nama' => 'Meja',
            ],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
