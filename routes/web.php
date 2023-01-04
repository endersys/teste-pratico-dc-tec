<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('')->name('orders.')->group(function () {
    Route::resource('', OrderController::class)->parameters([
        '' => 'order'
    ]);
});