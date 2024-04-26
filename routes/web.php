<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager; 
use App\Http\Middleware\Admin;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BranchController;

Route::get('/', function () {
     return view('home'); 
})->name('home');


Route::get('/login', [AuthManager::class, 'login'])->name('login'); 
Route::post('/login', [AuthManager::class, 'loginpost'])->middleware(Admin::class) ->name('loginpost');
Route::get('/registration',[AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationpost'])->name('registrationpost');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
//Route::get('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');
Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
Route::put('/payments/{payment}', [AdminPaymentController::class, 'update'])->name('payments.update');
Route::get('/', [HomeController::class, 'ind'])->name('home');
Route::delete('/branches/{id}', [BranchController::class, 'destroy'])->name('branch.delete');
Route::post('/branches', [BranchController::class, 'store'])->name('branch.create');
Route::get('/manage', [BranchController::class, 'redir'])->name('manage');


















