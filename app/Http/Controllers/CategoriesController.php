<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();
        return view('admin.pages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $validasi = $request->validate(['name' => 'required|string|max:255|unique:categories,name']);
    //     Categories::create($validasi);
    //     return redirect()->route('categories.index');
    // }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255|unique:categories,name',
            ]);

            Categories::create($validatedData);
            
            return redirect()
                ->route('categories.index')
                ->with('success', 'Category created successfully');
                
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->with('error', 'Category name already exists!')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {
        return view('admin.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $category)
    {
        $validasi = $request->validate(['name' => 'required|string|max:255']);
        $category->update($validasi);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
