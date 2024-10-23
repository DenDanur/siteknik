<?php

<<<<<<< HEAD
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
=======
use App\Http\Controllers\CategoriesController;
>>>>>>> e026bc8bc6f744b0be1a1ff4ca230e4843652383
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
<<<<<<< HEAD
use App\Http\Controllers\ProductController;
=======
use App\Http\Controllers\SubcategoriesController;
>>>>>>> e026bc8bc6f744b0be1a1ff4ca230e4843652383
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


Route::resource('items', ItemController::class);
Route::resource('categories', CategoriesController::class);
Route::resource('subcategories', SubcategoriesController::class);


