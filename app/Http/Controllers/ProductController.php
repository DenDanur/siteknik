<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan halaman daftar kategori
    public function index()
    {
        // Ambil semua kategori dari database
        $categories = Category::all();

        // Kirim data kategori ke view
        return view('products.categories', compact('categories'));
    }

    // Menampilkan produk berdasarkan kategori
    public function showCategory($categoryId)
    {
        // Temukan kategori berdasarkan ID
        $category = Category::findOrFail($categoryId);

        // Dummy data produk (bisa diganti dengan query database nanti)
        $products = Item::where('category_id', $categoryId)->get();;

        // Kirim data kategori dan produk ke view
        return view('products.list', [
            'category' => $category->name,
            'products' => $products,
        ]);
    }
}
