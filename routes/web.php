<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DistrictOfficersController;
use App\Http\Controllers\WardOfficersController;
use App\Http\Controllers\HeadTeacherController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WardController;

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
Route::resource('/region', RegionController::class);
Route::resource('/roles', RoleController::class);
//Route::post('/addRegion', [RegionController::class, 'store'])->name('store');
Route::post('/addBulkRegions', [RegionController::class, 'addExcel'])->name('addExcel');
Route::resource('/districts', DistrictController::class);
Route::resource('/wards', WardController::class);
Route::resource('/schools', SchoolingController::class);
Route::get('/students', [StudentController::class, 'view'])->name('view');
Route::get('/attendanceReports', [AttendanceController::class, 'view'])->name('view');
Route::resource('/districtOfficer', DistrictOfficersController::class);
Route::get('/wardOfficer', [WardOfficersController::class, 'view'])->name('view');
Route::get('/headTeacher', [HeadTeacherController::class, 'view'])->name('view');
Route::get('/teacher', [TeacherController::class, 'view'])->name('view');
Route::get('/logout', [AuthController::class, 'webLogout'])->name('webLogout');
Route::get('/privacy_policy', function () {
    return view('/privacy_policy');
});

