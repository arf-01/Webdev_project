<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager; 
Route::get('/', function () {
     return view('welcome'); 
})->name('home');

Route::get('/login', [AuthManager::class, 'login'])->name('login'); 
Route::post('/login', [AuthManager::class, 'loginpost'])->name('loginpost'); 
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationpost'])->name('registrationpost');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');


