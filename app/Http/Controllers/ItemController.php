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
        if ($imagePath && Storage::disk('public')->exists('uploads/' . $imagePath)) {
            Storage::disk('public')->delete('uploads/' . $imagePath);
        }
    }

    private function handleImageUpload($image, $oldImage = null)
    {
        try {
            // Hapus gambar lama terlebih dahulu jika ada
            if ($oldImage) {
                $this->deleteOldImage($oldImage);
            }

            // Generate nama file yang unik
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Simpan gambar baru
            $image->storeAs('uploads', $imageName, 'public');

            return $imageName;
        } catch (\Exception $e) {
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

            if ($request->hasFile('image')) {
                $validatedData['image'] = $this->handleImageUpload(
                    $request->file('image'),
                    $item->image // Pass old image for deletion
                );
            }

            $item->update($validatedData);



            return redirect()->route('items.index')->with('success', 'Item berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui item: ' . $e->getMessage());
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
