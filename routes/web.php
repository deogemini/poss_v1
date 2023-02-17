<?php

use App\Http\Controllers\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DistrictOfficersController;
use App\Http\Controllers\FinishingYearController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\WardOfficersController;
use App\Http\Controllers\HeadTeacherController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchoolingController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsforHeadMastersController;
use App\Http\Controllers\TeacherOnDutyController;
use App\Http\Controllers\UserProfileController;
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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/login', [AuthController::class, 'webLogin'])->name('webLogin');
Route::get('/dashboard', [HomeController::class, 'index'])->name('index');
Route::resource('/region', RegionController::class);
Route::resource('/roles', RoleController::class);
//Route::post('/addRegion', [RegionController::class, 'store'])->name('store');
Route::post('/addBulkRegions', [RegionController::class, 'addExcel'])->name('addExcel');
Route::resource('/districts', DistrictController::class);
Route::resource('/finishingYears', FinishingYearController::class);
Route::post('/addBulkStudent/{school_id}', [StudentController::class, 'import'])->name('import');
Route::get('/export/students/{school_id}', [StudentController::class, 'exportStudents'])->name('exportStudents');
Route::resource('/wards', WardController::class);
Route::resource('/grades', GradeController::class);
Route::get('/grade', [StudentController::class, 'gradesinschool'])->name('grade.gradesinschool');
Route::get('/stream', [StudentController::class, 'streamsingrade'])->name('stream.streamsingrade');
Route::resource('/schools', SchoolingController::class);
Route::resource('/schoolsgrade', SchoolController::class);
Route::resource('/streams', StreamController::class);
Route::resource('/students', StudentController::class);
Route::resource('/studentsinschool', StudentsforHeadMastersController::class);
Route::get('/attendanceReports', [AttendanceController::class, 'view'])->name('view');
Route::resource('/districtOfficer', DistrictOfficersController::class);
Route::resource('/wardOfficer', WardOfficersController::class);
Route::resource('/headTeacher', HeadTeacherController::class);
Route::resource('/userProfile', UserProfileController::class);
Route::get('/teachersinschool', [StudentsforHeadMastersController::class, 'teachersinschool'])->name('teachersinschool');
Route::post('/teachersinschool',[StudentsforHeadMastersController::class, 'AddteacherinSchool'])->name('AddteacherinSchool');
Route::get('/teachersondutyinschool', [StudentsforHeadMastersController::class, 'teachersondutyinschool'])->name('teachersondutyinschool');
Route::get('/studentsinyourschool', [StudentsforHeadMastersController::class, 'studentsinschool'])->name('studentsinschool');
Route::resource('/teacherOnDuty', TeacherOnDutyController::class);


Route::resource('/teacher', TeacherController::class);
Route::post('/teacheronduty', [TeacherController::class, 'onduty'])->name('onduty');
Route::get('/logout', [AuthController::class, 'webLogout'])->name('webLogout');
Route::get('/privacy_policy', function () {
    return view('/privacy_policy');
});
