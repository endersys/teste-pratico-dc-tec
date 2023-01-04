<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->name('orders.')->group(function () {
    Route::resource('', OrderController::class)->parameters([
        '' => 'order'
    ]);
});

Route::prefix('produtos')->name('products.')->group(function () {
    Route::post('', [ProductController::class, 'store'])->name('store');
});