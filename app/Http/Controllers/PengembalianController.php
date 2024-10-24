<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use App\Http\Requests\StorePengembalianRequest;
use App\Http\Requests\UpdatePengembalianRequest;
use App\Models\Peminjaman;



class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Menampilkan daftar pengembalian
        $pengembalians = Pengembalian::with('peminjaman')->get();
        return view('admin.pages.pengembalian.index', compact('pengembalians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Form untuk pengembalian baru
        $peminjaman = Peminjaman::all(); // Pilih peminjaman yang akan dikembalikan
        return view('admin.pages.pengembalian.create', compact('peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengembalianRequest $request)
    {
        // Validasi request
        $validasi = $request->validated();

        // Temukan peminjaman berdasarkan ID
        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        // Tentukan tanggal pengembalian dan hitung denda
        $tanggalSekarang = now();
        $tanggalPeminjaman = $peminjaman->tanggal_peminjaman;
        $selisihHari = $tanggalSekarang->diffInDays($tanggalPeminjaman);
        $denda = 0;

        if ($selisihHari > 5) {
            $denda = ($selisihHari - 5) * 1000; // Denda 1000 per hari setelah 5 hari
        }

        // Buat entri pengembalian
        Pengembalian::create([
            'peminjaman_id' => $validasi['peminjaman_id'],
            'tanggal_pengembalian' => $validasi['tanggal_kembali'],
            'denda' => $denda,
        ]);

        // Kembalikan item dengan menambah kembali stok
        $item = $peminjaman->item;
        $item->stock += 1;
        $item->save();

        return redirect()->route('pengembalian.index')->with('success', 'Item berhasil dikembalikan.' . ($denda > 0 ? ' Denda: ' . $denda : ''));
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengembalian $pengembalian)
    {
        // return view('admin.pages.pengembalian.edit', compact('pengembalian'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengembalianRequest $request, Pengembalian $pengembalian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengembalian $pengembalian)
    {
        $pengembalian->delete();
        return redirect()->route('pengembalian.index')->with('success', 'Pengembalian berhasil dihapus.');
    }
}
