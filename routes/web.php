<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return redirect()->route('products.index');
});

// Products routes dengan nama yang eksplisit
Route::resource('products', ProductController::class)->names([
    'index' => 'products.index',
    'create' => 'products.create',
    'store' => 'products.store',
    'show' => 'products.show',
    'edit' => 'products.edit',
    'update' => 'products.update',
    'destroy' => 'products.destroy'
]);

// Route untuk AJAX search (opsional)
Route::get('/products/search/ajax', [ProductController::class, 'ajaxSearch'])->name('products.ajax.search');

// Atau alternatif lebih sederhana:
// Route::resource('products', ProductController::class);