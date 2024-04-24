<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager; 
use App\Http\Middleware\Admin;
Route::get('/', function () {
     return view('home'); 
})->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login'); 
Route::post('/login', [AuthManager::class, 'loginpost'])->middleware(Admin::class) ->name('loginpost');
Route::get('/registration',[AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationpost'])->name('registrationpost');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
 //Route::post('/login', [AuthManager::class, 'manage'])->name('manage');



