<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        // Ambil semua file gambar dari folder 'public/images'
        $images = array_filter(scandir(public_path('images')), function($file) {
            return in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']);
        });

        return view('dashboard', compact('images'));
    }

}
