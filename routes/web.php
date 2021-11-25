<?php



use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PuisiController;
use App\Http\Controllers\DrakorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

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

Route::post('/posting', [PuisiController::class, 'store'])->middleware('auth');

Route::post('/delete/{puisi:romlah}', [PuisiController::class, 'destroy'])->middleware('auth');

Route::post('/', [PuisiController::class, 'storeComment'])->middleware('auth');






Route::get('/drakor', [DrakorController::class, 'index']);

Route::post('/drakor/posting', [DrakorController::class, 'store']);

Route::post('/drakor/delete/{drakor:romlah}', [DrakorController::class, 'destroy']);

Route::post('/drakor', [DrakorController::class, 'storeComment']);





Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');


Route::post('/login', [LoginController::class, 'authenticate']);


Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);





Route::get('/myprofile', [ProfileController::class, 'index'])->middleware('auth');

Route::post('/myprofile/crop', [ProfileController::class, 'crop'])->name('crop');


Route::post('/myprofile/update', [ProfileController::class, 'update'])->name('update');

// Route::resource('/myprofile', MyProfileController::class)->middleware('auth')->except(['show', 'store', 'create', 'destroy']);

// Route::post('/myprofile/crop', [MyProfileController::class, 'crop'])->name('crop');







// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
