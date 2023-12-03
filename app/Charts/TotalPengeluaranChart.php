<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Kategori;
use App\Models\Pengeluaran;
use Carbon\Carbon;

class TotalPengeluaranChart
{
    protected $chart;
 
    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $now = Carbon::now();
        $month = $now->month;
        $pengeluaran = Pengeluaran::whereMonth('tanggal', $month)
        ->where('user_id', auth()->user()->id)->get();
        
        $kategori = [];
        foreach ($pengeluaran as $p) {
            $kategori[] = $p->kategori;
        }
        $kategori = array_unique($kategori);
        $kategori = array_values($kategori);
        
        // sum all pengeluaran based on each kategori
        $sumPengeluaran = [];
        foreach ($kategori as $k) {
            $sumPengeluaran[] = Pengeluaran::where('kategori', $k)
            ->whereMonth('tanggal', $month)
            ->where('user_id', auth()->user()->id)->sum('jumlahPengeluaran');
            //convert to int
            $sumPengeluaran = array_map('intval', $sumPengeluaran);
        }
        
        return $this->chart->donutChart()
            ->setTitle('Total Pengeluaran')
            ->setSubtitle('Selama 1 Bulan')
            ->addData($sumPengeluaran)
            // ->setLabels([$kategori[0]])
            // ->addData([10, 20, 30])
            ->setLabels($kategori)
            ->setWidth(340)
            ->setHeight(330);
    }
}
