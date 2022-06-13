<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', function () {return view('admin');});
Route::get('/regions',  [RegionController::class, 'indexPage']);
Route::get('/dashboard', function () {return view('components.dashboard');});
Route::get('/districtOfficers', function () {return view('admin');});
Route::get('/headTeachers', function () {return view('admin');});
Route::get('/wardOfficers', function () {return view('admin');});
Route::get('/students', function () {return view('admin');});
Route::get('/teachers', function () {return view('admin');});
