<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Penyewaan;

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

    // Kirim data ke view
    return view('status', compact('peminjaman'));
}
}


