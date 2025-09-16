<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web3AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Web3 / Metamask Authentication
Route::prefix('eth')->group(function () {
    Route::get('/signature', [Web3AuthController::class, 'signature']);
    Route::post('/authenticate', [Web3AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
