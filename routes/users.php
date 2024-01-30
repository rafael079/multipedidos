<?php
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

# Users Endpoints
Route::name('users.')->prefix('users')->group(function () {
    Route::get('{user:id}/cars', [UserController::class, 'cars'])->name('cars');
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::put('update/{user:id}', [UserController::class, 'update'])->name('update');
    Route::delete('delete/{user:id}', [UserController::class, 'delete'])->name('delete');
    Route::patch('attach/{user:id}', [UserController::class, 'attach'])->name('attach');
});