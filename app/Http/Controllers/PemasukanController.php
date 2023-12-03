<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePemasukanRequest;
use App\Http\Requests\UpdatePemasukanRequest;
use App\Models\Pemasukan;
use App\Models\Transaksi;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pemasukan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pemasukan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePemasukanRequest $request)
    {
        //delete . thousand separator from jumlahPemasukan
        $jumlahPemasukan = (int) str_replace('.', '', $request->jumlahPemasukan);
        $validatedData = $request->validate(
            [
                'kategori' => 'required',
                'keterangan' => 'required',
                'tanggal' => 'required',
                'jumlahPemasukan' => 'required',
            ]
        );
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['jumlahPemasukan'] = $jumlahPemasukan;
        Pemasukan::create($validatedData);
        Transaksi::create($validatedData);
        return redirect('/dashboard')->with('success', 'Pemasukan berhasil ditambahkan');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePemasukanRequest $request, Pemasukan $pemasukan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemasukan $pemasukan)
    {
        //
    }
}
