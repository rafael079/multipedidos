<?php
use App\Http\Controllers\Api\CarController;
use Illuminate\Support\Facades\Route;

# Car Endpoints
Route::name('cars.')->prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index'])->name('index');
    Route::post('store', [CarController::class, 'store'])->name('store');
    Route::put('update/{car:id}', [CarController::class, 'update'])->name('update');
    Route::delete('delete/{car:id}', [CarController::class, 'delete'])->name('delete');
});