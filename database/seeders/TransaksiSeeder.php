<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaksi::create([
            'user_id' => 1,
            'kategori' => 'Gaji',
            'keterangan' => 'Gaji bulan Januari',
            'tanggal' => '2023-12-01',
            'jumlahPemasukan' => 10000000,
        ]);
        Transaksi::create([
            'user_id' => 1,
            'kategori' => 'Makanan',
            'keterangan' => 'Sarapan',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 10000,
        ]);
        Transaksi::create([
            'user_id' => 1,
            'kategori' => 'Makanan',
            'keterangan' => 'Makan Siang',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 15000,
        ]);
        Transaksi::create([
            'user_id' => 1,
            'kategori' => 'Makanan',
            'keterangan' => 'Makan di warteg',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 20000,
        ]);
        Transaksi::create([
            'user_id' => 1,
            'kategori' => 'Transportasi',
            'keterangan' => 'Ojek Online',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 15000,
        ]);
        Transaksi::create([
            'user_id' => 1,
            'kategori' => 'Bonus',
            'keterangan' => 'Lembur',
            'tanggal' => '2023-12-01',
            'jumlahPemasukan' => 500000,
        ]);
        Transaksi::create([
            'user_id' => 1,
            'kategori' => 'Hiburan',
            'keterangan' => 'Nonton Film',
            'tanggal' => '2023-12-01',
            'jumlahPengeluaran' => 50000,
        ]);
    }
}
