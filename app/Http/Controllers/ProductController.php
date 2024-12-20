<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Subcategories;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan halaman daftar kategori
    public function index()
    {
        // Ambil semua kategori dari database
        $categories = Categories::all();

        // Kirim data kategori ke view
        return view('products.categories', compact('categories'));
    }

    // Menampilkan produk berdasarkan kategori
    public function showCategory($categoryId)
    {
        // Temukan kategori berdasarkan ID
        $category = Categories::findOrFail($categoryId);

        // Dummy data produk (bisa diganti dengan query database nanti)
        $subcategories = Subcategories::where('category_id', $categoryId)->get();;

        // Kirim data kategori dan produk ke view
        return view('products.subcategories', compact('category', 'subcategories'));
    }
    public function showSubCategory($subcategoryId)
    {
        // Temukan kategori berdasarkan ID
        $subcategories = Subcategories::findOrFail($subcategoryId);

        $items = Item::where('subcategory_id', $subcategoryId)->get();;

        // Kirim data kategori dan produk ke view
        return view('products.list', [
            'subcategories' => $subcategories->name,
            'items' => $items,
        ]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search'); // Ambil input pencarian

        // Query pencarian berdasarkan nama item
        $items = Item::where('name', 'like', '%' . $search . '%')->get();

        // Kirim data ke view khusus pencarian
        return view('products.search', compact('items', 'search'));
    }
}
