<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;

Route::get('/', [QrCodeController::class, 'index'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::post('/upload', [QrCodeController::class, 'upload'])->name('upload');
    Route::get('/download-pdf', [QrCodeController::class, 'downloadPdf'])->name('download-pdf');
    Route::get('/download-selected-pdf', [QrCodeController::class, 'downloadSelectedPdf'])->name('download-selected-pdf');
    Route::post('/delete', [QrCodeController::class, 'delete'])->name('delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// Include the Breeze authentication routes
require __DIR__.'/auth.php';