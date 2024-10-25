<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Subcategories;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Http\Request;


class ItemController extends Controller
{
    private function deleteOldImage($imagePath)
{
    // Ensure that $imagePath does not already include 'uploads/'
    if ($imagePath && Storage::disk('public')->exists($imagePath)) {
        Storage::disk('public')->delete($imagePath);
    }
}

private function handleImageUpload($image, $oldImage = null)
{
    try {
        // Delete the old image if it exists
        if ($oldImage) {
            $this->deleteOldImage($oldImage);
        }

        // Generate a unique file name
        $imageName = time() . '_' . $image->getClientOriginalName();

        // Save the new image in the 'uploads' directory under 'public'
        $image->storeAs('uploads', $imageName, 'public');

        // Return the path to the image that can be saved in the database
        return 'uploads/' . $imageName;
    } catch (\Exception $e) {
        // Uncomment the line below if you want to log the error for further inspection
        // Log::error('Image upload error: ' . $e->getMessage());
        throw new \Exception('Gagal mengupload gambar: ' . $e->getMessage());
    }
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
            $categories = Subcategories::all();
            return view('admin.pages.item.create', compact('categories'));
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


            return redirect()->route('items.index')->with('success', 'Item berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan item: ' . $e->getMessage());
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

        // Handle the image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->handleImageUpload($request->file('image'), $item->image);
        }

        // Update the item
        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui item: ' . $e->getMessage());
    }
}


    public function destroy(Item $item)
    {
        try {
            // Hapus gambar terlebih dahulu
            if ($item->image) {
                $this->deleteOldImage($item->image);
            }



            // Hapus item
            $item->delete();

            return redirect()->route('items.index')->with('success', 'Item berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus item: ' . $e->getMessage());
        }
    }
}
