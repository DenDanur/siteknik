<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Penyewaan;
use Carbon\Carbon; // Import Carbon for date manipulation

class StatusController extends Controller
{
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Query peminjaman berdasarkan user yang login
        $peminjaman = Penyewaan::where('user_id', $userId)
                                ->with(['item'])
                                ->get();

        // Inisialisasi grand total
        $grandTotal = 0;

        // Hitung total harga untuk setiap item peminjaman, akumulasi ke grand total, dan hitung batas peminjaman
        foreach ($peminjaman as $pinjam) {
            $pinjam->totalHarga = $pinjam->item->price * $pinjam->jumlah;
            $grandTotal += $pinjam->totalHarga;

            // Tambahkan kolom batas peminjaman (5 hari setelah tanggal_pinjam)
            $pinjam->batas_peminjaman = Carbon::parse($pinjam->tanggal_pinjam)->addDays(5)->format('Y-m-d');
        }

        // Kirim data ke view
        return view('status', compact('peminjaman', 'grandTotal'));
    }
}
