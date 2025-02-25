<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 3,
                'barang_kode' => '031',
                'barang_nama' => 'Logitech G502 HERO',
                'harga_beli' => 1000000,
                'harga_jual' => 25000000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 3,
                'barang_kode' => '032',
                'barang_nama' => 'Razer DeathAdder V2',
                'harga_beli' => 600000,
                'harga_jual' => 10000000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 1,
                'barang_kode' => '011',
                'barang_nama' => 'ASUS TUF Gaming VG249Q',
                'harga_beli' => 1500000,
                'harga_jual' => 20000000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 1,
                'barang_kode' => '012',
                'barang_nama' => 'LG UltraGear 27GL850-B',
                'harga_beli' => 3000000,
                'harga_jual' => 50000000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 2,
                'barang_kode' => '021',
                'barang_nama' => 'SteelSeries Apex Pro',
                'harga_beli' => 100000,
                'harga_jual' => 1500000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 2,
                'barang_kode' => '022',
                'barang_nama' => 'Razer BlackWidow V4',
                'harga_beli' => 100000,
                'harga_jual' => 1550000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => '041',
                'barang_nama' => 'HyperX Cloud II',
                'harga_beli' => 800000,
                'harga_jual' => 15000000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => '042',
                'barang_nama' => 'Logitech G Pro X',
                'harga_beli' => 300000,
                'harga_jual' => 700000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => '051',
                'barang_nama' => 'Secretlab Magnus',
                'harga_beli' => 800000,
                'harga_jual' => 15500000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => '052',
                'barang_nama' => 'Eureka Ergonomic Z1-S',
                'harga_beli' => 500000,
                'harga_jual' => 70000000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
