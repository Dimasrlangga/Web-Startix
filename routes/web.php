<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\TicketOrderController;
use App\Http\Controllers\Admin\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// User Dashboard (tidak login)
Route::get('/', [EventController::class, 'userHome'])->name('user.dashboard');

// Events List (untuk user/guest, tanpa login)
Route::get('/events', [EventController::class, 'userDashboard'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event}/order', [EventController::class, 'orderForm'])->name('events.order');
Route::post('/events/{event}/order', [EventController::class, 'processOrder'])->name('events.order.process');
Route::get('/events/{event}/payment', [EventController::class, 'paymentForm'])->name('events.payment');
Route::post('/events/{event}/payment', [EventController::class, 'processPayment'])->name('events.payment.process');

// API Routes for Charts
Route::get('/api/chart-data', [EventController::class, 'getChartData']);

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route agar user/guest bisa melihat daftar event admin tanpa login
Route::get('/admin/events', [EventController::class, 'index'])->name('admin.events.index');
Route::get('/admin/acara', [EventController::class, 'adminEvents'])->name('admin.acara');



// Admin area (hanya untuk admin/superadmin)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [EventController::class, 'adminDashboard'])->name('dashboard');

    Route::resource('tickets', TicketOrderController::class)->only(['index', 'show', 'update']);
    Route::get('tickets/export-excel', [TicketOrderController::class, 'exportConfirmedExcel'])->name('tickets.export-excel');
    Route::resource('admins', AdminController::class);
    Route::resource('events', EventController::class);
    Route::get('tickets/{order}/download-qr', [TicketOrderController::class, 'downloadQrExcel'])->name('tickets.download-qr');
});
