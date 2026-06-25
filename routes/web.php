<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\DashboardController;

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::delete('/product-images/{productImage}', [ProductImageController::class, 'destroy'])
    ->name('product-images.destroy');
Route::resource('sizes', SizeController::class);
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');