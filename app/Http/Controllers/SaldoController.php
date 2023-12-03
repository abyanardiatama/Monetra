<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaldoRequest;
use App\Http\Requests\UpdateSaldoRequest;
use App\Models\Saldo;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $pemasukan = Pemasukan::where('user_id', auth()->user()->id)->get();
        $pengeluaran = Pengeluaran::where('user_id', auth()->user()->id)->get();

        //get total pemasukan from pemasukan for each month
        $bulanPemasukan = [];
        $tahunPemasukan = [];
        $totalPemasukan = [];
        foreach($pemasukan as $pemasukan){
            $bulanPemasukan[] = date('m', strtotime($pemasukan->tanggal));
            $tahunPemasukan[] = date('Y', strtotime($pemasukan->tanggal));
            $tahunPemasukan = array_unique($tahunPemasukan);
            $bulanPemasukan = array_unique($bulanPemasukan);
        }
        foreach($bulanPemasukan as $bulan){
            $namaBulan[] = date('F', mktime(0, 0, 0, $bulan, 10));
        }
        foreach($bulanPemasukan as $bulan){
            $totalPemasukan[] = Pemasukan::where('user_id', auth()->user()->id)
            ->whereMonth('tanggal', $bulan)->sum('jumlahPemasukan');
        }
        //merge ($namaBulan, $tahunPemasukan, $totalPemasukan) into array based its id
        // ex: $namaBulan[0] = January, $tahunPemasukan[0] = 2021, $totalPemasukan[0] = 1000000
        // then $data[0] = ['namaBulan' => 'January', 'tahunPemasukan' => 2021, 'totalPemasukan' => 1000000]
        $data = [];
        foreach($namaBulan as $key => $value){
            $data[] = [
                'namaBulan' => $value,
                'tahunPemasukan' => $tahunPemasukan[$key],
                'totalPemasukan' => $totalPemasukan[$key],
            ];
        }
        
        if($request->search){
            
        }
        return view('dashboard.saldo.index',[
            'title' => 'Saldo',
            'active' => 'saldo',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.saldo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaldoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Saldo $saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaldoRequest $request, Saldo $saldo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saldo $saldo)
    {
        //
    }
}
