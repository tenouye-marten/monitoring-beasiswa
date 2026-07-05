<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriPenggunaan;

class KategoriPenggunaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [

            [
                'nama' => 'UKT / SPP',
                'keterangan' => 'Pembayaran UKT atau SPP',
            ],

            [
                'nama' => 'Buku',
                'keterangan' => 'Pembelian buku kuliah',
            ],

            [
                'nama' => 'Laptop',
                'keterangan' => 'Pembelian laptop atau perangkat belajar',
            ],

            [
                'nama' => 'Praktikum',
                'keterangan' => 'Biaya praktikum',
            ],

            [
                'nama' => 'Penelitian',
                'keterangan' => 'Biaya penelitian',
            ],

            [
                'nama' => 'Skripsi',
                'keterangan' => 'Biaya penyusunan skripsi',
            ],

            [
                'nama' => 'Transportasi',
                'keterangan' => 'Biaya transportasi',
            ],

            [
                'nama' => 'Kos',
                'keterangan' => 'Biaya tempat tinggal',
            ],

            [
                'nama' => 'Makan',
                'keterangan' => 'Biaya konsumsi',
            ],

            [
                'nama' => 'Internet',
                'keterangan' => 'Kuota internet',
            ],

            [
                'nama' => 'Magang',
                'keterangan' => 'Biaya kegiatan magang',
            ],

            [
                'nama' => 'Lainnya',
                'keterangan' => 'Penggunaan lainnya',
            ],

        ];

        foreach ($kategori as $item) {

            KategoriPenggunaan::updateOrCreate(

                [
                    'nama' => $item['nama']
                ],

                [
                    'keterangan' => $item['keterangan'],
                    'status' => true,
                ]

            );

        }
    }
}