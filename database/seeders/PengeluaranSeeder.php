<?php

namespace Database\Seeders;

use App\Models\Pengeluaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengeluaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengeluaran::create([
            'user_id' => 1,
            'kategori' => 'Makanan',
            'keterangan' => 'Sarapan',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 10000,
        ]);
        Pengeluaran::create([
            'user_id' => 1,
            'kategori' => 'Makanan',
            'keterangan' => 'Makan Siang',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 15000,
        ]);
        Pengeluaran::create([
            'user_id' => 1,
            'kategori' => 'Makanan',
            'keterangan' => 'Makan di warteg',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 20000,
        ]);
        Pengeluaran::create([
            'user_id' => 1,
            'kategori' => 'Transportasi',
            'keterangan' => 'Ojek Online',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 15000,
        ]);
        Pengeluaran::create([
            'user_id' => 1,
            'kategori' => 'Hiburan',
            'keterangan' => 'Nonton Film',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 50000,
        ]);

    }
}
