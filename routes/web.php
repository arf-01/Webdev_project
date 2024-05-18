<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager; 
use App\Http\Middleware\Admin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\Recover;
use App\Http\Controllers\CartControlle;




Route::get('/', function () {
     return view('home'); 
})->name('home');


Route::get('/login', [AuthManager::class, 'login'])->name('login'); 
Route::post('/login', [AuthManager::class, 'loginpost'])->middleware(Admin::class) ->name('loginpost');
Route::get('/registration',[AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationpost'])->name('registrationpost');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
Route::get('/', [HomeController::class, 'ind'])->name('home');
Route::delete('/branches/{id}', [BranchController::class, 'destroy'])->name('branch.delete');
Route::post('/branches', [BranchController::class, 'store'])->name('branch.create');
Route::get('/manage', [BranchController::class, 'redir'])->name('manage');
Route::post('/check-availability', [BookingController::class, 'checkAvailability'])->name('check.availability');
Route::post('/packages', [BranchController::class, 'store_package'])->name('packages.create');
Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
//Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');
Route::post('/sell-product/{id}', [BranchController::class, 'sellProduct'])->name('sellProduct');
//Route::get('/search-product', [SearchBar::class,'search'])->name('searchProduct');
Route::post('/calculate-revenue', [RevenueController::class, 'calculate'])->name('calculateRevenue');
// routes/web.php
Route::get('/recvr', [Recover::class, 'showRecoveryPage'])->name('recvr');
Route::post('/reset', [Recover::class, 'sendResetLink'])->name('sendResetLink');
Route::post('/reset-password', [Recover::class, 'resetPassword'])->name('password.reset');


Route::get('/cart', [CartControlle::class, 'showCart'])->name('cart.show');
Route::post('/cart/add/{id}', [CartControlle::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{id}', [CartControlle::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartControlle::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart/checkout', [CartControlle::class, 'checkout'])->name('cart.checkout');






















