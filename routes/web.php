<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HistoriesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\ViewUser;
use App\Http\Controllers\ViewuserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
    // Rute Home
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

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
    Route::get('/history', [HistoriesController::class, 'index'])->name('history');

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
    Route::get('/admin/history', [PenyewaanController::class, 'history'])->name('penyewaan.history');
    Route::get('/admin/history/export-pdf', [PenyewaanController::class, 'exportPdf'])->name('admin.history.exportPdf');
    // Route::post('/penyewaan/{penyewaan}/kembali', [PenyewaanController::class, 'kembali'])->name('penyewaan.kembali');
    Route::post('penyewaan/{penyewaan}/kembalikan' , [PenyewaanController::class, 'saveHistory'])->name('penyewaan.kembalikan');
    Route::resource('viewuser' , ViewuserController::class);
    Route::get('/viewuser/{history}/history', [ViewuserController::class, 'history'])->name('viewuser.history');
    Route::get('/get-subcategories/{categoryId}', [SubcategoriesController::class, 'getByCategory']);
    Route::get('/get-items/{subcategoryId}', 'ItemController@getBySubcategory');

});

require __DIR__.'/auth.php';





