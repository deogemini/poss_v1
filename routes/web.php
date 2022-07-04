<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;

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

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/login', [AuthController::class, 'webLogin'])->name('webLogin');
Route::get('/dashboard', [HomeController::class, 'index'])->name('index');
Route::get('/regions', [RegionController::class, 'view'])->name('view');
Route::get('/logout', [AuthController::class, 'webLogout'])->name('webLogout');
Route::get('/privacy_policy', function () {
    return view('/privacy_policy');
});

