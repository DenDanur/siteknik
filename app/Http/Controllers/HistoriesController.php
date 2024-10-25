<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Histories;
use Illuminate\Support\Facades\Auth;

class HistoriesController extends Controller
{
    public function index()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();
    
        // Query peminjaman berdasarkan user yang login
        $history = Histories::where('user_id', $userId)
                                ->with(['item'])
                                ->get();
    
        // Kirim data ke view
        return view('history', compact('history'));
    }
}
