<?php
use App\Http\Controllers\Api\CarController;
use Illuminate\Support\Facades\Route;

# Car Endpoints
Route::name('car.')->prefix('car')->group(function () {
    Route::post('store', [CarController::class, 'store'])->name('store');
});