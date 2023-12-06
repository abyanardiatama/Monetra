<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Transaksi;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Kategori;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $transaksi = Transaksi::where('user_id', auth()->user()->id)->get();
        
        $kategoriPemasukan = Kategori::where('jenis', 'pemasukan')
        ->where('user_id', auth()->user()->id)->get();
        $kategoriPemasukanAll = Kategori::where('jenis', 'pemasukan')
        ->where('user_id', null)->get();
        $kategoriPemasukan = $kategoriPemasukan->union($kategoriPemasukanAll);

        $kategoriPengeluaran = Kategori::where('jenis', 'pengeluaran')
        ->where('user_id', auth()->user()->id)->get();
        $kategoriPengeluaranAll = Kategori::where('jenis', 'pengeluaran')
        ->where('user_id', null)->get();
        $kategoriPengeluaran = $kategoriPengeluaran->union($kategoriPengeluaranAll);
        

        $search = $request->search;
        if($search){
            // matchh to all column
            $transaksi = Transaksi::where('user_id', auth()->user()->id)
            ->where('keterangan', 'like', '%'.$search.'%')
            ->orWhere('kategori', 'like', '%'.$search.'%')
            ->orWhere('tanggal', 'like', '%'.$search.'%')
            ->orWhere('jumlahPemasukan', 'like', '%'.$search.'%')
            ->orWhere('jumlahPengeluaran', 'like', '%'.$search.'%')
            ->get();
            // dd($transaksi);
            if($transaksi->count() == 0){
                return redirect()->back()->with('empty', 'Transaksi tidak ditemukan');
            }
            else{
                return view('dashboard.transaksi.index',
                [
                    'title' => 'Transaksi',
                    'active' => 'transaksi',
                    'transaksi' => $transaksi,
                    'kategoriPemasukan' => $kategoriPemasukan,
                    'kategoriPengeluaran' => $kategoriPengeluaran,
                ]);
            }
        }

        
        return view('dashboard.transaksi.index',
            [
                'title' => 'Transaksi',
                'active' => 'transaksi',
                'transaksi' => $transaksi,
                'kategoriPemasukan' => $kategoriPemasukan,
                'kategoriPengeluaran' => $kategoriPengeluaran,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        $validatedData = $request->validate(
            [
                'kategori' => 'required',
                'keterangan' => 'required',
                'tanggal' => 'required',
            ]
        );
        $validatedData['user_id'] = auth()->user()->id;
        if($request->jumlahPemasukan){
            $jumlahPemasukan = (int) str_replace('.', '', $request->jumlahPemasukan);
            $validatedData['jumlahPemasukan'] = $jumlahPemasukan;
            // find pemasukan with same value
            $pemasukan = Pemasukan::where('user_id', auth()->user()->id)
            ->where('kategori', $transaksi->kategori)
            ->where('keterangan', $transaksi->keterangan)
            ->where('tanggal', $transaksi->tanggal)
            ->where('jumlahPemasukan', $transaksi->jumlahPemasukan)
            ->first();
            // update pemasukan
            $pemasukan->update($validatedData);
        }
        if($request->jumlahPengeluaran){
            $jumlahPengeluaran = (int) str_replace('.', '', $request->jumlahPengeluaran);
            $validatedData['jumlahPengeluaran'] = $jumlahPengeluaran;
            // find pengeluaran with same value
            $pengeluaran = Pengeluaran::where('user_id', auth()->user()->id)
            ->where('kategori', $transaksi->kategori)
            ->where('keterangan', $transaksi->keterangan)
            ->where('tanggal', $transaksi->tanggal)
            ->where('jumlahPengeluaran', $transaksi->jumlahPengeluaran)
            ->first();
            // update pengeluaran
            $pengeluaran->update($validatedData);
        }
        $transaksi->update($validatedData);
        return redirect('/dashboard/transaksi')->with('success', 'Transaksi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        if($transaksi->jumlahPemasukan){
            $pemasukan = Pemasukan::where('user_id', auth()->user()->id) 
            ->where('kategori', $transaksi->kategori)
            ->where('keterangan', $transaksi->keterangan)
            ->where('tanggal', $transaksi->tanggal)
            ->where('jumlahPemasukan', $transaksi->jumlahPemasukan)
            ->first();
            $pemasukan->delete();
        }
        if($transaksi->jumlahPengeluaran){
            $pengeluaran = Pengeluaran::where('user_id', auth()->user()->id)
            ->where('kategori', $transaksi->kategori)
            ->where('keterangan', $transaksi->keterangan)
            ->where('tanggal', $transaksi->tanggal)
            ->where('jumlahPengeluaran', $transaksi->jumlahPengeluaran)
            ->first();
            $pengeluaran->delete();
        }
        $transaksi->delete();
        return redirect('/dashboard/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }
}
