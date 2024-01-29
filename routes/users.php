<?php
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

# Users Endpoints
Route::name('users.')->prefix('users')->group(function () {
    Route::post('store', [UserController::class, 'store'])->name('store');
    Route::put('update/{user:id}', [UserController::class, 'update'])->name('update');
    Route::delete('delete/{user:id}', [UserController::class, 'delete'])->name('delete');
    Route::patch('connect/{user:id}', [UserController::class, 'connect'])->name('connect');
    Route::patch('disconnect/{user:id}', [UserController::class, 'disconnect'])->name('connect');
});