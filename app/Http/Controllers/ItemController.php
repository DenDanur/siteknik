<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Subcategories;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Categories;
use Illuminate\Http\Request;



class ItemController extends Controller
{


    protected function deleteOldImage($imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    protected function handleImageUpload($image)
    {
        return $image->store('images', 'public'); // Menyimpan gambar di folder 'storage/app/public/images'
    }


    public function index(Request $request)
    {
        try {
            $items = Item::with('category')->get();
            return view('admin.pages.item.index', compact('items'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data');
        }
    }

    public function create()
    {
        try {
            $categories = Categories::all();
            $subcategories = Subcategories::with('category')->get();
            return view('admin.pages.item.create', compact('categories','subcategories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat form');
        }
    }


    public function store(StoreItemRequest $request)
    {


        try {
            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                $validatedData['image'] = $this->handleImageUpload($request->file('image'));
            }

            
            Item::create($validatedData);


            return redirect()->route('items.index')->with('success', 'Item created successfully');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->with('error', 'Item code already exists!')
                ->withInput();
        }
    }

    public function show(Item $item)
    {
        try {
            return view('admin.pages.item.show', compact('item'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menampilkan item');
        }
    }

    public function edit(Item $item)
    {
        try {
            $categories = Subcategories::all();
            return view('admin.pages.item.edit', compact('item', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat form edit');
        }
    }

    public function update(UpdateItemRequest $request, Item $item)
    {
        try {
            $validatedData = $request->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                $validatedData['image'] = $this->handleImageUpload($request->file('image'), $item->image);
            }

            // Update item data
            $item->update($validatedData);

            return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui item: ' . $e->getMessage());
        }
    }

    public function destroy(Item $item)
    {
        try {
            // Delete old image if it exists
            if ($item->image) {
                $this->deleteOldImage($item->image);
            }

            // Delete item
            $item->delete();

            return redirect()->route('items.index')->with('success', 'Item berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus item: ' . $e->getMessage());
        }
    }
}
