<?php

namespace App\Http\Controllers;


use App\Http\Requests\StorePenyewaanRequest;
use App\Http\Requests\UpdatePenyewaanRequest;
use App\Models\Penyewaan;
use App\Models\Histories;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;


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

        $item->stock -= $validasi['jumlah'];
        $item->save();

        return redirect()->route('penyewaan.index');
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

    public function history()
    {
        $riwayats = Histories::all();
        return view('admin.pages.histories.index', compact('riwayats'));
    }

    public function kembalikan(Request $request, Penyewaan $penyewaan)
    {
        $request->validate([
            'kembali' => 'required|date'
        ]);

        $tanggal_kembali = \Carbon\Carbon::parse($request->kembali);
        $tanggal_pinjam = \Carbon\Carbon::parse($penyewaan->tanggal_pinjam);

        $denda = 0;
        if ($tanggal_kembali->gt($tanggal_pinjam->addDays(7))) {
            $daysLate = $tanggal_kembali->diffInDays($tanggal_pinjam->addDays(7));
            $denda = $daysLate * 10000; // Rp 10,000 per day
        }

        // Create history record
        Histories::create([
            'user_id' => $request->user_id,
            'item_id' => $request->item_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->kembali,
            'denda' => $denda,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga
        ]);

        // Update item stock
        $item = Item::find($request->item_id);
        $item->stock += $request->jumlah;
        $item->save();


        // Delete the rental record
        $penyewaan->delete();

        return redirect()->route('penyewaan.index')->with('success', 'Item has been returned successfully');
    }

    public function saveHistory(Request $request, $id)
    {
        // Ambil data penyewaan berdasarkan ID
        $penyewaan = Penyewaan::findOrFail($id);

        // Ambil tanggal kembali dari input (pastikan form mengirimkan tanggal_kembali)
        $tanggal_kembali = $request->input('tanggal_kembali');

        // Hitung batas peminjaman sebagai 7 hari setelah tanggal_pinjam
        $batas_peminjaman = Carbon::parse($penyewaan->tanggal_pinjam)->addDays(7);

        // Hitung denda berdasarkan selisih hari antara batas peminjaman dan tanggal kembali
        $selisih_hari = $batas_peminjaman->diffInDays($tanggal_kembali, false); // false: negative if before batas_peminjaman
        $denda = $selisih_hari > 0 ? $selisih_hari * 10000 : 0; // Contoh: denda 5000 per hari keterlambatan

        $jumlah = $penyewaan->jumlah;
        $harga = $penyewaan->item->price;
        $total_harga = $jumlah * $harga;

        // Simpan data baru ke tabel histories
        Histories::create([
            'penyewaan_id' => $penyewaan->id,
            'user_id' => $penyewaan->user_id,
            'item_id' => $penyewaan->item_id,
            'tanggal_pinjam' => $penyewaan->tanggal_pinjam,
            'tanggal_kembali' => $tanggal_kembali,
            'denda' => $denda,
            'jumlah' => $jumlah,
            'total_harga' => $total_harga,
        ]);

        // Delete the rental record
        $penyewaan->delete();

        // Redirect atau memberikan pesan sukses
        return redirect()->route('penyewaan.index')->with('success', 'Item has been returned successfully');
    }

    public function exportPdf()
    {
        // Ambil semua data penyewaan untuk PDF
        $riwayats = Histories::all();

        // Hitung total harga untuk setiap item peminjaman dan batas peminjaman
        foreach ($riwayats as $history) {
            $history->totalHarga = $history->item->price * $history->jumlah;
            // $history->tanggal_kembali = Carbon::parse($history->tanggal_pinjam)->addDays(5)->format('Y-m-d');
        }

        // Load the view for PDF export
        $pdf = PDF::loadView('admin.pages.histories.history_pdf', compact('riwayats'));
        return $pdf->download('history_peminjaman_admin.pdf');
    }
}
