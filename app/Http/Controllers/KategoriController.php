<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
use App\Models\Transaksi;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        $kategori = Kategori::where('user_id', auth()->user()->id);
        $kategoriAll = Kategori::where('user_id', null);
        $kategori = $kategori->union($kategoriAll)->orderBy('created_at', 'desc')->get();

        $search = $request->search;
        if($search){
            //find in $kategori
            $kategori = $kategori->filter(function ($item) use ($search) {
                return stripos($item['nama'], $search) !== false;
            });
            if($kategori->count() == 0){
                return redirect()->back()->with('empty', 'Kategori tidak ditemukan');
            }
            else{
                return view('dashboard.kategori.index',
                [
                    'title' => 'Kategori',
                    'active' => 'kategori',
                    'kategori' => $kategori,
                ]);
            }
        }

        // dd('masuk sini2');
        return view('dashboard.kategori.index',
            [
                'title' => 'Kategori',
                'active' => 'kategori',
                'kategori' => $kategori,
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
    public function store(StoreKategoriRequest $request)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'jenis' => 'required',
            ]
        );
        $validatedData['user_id'] = auth()->user()->id;
        if(Kategori::where('nama', $validatedData['nama'])->where('jenis', $validatedData['jenis'])->exists()){
            return redirect()->back()->with('error', 'Kategori sudah ada');
        }
        Kategori::create($validatedData);
        return redirect('/dashboard/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $validatedData = $request->validate(
            [
                'nama' => 'required',
                'jenis' => 'required',
            ]
        );
        $validatedData['user_id'] = auth()->user()->id;
        
        $transaksi = Transaksi::where('kategori', $kategori->nama)->get();
        $pemasukan = Pemasukan::where('kategori', $kategori->nama)->get();
        $pengeluaran = Pengeluaran::where('kategori', $kategori->nama)->get();
        
        foreach ($transaksi as $t) {
            //update kategori transaksi
            $t->update(['kategori' => $validatedData['nama']]);
        }
        foreach ($pemasukan as $p) {
            $p->update(['kategori' => $validatedData['nama']]);
        }
        foreach ($pengeluaran as $p) {
            $p->update(['kategori' => $validatedData['nama']]);
        }
        $kategori->update($validatedData);
        return redirect('/dashboard/kategori')->with('success', 'Kategori berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategori $kategori)
    {
        $pemasukan = Pemasukan::where('kategori', $kategori->nama)->get();
        $pengeluaran = Pengeluaran::where('kategori', $kategori->nama)->get();
        $transaksi = Transaksi::where('kategori', $kategori->nama)->get();
        foreach ($pemasukan as $p) {
            $p->delete();
        }
        foreach ($pengeluaran as $p) {
            $p->delete();
        }
        foreach ($transaksi as $t) {
            $t->delete();
        }
        $kategori->delete();
        return redirect('/dashboard/kategori')->with('success', 'Kategori berhasil dihapus');
    }
}
