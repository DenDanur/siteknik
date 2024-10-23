<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Subcategories;
use Illuminate\Http\Request;


class SubcategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategories::with('category')->get();
        return view('admin.pages.subcategory.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        return view('admin.pages.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validasi = $request->validate(['name' => 'required|string|max:255','category_id' => 'required|exists:categories,id',]);
        Subcategories::create($validasi);
        return redirect()->route('subcategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategories $subcategories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategories $subcategories)
    {
        return view('admin.pages.subcategory.edit', compact('subcategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategories $subcategories)
    {
        $validasi = $request->validate(['name' => 'required|string|max:255','category_id' => 'required|exists:categories,id',]);
        $subcategories->update($validasi);
        return redirect()->route('subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategories $subcategories)
    {
        $subcategories->delete();
        return redirect()->route('subcategories.index');
    }
}
