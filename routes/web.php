<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubcategoriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute Home
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Rute Product
    Route::get('/product', function () {
        return view('product');
    })->name('product');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/category/{categoryId}', [ProductController::class, 'showCategory'])->name('products.category');
    Route::get('/products/subcategory/{subcategoryId}', [ProductController::class, 'showSubCategory'])->name('products.list');
    Route::get('/search', [ProductController::class, 'search'])->name('items.search');

    // Rute Status Peminjaman
    Route::get('/status', [StatusController::class, 'index'])->name('status');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('items', ItemController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('subcategories', SubcategoriesController::class);
    Route::get('/admin/item/create', [ItemController::class, 'create'])->name('item.create');
    Route::resource('penyewaan', PenyewaanController::class);
    Route::get('/penyewaan/{penyewaan}/pengembalian', [PenyewaanController::class, 'showpengembalian'])->name('penyewaan.pengembalian');
    Route::post('/penyewaan/{penyewaan}/kembali', [PenyewaanController::class, 'kembali'])->name('penyewaan.kembali');
});

require __DIR__.'/auth.php';





