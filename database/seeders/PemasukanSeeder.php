<?php

namespace Database\Seeders;

use App\Http\Requests\UpdatePemasukanRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pemasukan;

class PemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pemasukan::create([
            'user_id' => 1,
            'kategori' => 'Gaji',
            'keterangan' => 'Gaji bulan Januari',
            'tanggal' => '2023-12-01',
            'jumlahPemasukan' => 10000000,
        ]);
        Pemasukan::create([
            'user_id' => 1,
            'kategori' => 'Bonus',
            'keterangan' => 'Lembur',
            'tanggal' => '2023-12-01',
            'jumlahPemasukan' => 500000,
        ]);
    }
}
