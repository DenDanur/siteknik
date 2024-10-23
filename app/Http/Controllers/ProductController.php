<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan halaman kategori produk
    public function index()
    {
        $categories = [
            'weapons' => 'Weapons',
            'vehicles' => 'Vehicles',
            'gear' => 'Military Gear',
        ];

        return view('products.categories', compact('categories'));
    }

    // Menampilkan produk berdasarkan kategori
    public function showCategory($category)
    {
        $products = [
            'weapons' => [
                ['name' => 'AK-47', 'description' => 'A powerful rifle.'],
                ['name' => 'M16', 'description' => 'Reliable and versatile rifle.'],
            ],
            'vehicles' => [
                ['name' => 'Tank', 'description' => 'Heavy armored vehicle.'],
                ['name' => 'Humvee', 'description' => 'All-terrain military vehicle.'],
            ],
            'gear' => [
                ['name' => 'Tactical Vest', 'description' => 'Bulletproof gear.'],
                ['name' => 'Night Vision Goggles', 'description' => 'See in the dark.'],
            ],
        ];

        return view('products.list', [
            'category' => ucfirst($category),
            'products' => $products[$category] ?? [],
        ]);
    }
}

