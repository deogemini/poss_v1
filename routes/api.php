<?php
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\DistrictOfficersController;
use App\Http\Controllers\WardOfficersController;
use App\Http\Controllers\HeadTeacherController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegionController;  
use App\Http\Controllers\DistrictController; 
use App\Http\Controllers\WardController; 

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// ----------api for attendance-------------------------
Route::get('/attendances', [AttendanceController::class, 'index']);
Route::post('/attendances', [AttendanceController::class, 'store']);
Route::post('/addAttendances', [AttendanceController::class, 'create']);
Route::get('/attendances/{id}', [AttendanceController::class, 'show']);
Route::put('/attendances/{id}', [AttendanceController::class, 'update']);
Route::delete('/attendances/{id}', [AttendanceController::class, 'destroy']);
//searching by remarks
Route::get('/attendances/search/{name}', [AttendanceController::class, 'search']);



// --------api for stream-------------------------------
Route::get('/streams', [StreamController::class, 'index']);
Route::post('/addStream', [StreamController::class, 'store']);
Route::get('/streams/{id}', [StreamController::class, 'show']);
Route::put('/streams/{id}', [StreamController::class, 'update']);
Route::delete('/streams/{id}', [StreamController::class, 'destroy']);
//searching by remarks
Route::get('/streams/search/{name}', [StreamController::class, 'search']);




//------------api for grades--------------------------------------------
Route::get('/grades', [GradeController::class, 'index']);
Route::post('/addGrade', [GradeController::class, 'store']);
Route::get('/grades/{id}', [GradeController::class, 'show']);
Route::put('/grades/{id}', [GradeController::class, 'update']);
Route::delete('/grades/{id}', [GradeController::class, 'destroy']);
//searching by remarks
Route::get('/grades/search/{name}', [GradeController::class, 'search']);




//--------------api for schools----------------------
Route::get('/getschools', [SchoolController::class, 'index']);
Route::post('/addSchools', [SchoolController::class, 'create']);
Route::get('/schools/{id}', [SchoolController::class, 'show']);
Route::put('/schools/{id}', [SchoolController::class, 'update']);
Route::delete('/schools/{id}', [SchoolController::class, 'destroy']);
//searching by school name
Route::get('/schools/search/{name}', [SchoolController::class, 'search']);





//-----------------api for roles-----------------------------------
Route::get('/roles', [RoleController::class, 'index']);
Route::post('/addRole', [RoleController::class, 'store']);
Route::get('/roles/{id}', [RoleController::class, 'show']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
//searching by role name
Route::get('/roles/search/{name}', [RoleController::class, 'search']);



//---------------------api for students--------------------------------
Route::get('/students', [StudentController::class, 'index']);
Route::post('/addStudents', [StudentController::class, 'create']);
Route::get('/students/{id}', [StudentController::class, 'show']);
Route::put('/students/{id}', [StudentController::class, 'update']);
Route::delete('/students/{id}', [StudentController::class, 'destroy']);
//searching by  firstname
Route::get('/students/search/{name}', [StudentController::class, 'search']);




//-------------------api for users-------------------------
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::post('/users/registration', [AuthController::class, 'register']);
Route::post('/users/login', [AuthController::class, 'login']);
Route::post('/users/logout', [AuthController::class, 'logout']);
//searching by  firstname
Route::get('/users/search/{name}', [UserController::class, 'search']);




//----------------starting of apis for management of distictOfficers----------------------------
Route::get('/districtOfficers', [DistrictOfficersController::class, 'index']);
Route::post('/addDistrictOfficer', [DistrictOfficersController::class, 'create']);
Route::get('/getSpecificDistrictOfficer/{districtOfficer_id}',  [DistrictOfficersController::class, 'show']);




//----------------starting of apis for management of wardOfficers--------------------------
Route::get('/getHeadTeachers/{id}', [WardOfficersController::class, 'getHeadTeachersinWard']);
Route::get('/getWardOfficers', [WardOfficersController::class, 'index']);
Route::post('/addWardOfficer', [WardOfficersController::class, 'create']);
Route::get('/getSpecificWardOfficer/{ward_id}', [WardOfficersController::class, 'show']);




//-------------starting of apis for management of HeadTeachers------------------------------
Route::get('/getHeadTeachers', [HeadTeacherController::class, 'index']);
Route::get('/getSpecificHeadTeacher/{headTeacher_id}', [HeadTeacherController::class, 'show']);
Route::get('/getTeachers/{school_id}', [HeadTeacherController::class, 'getTeachersinSchool']);
Route::get('/setTeacheronDuty/{teacher_id}', [HeadTeacherController::class, 'isTeacherOnDuty']);
Route::get('/unsetTeacheronDuty/{teacher_id}', [HeadTeacherController::class, 'isNotTeacherOnDuty']);
Route::post('/addHeadTeacher', [HeadTeacherController::class, 'create']); 




//-------------------management of regions used by  the system----------------------------------------
Route::get('/regions', [RegionController::class, 'index']); 
Route::post('/addRegion', [RegionController::class, 'store']); 
//Route::get('/regions', [RegionController::class, 'index']); 




//-------------------management of districts used by  the system----------------------------------------
Route::get('/getdistricts', [DistrictController::class, 'index']); 
Route::post('/addDistrict', [DistrictController::class, 'store']); 
Route::get('/getdistrict/{{id}}', [DistrictController::class, 'index']); 



//-------------------management of wards used by  the system----------------------------------------
Route::get('/getwards', [WardController::class, 'index']); 
Route::post('/addWard', [WardController::class, 'store']); 
Route::get('/getward/{{id}}', [WardController::class, 'index']); 




//-------starting of apis for management of teachers------------------
Route::get('/teachers', [TeacherController::class, 'index']);
Route::post('/addTeacher', [TeacherController::class, 'create']); 
Route::get('/getSpecificTeacher/{teacher_id}', [TeacherController::class, 'show']); 




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
