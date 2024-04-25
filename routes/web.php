<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager; 
use App\Http\Middleware\Admin;
use App\Http\Controllers\UserController;
Route::get('/', function () {
     return view('home'); 
})->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login'); 
Route::post('/login', [AuthManager::class, 'loginpost'])->middleware(Admin::class) ->name('loginpost');
Route::get('/registration',[AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationpost'])->name('registrationpost');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
Route::get('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{id}/delete', [UserController::class, 'delete'])->name('user.delete');





 //Route::post('/login', [AuthManager::class, 'manage'])->name('manage');



