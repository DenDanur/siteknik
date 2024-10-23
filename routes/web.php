<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
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
    Route::get('/products/{categoryId}', [ProductController::class, 'showCategory'])->name('products.category');

    // Rute Status Peminjaman
    Route::get('/status', function () {
        return view('status');
    })->name('status');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/item/create', [ItemController::class, 'create'])->name('item.create');
});

require __DIR__.'/auth.php';

Route::resource('category', CategoryController::class);
Route::resource('items', ItemController::class);
Route::resource('itemdetails',ItemDetailController::class);
