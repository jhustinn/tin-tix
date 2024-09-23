<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MovieController::class, 'index'])->name('home');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('register');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'auth'])->name('auth');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/movies/{movie}/book/{date}/{showtime}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/movies/{movie}/book/{date}/{showtime}', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    
    Route::get('/invoice/{booking}', [BookingController::class, 'invoice'])->name('booking.invoice');
    Route::post('/payment/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');

    Route::get('/java', [AdminController::class,'java'])->name('java.index');
});

Route::middleware('admin.auth')->group(function () {
    Route::get('/admin', [AdminController::class,'index'])->name('admin.home');
    Route::get('/admin/movies', [MovieController::class,'movies'])->name('admin.movies');
    Route::get('/admin/movies/create', [MovieController::class,'create'])->name('admin.movies.add');
    Route::post('/admin/movies/store', [MovieController::class,'store'])->name('admin.movies.store');
    Route::get('/admin/movies/edit', [MovieController::class,'edit'])->name('admin.movies.edit');
    Route::put('/admin/movies/update', [MovieController::class,'update'])->name('admin.movies.update');
    Route::delete('/admin/movies/destroy', [MovieController::class,'destroy'])->name('admin.movies.destroy');
    
    Route::get('/admin/dates', [DateController::class,'index'])->name('admin.dates');
    Route::get('/admin/dates/create', [DateController::class,'create'])->name('admin.dates.add');
    Route::post('/admin/dates/store', [DateController::class,'store'])->name('admin.dates.store');
    
    
    Route::get('/admin/showtimes', [ShowtimeController::class,'showtimes'])->name('admin.showtimes');
    
});



