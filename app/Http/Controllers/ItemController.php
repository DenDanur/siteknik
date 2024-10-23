<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Categories;
use App\Models\ItemDetail;
use App\Models\Subcategories;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $items = Item::with(['category', 'detail'])->get();
        return view('admin.pages.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Subcategories::all();
        return view('admin.pages.item.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)
    {
        // Validasi data menggunakan request yang sudah divalidasi
        $validasi = $request->validated();

        // Simpan item baru
        $item = Item::create($validasi); // Menggunakan $validasi langsung

        // Simpan detail item
        ItemDetail::create(array_merge($validasi, ['item_id' => $item->id]));

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // Menampilkan detail item (jika diperlukan)
        return view('admin.pages.item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $categories = Subcategories::all();
        return view('admin.pages.item.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
        // Validasi data menggunakan request yang sudah divalidasi
        $validasi = $request->validated();

        // Update item
        $item->update($validasi); // Menggunakan $validasi langsung

        // Update detail item
        $item->detail->update($validasi); // Menggunakan $validasi langsung
        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('items.index')->with('success', 'Item deleted successfully.');
    }
}
