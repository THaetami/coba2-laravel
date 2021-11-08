<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PuisiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
use Clockwork\Storage\Search;

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



Route::get('/', [PuisiController::class, 'index']);
// Route::get('/', [SearchController::class]);

// link ada di file navbar.blade.php
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

//memproses form di folder login dgn nama file index.blade.php
Route::post('/login', [LoginController::class, 'authenticate']);

// link ada di file navbar.blade.php dan folder dashboard.layouts -> file header.blade.php
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);
