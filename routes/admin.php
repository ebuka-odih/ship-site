<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ShipmentPdfController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User management routes
    Route::resource('users', AdminController::class)->only([
        'index', 'create', 'store', 'show', 'edit', 'update', 'destroy'
    ])->parameters([
        'users' => 'user'
    ]);
    
    // Custom route names for user management
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    
    // Shipment management routes
    Route::resource('shipments', ShipmentController::class);
    Route::post('/shipments/{shipment}/tracking', [ShipmentController::class, 'addTrackingEvent'])->name('shipments.tracking');
    
    // Shipment history routes
    Route::post('/shipments/{shipment}/history', [ShipmentController::class, 'storeHistory'])->name('shipments.history.store');
    Route::delete('/shipments/{shipment}/history/{history}', [ShipmentController::class, 'destroyHistory'])->name('shipments.history.destroy');
    
    // PDF generation routes
    Route::get('/shipments/{shipment}/pdf', [ShipmentPdfController::class, 'generateShipmentPdf'])->name('shipments.pdf');
    Route::get('/shipments/{shipment}/label', [ShipmentPdfController::class, 'generateShippingLabel'])->name('shipments.label');
    Route::get('/shipments/{shipment}/invoice', [ShipmentPdfController::class, 'generateInvoice'])->name('shipments.invoice');
    
    // Settings routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::post('/settings/general', [SettingsController::class, 'updateGeneral'])->name('settings.general');
    Route::post('/settings/mail', [SettingsController::class, 'updateMail'])->name('settings.mail');
    Route::post('/settings/livechat', [SettingsController::class, 'updateLivechat'])->name('settings.livechat');
    Route::post('/settings/test-mail', [SettingsController::class, 'testMail'])->name('settings.test-mail');
});

