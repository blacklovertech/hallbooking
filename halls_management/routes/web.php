<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/bookings/view', [BookingController::class, 'view'])->name('bookings.view')->middleware('auth');
Route::get('/bookings/add', [BookingController::class, 'add'])->name('bookings.add')->middleware('auth');
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');



Route::get('/', function () {
    return view('welcome');
});


