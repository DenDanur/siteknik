<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use App\Models\Item;
use App\Models\User;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'item'])->get();
        return view('admin.pages.peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        $users = User::where('role', 'user')->get();

        return view('admin.pages.peminjaman.create', compact('items', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePeminjamanRequest $request)
    {
        $validasi = $request->validated();

        $item = Item::find($request->item_id);



        if ($item->stock <= 0) {
            return redirect()->route('item.create')->with('error', 'Stok tidak cukup.');
        }
        Peminjaman::create($validasi);

        $item->stock -= 1;
        $item->save();

        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        $items = Item::all();
        $users = User::where('role', 'user')->get();

        return view('admin.pages.peminjaman.edit', compact('items', 'users', 'peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeminjamanRequest $request, Peminjaman $peminjaman)
    {
        // Validasi data
        $validasi = $request->validated();

        // Lakukan update pada model Peminjaman
        $peminjaman->update($validasi);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjaman.index');
    }
}
