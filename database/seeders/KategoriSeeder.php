<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::create([
            'nama' => 'Gaji',
            'jenis' => 'Pemasukan',
        ]);
        Kategori::create([
            'nama' => 'Bonus',
            'jenis' => 'Pemasukan',
        ]);
        Kategori::create([
            'nama' => 'THR',
            'jenis' => 'Pemasukan',
        ]);
        Kategori::create([
            'nama' => 'Tabungan',
            'jenis' => 'Pemasukan',
        ]);
        Kategori::create([
            'user_id' => 1,
            'nama' => 'Penjualan',
            'jenis' => 'Pemasukan',
        ]);
        Kategori::create([
            'nama' => 'Investasi',
            'jenis' => 'Pemasukan',
        ]);
        Kategori::create([
            'nama' => 'Lain-lain',
            'jenis' => 'Pemasukan',
        ]);
        Kategori::create([
            'nama' => 'Makanan',
            'jenis' => 'Pengeluaran',
        ]);
        Kategori::create([
            'nama' => 'Transportasi',
            'jenis' => 'Pengeluaran',
        ]);
        Kategori::create([
            'nama' => 'Pendidikan',
            'jenis' => 'Pengeluaran',
        ]);
        Kategori::create([
            'nama' => 'Hiburan',
            'jenis' => 'Pengeluaran',
        ]);
        Kategori::create([
            'nama' => 'Kesehatan',
            'jenis' => 'Pengeluaran',
        ]);
        Kategori::create([
            'user_id' => 1,
            'nama' => 'Pakaian',
            'jenis' => 'Pengeluaran',
        ]);
        Kategori::create([
            'nama' => 'Lain-lain',
            'jenis' => 'Pengeluaran',
        ]);
        

    }
}
