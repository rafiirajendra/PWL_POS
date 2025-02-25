<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 101,
                'user_id' => 2,
                'pembeli' => 'Budianto',
                'penjualan_kode' => '01',
                'penjualan_tanggal' => '2025-02-25',
            ],
            [
                'penjualan_id' => 102,
                'user_id' => 3,
                'pembeli' => 'Daniel',
                'penjualan_kode' => '02',
                'penjualan_tanggal' => '2025-02-26',
            ],
            [
                'penjualan_id' => 103,
                'user_id' => 1,
                'pembeli' => 'Azriel',
                'penjualan_kode' => '03',
                'penjualan_tanggal' => '2025-02-27',
            ],
            [
                'penjualan_id' => 104,
                'user_id' => 1,
                'pembeli' => 'Amba',
                'penjualan_kode' => '04',
                'penjualan_tanggal' => '2025-02-28',
            ],
            [
                'penjualan_id' => 105,
                'user_id' => 2,
                'pembeli' => 'Tepe',
                'penjualan_kode' => '05',
                'penjualan_tanggal' => '2025-03-01',
            ],
            [
                'penjualan_id' => 106,
                'user_id' => 3,
                'pembeli' => 'Jot',
                'penjualan_kode' => '06',
                'penjualan_tanggal' => '2025-03-02',
            ],
            [
                'penjualan_id' => 107,
                'user_id' => 1,
                'pembeli' => 'Arap',
                'penjualan_kode' => '07',
                'penjualan_tanggal' => '2025-03-03',
            ],
            [
                'penjualan_id' => 108, 
                'user_id' => 2,
                'pembeli' => 'Speed',
                'penjualan_kode' => '08',
                'penjualan_tanggal' => '2025-03-04',
            ],
            [
                'penjualan_id' => 109,
                'user_id' => 3,
                'pembeli' => 'Garry',
                'penjualan_kode' => '09',
                'penjualan_tanggal' => '2025-03-05',
            ],
            [
                'penjualan_id' => 110,
                'user_id' => 1,
                'pembeli' => 'Niko',
                'penjualan_kode' => '10',
                'penjualan_tanggal' => '2025-03-06',
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
