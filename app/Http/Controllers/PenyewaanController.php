<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePenyewaanRequest;
use App\Http\Requests\UpdatePenyewaanRequest;
use App\Models\Penyewaan;
use App\Models\Histories;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;


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
        return view('admin.pages.penyewaan.pengembalian', compact('penyewaan'));
    }

    public function processReturn(Request $request, Penyewaan $penyewaan)
    {
        $request->validate([
            'kembali' => 'required|date'
        ]);

        // Calculate fine (denda) if needed
        $tanggal_kembali = \Carbon\Carbon::parse($request->kembali);
        $tanggal_pinjam = \Carbon\Carbon::parse($penyewaan->tanggal_pinjam);
        
        $denda = 0;
        if ($tanggal_kembali->gt($tanggal_pinjam->addDays(7))) {
            $daysLate = $tanggal_kembali->diffInDays($tanggal_pinjam->addDays(7));
            $denda = $daysLate * 10000; // Rp 10,000 per day
        }

        // Create history record
        Histories::create([
            'user_id' => $penyewaan->user_id,
            'item_id' => $penyewaan->item_id,
            'tanggal_pinjam' => $penyewaan->tanggal_pinjam,
            'tanggal_kembali' => $request->kembali,
            'denda' => $denda,
            'jumlah' => $penyewaan->jumlah,
            'total_harga' => $penyewaan->total_harga
        ]);

        // Update item stock
        $item = Item::find($penyewaan->item_id);
        $item->stock += $penyewaan->jumlah;
        $item->save();

        // Delete the rental record
        $penyewaan->delete();

        return redirect()->route('penyewaan.index')->with('success', 'Item has been returned successfully');
    }

    public function history()
    {
        $histories = Histories::with(['user', 'item'])->orderBy('created_at', 'desc')->get();
        return view('admin.pages.histories.index', compact('histories'));
    }

    public function kembali(Penyewaan $penyewaan)
    {
        return $penyewaan;
    }
}
