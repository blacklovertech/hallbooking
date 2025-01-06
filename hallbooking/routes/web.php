<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmenitiesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HallController; 
use App\Http\Controllers\FacultyController; 
use App\Http\Controllers\HodController; 
use App\Http\Controllers\RegistrarController; 


// Authentication Routes

Route::get('/', [AuthController::class, 'index'])->name('auth.index');
Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::get('/register', [AuthController::class, 'registerview'])->name('auth.registerview');
Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

Route::get('/profile', [UserController  ::class, 'dashboard'])->name('profile');

Route::get('/change_password', [UserController  ::class, 'changepassword'])->name('change_password');

// Admin Routes
Route::prefix('admin')->group(function () {
   
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');


    Route::get('/calendar', [CalendarController::class, 'index'])->name('admin.calendar.index');
    Route::get('/api/events', [CalendarController::class, 'fetchEvents'])->name('admin.calendar.events');
    

    Route::get('/halls', [HallController::class, 'index'])->name('admin.halls.index');
    Route::get('/halls/create', [HallController::class, 'create'])->name('admin.halls.create');
    Route::post('/halls/store', [HallController::class, 'store'])->name('admin.halls.store');
    Route::get('/halls/{id}/edit', [HallController::class, 'edit'])->name('admin.halls.edit');
    Route::put('/halls/{id}/update', [HallController::class, 'update'])->name('admin.halls.update');
    Route::delete('/halls/{id}/delete', [HallController::class, 'destroy'])->name('admin.halls.destroy');
    Route::get('/halls/{id}/show', [HallController::class, 'show'])->name('admin.halls.show');

    Route::get('/amenities', [AmenitiesController::class, 'index'])->name('admin.amenities.index');
    Route::get('/amenities/create', [AmenitiesController::class, 'create'])->name('admin.amenities.create');
    Route::post('/amenities/store', [AmenitiesController::class, 'store'])->name('admin.amenities.store');
    Route::get('/amenities/{id}/edit', [AmenitiesController::class, 'edit'])->name('admin.amenities.edit');
    Route::put('/amenities/{id}/update', [AmenitiesController::class, 'update'])->name('admin.amenities.update');
    Route::delete('/amenities/{id}/delete', [AmenitiesController::class, 'destroy'])->name('admin.amenities.destroy');
    Route::get('/amenities/{id}/show', [AmenitiesController::class, 'show'])->name('admin.amenities.show');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{id}/update', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{id}/delete', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/users/{id}/show', [UserController::class, 'show'])->name('admin.users.show');

    Route::post('/users/{id}/assign-hod', [UserController::class, 'assignHod'])->name('admin.users.assign-hod');
    Route::post('/users/{id}/assign-registrar', [UserController::class, 'assignRegistrar'])->name('admin.users.assign-registrar');

    Route::get('/bookings', [BookingController::class, 'index'])->name('admin.bookings.index');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('admin.bookings.create');
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('admin.bookings.store');
    Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('admin.bookings.edit');
    Route::put('/bookings/{id}/update', [BookingController::class, 'update'])->name('admin.bookings.update');
    Route::delete('/bookings/{id}/delete', [BookingController::class, 'destroy'])->name('admin.bookings.destroy');
    Route::get('/bookings/{id}/show', [BookingController::class, 'show'])->name('admin.bookings.show');

    // sample code proxy approval demo
    Route::post('bookings/{id}/approve-hod', [BookingController::class, 'approveFromHod'])->name('admin.bookings.approveFromHod');
    Route::post('bookings/{id}/approve-registrar', [BookingController::class, 'approveFromRegistrar'])->name('admin.bookings.approveFromRegistrar');
    Route::post('bookings/{id}/reject', [BookingController::class, 'reject'])->name('admin.bookings.reject');
});

// Faculty Routes
Route::prefix('faculty')->middleware(['auth', 'faculty'])->group(function () {

    Route::get('/dashboard', [FacultyController::class, 'dashboard'])->name('faculty.dashboard');

   
});

// HOD Routes
Route::prefix('hod')->middleware(['auth', 'hod'])->group(function () {

    Route::get('/dashboard', [HodController::class, 'dashboard'])->name('hod.dashboard');    
    Route::post('bookings/{id}/approve-hod', [BookingController::class, 'approveFromHod'])->name('admin.bookings.approveFromHod');

});

// Registrar Routes
Route::prefix('registrar')->middleware(['auth', 'registrar'])->group(function () {

    Route::get('/dashboard', [RegistrarController::class, 'dashboard'])->name('registrar.dashboard');
    Route::post('bookings/{id}/approve-registrar', [BookingController::class, 'approveFromRegistrar'])->name('admin.bookings.approveFromRegistrar');

   });
