<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\VisitorController;

Route::get('/', [QrCodeController::class, 'index'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/qr-codes/data', [QrCodeController::class, 'getQrCodesData'])->name('qr-codes.data');

    Route::get('/progress', [QrCodeController::class, 'getProgress'])->name('progress');
    Route::post('/upload', [QrCodeController::class, 'upload'])->name('upload');

    Route::get('/download-pdf', [QrCodeController::class, 'downloadPdf'])->name('download-pdf');
    Route::get('/download-selected-pdf', [QrCodeController::class, 'downloadSelectedPdf'])->name('download-selected-pdf');
    Route::post('/download-pdf-range', [QrCodeController::class, 'downloadPdfByRange'])->name('download-pdf-range');

    Route::get('/preview-pdf/{startSerial}/{endSerial}', [QrCodeController::class, 'previewPdf'])->name('preview-pdf');

    Route::post('/delete', [QrCodeController::class, 'delete'])->name('delete');
    Route::post('/delete-selected', [QrCodeController::class, 'deleteSelected'])->name('delete-selected');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // clients route
    Route::resource('/clients', ClientController::class)->except(['show']);
    Route::get('/clients/data', [ClientController::class, 'getClientsData'])->name('clients.data');
    Route::get('/clients/sort', [ClientController::class, 'sortClients'])->name('clients.sort');
    Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');
    Route::post('/clients/delete', [ClientController::class, 'destory'])->name('clients.destroy');

    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');
    // Operation routes
    Route::get('/clients/{id}/operations', [ClientController::class, 'operationsData'])->name('clients.operations.data');
    Route::post('/clients/{id}/operations-store', [ClientController::class, 'storeOperation'])->name('operations.store');
    Route::put('/clients/{clientId}/operations-update/{operationId}', [ClientController::class, 'updateOperation'])->name('operations.update');
    Route::delete('/clients/{clientId}/operations-delete/{operationId}', [ClientController::class, 'destroyOperation'])->name('operations.destroy');
    Route::post('/clients/{id}/apps', [ClientController::class, 'storeClientApp'])->name('clients.storeApp');
    Route::delete('/clients/{clientId}/apps/{clientAppId}', [ClientController::class, 'deleteClientApp'])->name('clients.deleteApp');
    // client's device serial number list
    Route::get('/clients/{id}/device-sn', [ClientController::class, 'deviceSNData'])->name('clients.deviceSN.data');

    //apps
    Route::resource('/apps', AppController::class)->except(['show', 'update', 'destroy']);
    Route::get('/apps/data', [AppController::class, 'getAppsData'])->name('apps.data');
    Route::post('/apps/store', [AppController::class, 'store'])->name('apps.store');
    Route::put('/apps/{id}/update', [AppController::class, 'update'])->name('apps.update');
    Route::delete('/apps/{id}/delete', [AppController::class, 'destroy'])->name('apps.destroy');

    //devices
    Route::resource('/devices', DeviceController::class)->except(['show', 'update', 'destroy']);
    Route::get('/devices/data', [DeviceController::class, 'getDevicesData'])->name('devices.data');
    Route::post('/devices/store', [DeviceController::class, 'store'])->name('devices.store');
    Route::put('/devices/{id}/update', [DeviceController::class, 'update'])->name('devices.update');
    Route::delete('/devices/{id}/delete', [DeviceController::class, 'destroy'])->name('devices.destroy');


    //visitor
    // Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');


});

Route::get('/dashboard', function () {
    return redirect('/');
})->middleware(['auth', 'verified'])->name('dashboard');

// Include the Breeze authentication routes
require __DIR__.'/auth.php';
