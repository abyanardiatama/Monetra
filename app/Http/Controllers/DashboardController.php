<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\TotalPengeluaranChart;
use App\Models\Pengeluaran;
use App\Models\Pemasukan;
use App\Models\Kategori;
use App\Models\Transaksi;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(TotalPengeluaranChart $chart) {
        $jumlahPengeluaran = Pengeluaran::where('user_id', auth()->user()->id)
        ->where('tanggal', 'like', '%'.date('Y-m').'%')->sum('jumlahPengeluaran');
        $jumlahPemasukan = Pemasukan::where('user_id', auth()->user()->id)
        ->where('tanggal', 'like', '%'.date('Y-m').'%')->sum('jumlahPemasukan');
        $totalSaldo = $jumlahPemasukan - $jumlahPengeluaran;
        
        $now = Carbon::now();
        $month = $now->month;
        
        $pengeluaran = Pengeluaran::whereMonth('tanggal', $month)
        ->where('user_id', auth()->user()->id)->get();
        $totalPengeluaran = 0;
        foreach ($pengeluaran as $p) {
            $totalPengeluaran += $p->jumlahPengeluaran;
        }

        $pemasukan = Pemasukan::whereMonth('tanggal', $month)
        ->where('user_id', auth()->user()->id)->get();
        $totalPemasukan = 0;
        foreach ($pemasukan as $p) {
            $totalPemasukan += $p->jumlahPemasukan;
        }
        $totalSaldo = number_format($totalSaldo, 0, ',', '.');
        $totalPengeluaran = number_format($totalPengeluaran, 0, ',', '.');
        $totalPemasukan = number_format($totalPemasukan, 0, ',', '.');

        //get the latest data first
        $transaksiAll = Transaksi::whereMonth('tanggal', $month)->orderBy('updated_at', 'desc')
        ->where('user_id', auth()->user()->id)->get();
        
        $kategoriPemasukan = Kategori::where('jenis', 'Pemasukan')
        ->where('user_id', auth()->user()->id)->get();
        $kategoriPemasukanAll = Kategori::where('jenis', 'Pemasukan')
        ->where('user_id', null)->get();
        $kategoriPemasukan = $kategoriPemasukanAll->merge($kategoriPemasukan);
        
        $kategoriPengeluaran = Kategori::where('jenis', 'Pengeluaran')
        ->where('user_id', auth()->user()->id)->get();
        $kategoriPengeluaranAll = Kategori::where('jenis', 'Pengeluaran')
        ->where('user_id', null)->get();
        $kategoriPengeluaran = $kategoriPengeluaranAll->merge($kategoriPengeluaran);

        return view('dashboard.index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'chart' => $chart->build(),
            'totalSaldo' => $totalSaldo,
            'totalPengeluaran' => $totalPengeluaran,
            'totalPemasukan' => $totalPemasukan,
            'transaksiAll' => $transaksiAll,
            'kategoriPemasukan' => $kategoriPemasukan,
            'kategoriPengeluaran' => $kategoriPengeluaran,
        ]);
    }
}
