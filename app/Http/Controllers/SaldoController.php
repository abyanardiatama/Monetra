<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaldoRequest;
use App\Http\Requests\UpdateSaldoRequest;
use App\Models\Saldo;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $transaksi = Transaksi::where('user_id', auth()->user()->id)->get();
        // dd($transaksi);
        if($transaksi == null){
            return view('dashboard.saldo.index', [
                'title' => 'Saldo',
                'active' => 'saldo',
                'data' => [],
            ]);
        }
        
        $transaksiByMonth = $transaksi->groupBy(function ($transaksi) {
            $tanggal = Carbon::parse($transaksi->tanggal);
            return $tanggal->format('Y-m');
        });
        
        // Calculate the saldo for each month
        $saldoData = [];
        foreach ($transaksiByMonth as $month => $transactions) {
            $totalPemasukan = $transactions->sum('jumlahPemasukan');
            $totalPengeluaran = $transactions->sum('jumlahPengeluaran');
            $sisaSaldo = $totalPemasukan - $totalPengeluaran;

            // Extract month and year from the grouped key
            list($year, $month) = explode('-', $month);

            // Use Carbon to format the month name based on the current locale
            $formattedMonth = Carbon::createFromDate(null, $month, null)->translatedFormat('F');

            // Check if saldo record already exists for the month
            $saldo = Saldo::where('user_id', auth()->user()->id)
                ->where('bulan', $formattedMonth)
                ->where('tahun', $year)
                ->first();
            
            if ($saldo) {
                // If saldo record exists, update it
                $saldo->update(['sisaSaldo' => $sisaSaldo]);
            } else {
                // If saldo record doesn't exist, create a new one
                $saldoData[] = [
                    'user_id' => auth()->user()->id,
                    'bulan' => $formattedMonth,
                    'tahun' => $year,
                    'sisaSaldo' => $sisaSaldo,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Bulk insert new saldo records if any
        Saldo::insert($saldoData);   

        // Get the saldo data
        $saldo = Saldo::where('user_id', auth()->user()->id)->get();
        
        // Search
        $search = $request->search;
        if($search){
            // matchh to all column
            $saldo = Saldo::where('user_id', auth()->user()->id)
            ->Where('bulan', 'like', '%'.$search.'%')
            ->orWhere('tahun', 'like', '%'.$search.'%')
            ->orWhere('sisaSaldo', 'like', '%'.$search.'%')
            ->get();
            // dd($saldo, $search);
            if($saldo->count() == 0){
                return redirect()->back()->with('empty', 'Saldo tidak ditemukan');
            }
            else{
                return view('dashboard.saldo.index', [
                    'title' => 'Saldo',
                    'active' => 'saldo',
                    'saldo' => $saldo,
                ]);
            }
        } 
        
        return view('dashboard.saldo.index', [
            'title' => 'Saldo',
            'active' => 'saldo',
            'saldo' => $saldo,
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
