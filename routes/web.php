<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [QrCodeController::class, 'index']);
Route::post('/upload', [QrCodeController::class, 'upload'])->name('upload');
Route::get('/download-pdf', [QrCodeController::class, 'downloadPdf'])->name('download-pdf');
Route::get('/download-selected-pdf', [QrCodeController::class, 'downloadSelectedPdf'])->name('download-selected-pdf');
Route::post('/delete', [QrCodeController::class, 'delete'])->name('delete');