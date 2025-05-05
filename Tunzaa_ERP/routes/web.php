<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

//  Public routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes (require session 'user')
Route::group(['middleware' => function ($request, $next) {
    if (!session()->has('user')) {
        return redirect()->route('login')->with('error', 'Please log in first.');
    }
    return $next($request);
}], function () {

    // Dashboard
    Route::get('/dashboard', [SaleController::class, 'dashboard'])->name('sales.dashboard');

    // Sales routes
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/export', [SaleController::class, 'export'])->name('sales.export');
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');

    // Inventory routes
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    Route::put('/inventory/{id}', [InventoryController::class, 'update'])->name('inventory.update');

});
