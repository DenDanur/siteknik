<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use App\Http\Requests\StorePenyewaanRequest;
use App\Http\Requests\UpdatePenyewaanRequest;
use App\Models\Item;
use App\Models\User;


class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewaans = Penyewaan::with(['user', 'item'])->get();
        return view('admin.pages.penyewaan.index', compact('penyewaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();
        $users = User::where('role', 'user')->get();

        return view('admin.pages.penyewaan.create', compact('items', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenyewaanRequest $request)
    {
        $validasi = $request->validated();

        $item = Item::find($request->item_id);



        if ($item->stock <= 0) {
            return redirect()->route('penyewaan.create')->with('error', 'Stok tidak cukup.');
        }
        Penyewaan::create($validasi);

        $item->stock -= 1;
        $item->save();

        return redirect()->route('penyewaan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyewaan $penyewaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyewaan $penyewaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenyewaanRequest $request, Penyewaan $penyewaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyewaan $penyewaan)
    {
        //
    }

    public function showpengembalian(Penyewaan $penyewaan)
    {
        return view('admin.pages.penyewaan.pengembalian',compact('penyewaan'));
    }

    public function kembali(Penyewaan $penyewaan)
    {
        return $penyewaan;
    }
}
