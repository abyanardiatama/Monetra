<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengeluaranRequest;
use App\Http\Requests\UpdatePengeluaranRequest;
use App\Models\Pengeluaran;
use App\Models\Transaksi;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.pengeluaran.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pengeluaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengeluaranRequest $request)
    {
        $jumlahPengeluaran = (int) str_replace('.', '', $request->jumlahPengeluaran);
        $validatedData = $request->validate(
            [
                'kategori' => 'required',
                'keterangan' => 'required',
                'tanggal' => 'required',
                'jumlahPengeluaran' => 'required',
            ]
        );
        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['jumlahPengeluaran'] = $jumlahPengeluaran;
        Pengeluaran::create($validatedData);
        Transaksi::create($validatedData);
        return redirect('/dashboard')->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengeluaranRequest $request, Pengeluaran $pengeluaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengeluaran $pengeluaran)
    {
        //
    }
}
