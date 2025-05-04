<?php

use App\Http\Controllers\SaleController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// Route to view sales list
Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');

// Route to submit/store new sale
Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');

// Route to view dashboard
Route::get('/dashboard', [SaleController::class, 'dashboard'])->name('dashboard');

// Optional: Home route
Route::get('/', function () {
    return view('dashboard');
});
