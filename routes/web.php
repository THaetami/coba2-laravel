<?php


use App\Models\Puisi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PuisiController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CropImageController;

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


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');


Route::post('/login', [LoginController::class, 'authenticate']);


Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);


Route::post('/posting', [PuisiController::class, 'store']);

Route::post('/', [PuisiController::class, 'storeComment']);

Route::post('/delete/{puisi:id}', [PuisiController::class, 'destroy']);


// Route::get('/myprofile', function () {
//     return view('myprofile.index', [
//         'title' => 'myprofile'
//     ]);
// })->middleware('auth');

Route::get('/myprofile', [CropImageController::class, 'index']);

Route::post('/myprofile', [CropImageController::class, 'uploadCropImage']);







