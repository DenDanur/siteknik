<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Subcategories;
use Illuminate\Http\Request;

class SubcategoriesController extends Controller
{
    public function index()
    {
        $subcategories = Subcategories::with('category')->get();
        return view('admin.pages.subcategory.index', compact('subcategories'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('admin.pages.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $validasi = $request->validate([
            'name' => 'required|string|max:255|unique:subcategories,name',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        Subcategories::create($validasi);
        return redirect()->route('subcategories.index')->with('success', 'Subcategory created successfully');
        
        }   catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->with('error', 'Subcategory name already exists!')
                ->withInput();
        }
    }

    public function getByCategory($categoryId)
{
    $subcategories = Subcategories::where('category_id', $categoryId)->get();
    return response()->json($subcategories);
}

    public function edit(Subcategories $subcategory)
    {
        $categories = Categories::all();
        return view('admin.pages.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, Subcategories $subcategory)
    {
        $validasi = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        $subcategory->update($validasi);
        return redirect()->route('subcategories.index')->with('success', 'Subcategory updated successfully');
    }

    public function destroy(Subcategories $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index')->with('success', 'Subcategory deleted successfully');
    }
}