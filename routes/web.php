<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::prefix('vendas')->name('sales.')->group(function () {
        Route::get('', [SaleController::class, 'index'])->name('index');
        Route::get('{order}', [SaleController::class, 'generatePDF'])->name('generatePDF');
    });

    Route::prefix('')->name('orders.')->group(function () {
        Route::resource('', OrderController::class)->parameters([
            '' => 'order'
        ]);
        Route::get('{order}/payment', [OrderController::class, 'payment'])->name('payment');
        Route::post('{order}/payment', [OrderController::class, 'payOrder'])->name('payOrder');
    });

    Route::prefix('produtos')->name('products.')->group(function () {
        Route::post('', [ProductController::class, 'store'])->name('store');
    });
});
