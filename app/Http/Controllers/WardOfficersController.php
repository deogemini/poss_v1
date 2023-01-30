<?php

namespace App\Http\Controllers;

use App\Models\Officers_Wards;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ward;
use App\Models\District;
use App\Models\Region;
use App\Models\School;
use App\Models\Grade;
use App\Models\Role;
use App\Models\Student;
use App\Models\Stream;
use App\Models\TODremark;
use App\Models\AttendanceStudent;
use PDO;
use TeachersSchool;

class WardOfficersController extends Controller
{
//get all users with the role of isWardOfficer
    public function index()
    {
        $wardOfficers = User::with('wards')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isWardOfficer')
        )
        ->get();
        // return $wardOfficers;
        $wards = Ward::all();
        $roles = Role::all();
        $districts =  District::all();
        $regions =  Region::all();

        return view('dashboard.wardOfficers.index', compact(['wardOfficers','roles', 'wards','districts', 'regions']));
    }

    //add new user in the system with the role of isWardOfficer
    public function create(Request $request)
    {
        $user = new User;
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->phonenumber = $request['phonenumber'];
        $user->email = $request['email'];
        $user->password = bcrypt($user->lastname);
        $user->save();

        if($user->save()){
            $user_id = $user->id;
            $ward_id = $request['ward_id'];
            $user_check = User::where('id', $user_id)->first();
            $wardOfficer = $user_check->id;

            $ward_officers = Officers_Wards::insert([
                'user_id' => $wardOfficer,
                'ward_id' => $ward_id
            ]);

            $user_id = $user->id;
            $role = User::find($user_id);
        // role 6 is for isDistrictOfficer, thus we attach this role to this user object
        // ...this will create a record in user_role table
            $role->roles()->attach($request['role_id']);
            return response(['message' => 'A new ward Officer registered!',
                'data'=> $user]);

        }
    }

    //count and create summary for boys present,absent  & girls present,absent in schools of given ward id and a given date
    public function getAttendanceReportinWard($ward_id, $date)
    {
        $schools = School::query()->where('ward_id',$ward_id)->get();
        $result = ['message ' => 'Attendance Report in Ward'];
        $result['schools'] = [];
        foreach ($schools as $school) {
            $school_id = $school->id;
            $school_name = $school->name;
            $school_level = $school->educationLevel;

            $resultii = [];
            $resultii['school_id'] = $school_id;
            $resultii['school_name'] = $school_name;
            $resultii['school_level'] = $school_level;
            $resultii['total_students'] = Student::where('school_id', $school_id)
                ->count();

            $resultii["total_boys"] = Student::where('school_id', $school_id)
                ->where('gender','male')
                ->count();

            $resultii["total_girls"] = Student::where('school_id', $school_id)
                ->where('gender','female')
                ->count();

            $resultii["present_boys"] = AttendanceStudent::where('dateofattendance', $date)
                ->where('attendance_id', "1")
                ->where('school_id', $school_id)
                ->whereHas('student', function ($query) {
                    return $query->where('gender', 'male');
                })
                ->count();
            $resultii["absent_boys"] = AttendanceStudent::where('dateofattendance', $date)
                ->where('attendance_id', "2")
                ->where('school_id', $school_id)
                ->whereHas('student', function ($query) {
                    return $query->where('gender', 'male');
                })
                ->count();
            $resultii["present_girls"] = AttendanceStudent::where('dateofattendance', $date)
                ->where('attendance_id', "1")
                ->where('school_id', $school_id)
                ->whereHas('student', function ($query) {
                    return $query->where('gender', 'female');
                })
                ->count();
            $resultii["absent_girls"] = AttendanceStudent::where('dateofattendance', $date)
                ->where('attendance_id', "2")
                ->where('school_id', $school_id)
                ->whereHas('student', function ($query) {
                    return $query->where('gender', 'female');
                })
                ->count();
            $result['schools'][] = $resultii;
        }
        return response()->json($result);
    }





    // get all schools in a given ward
    public function getPrimarySchools($id){
         $schools = School::query()
        ->where('ward_id',$id)
        ->where('educationLevel', 'Primary')
        ->addSelect([
            'total_students' => Student::selectRaw('count(*)')
                ->whereColumn('school_id', 'schools.id'),
            'total_boys' => Student::selectRaw('count(*)')
                ->whereRaw('gender = "male"')
                 ->whereColumn('school_id', 'schools.id'),
            'total_girls' => Student::selectRaw('count(*)')
                ->whereRaw('gender = "female"')
               ->whereColumn('school_id', 'schools.id')
        ])->get();

    return response()->json([
        'message' => 'schools in wards',
        'schools' => $schools,
        'total_students_in_ward' => $schools->sum('total_students'),
        'total_boys_in_ward' => $schools->sum('total_boys'),
        'total_girls_in_ward' => $schools->sum('total_girls'),
        'total_schools' => $schools->count()
    ]);
}
    // get all schools in a given ward
    public function getSchoolsReport($id){
         $primary = School::query()
        ->where('ward_id',$id)
        ->where('educationLevel','Primary')
        ->get();
         $secondary = School::query()
        ->where('ward_id',$id)
        ->where('educationLevel','Secondary')
        ->get();

    return response()->json([
        'message' => 'summary of schools in ward',
        'total_primary_schools' => $primary->count(),
        'total_secondary_schools' => $secondary->count()
    ]);
}
    public function getSecondarySchoolsinWard($id){
         $schools = School::query()
        ->where('ward_id',$id)
        ->where('educationLevel', 'Secondary')
        ->addSelect([
            'total_students' => Student::selectRaw('count(*)')
                ->whereColumn('school_id', 'schools.id'),
            'total_boys' => Student::selectRaw('count(*)')
                ->whereRaw('gender = "male"')
                 ->whereColumn('school_id', 'schools.id'),
            'total_girls' => Student::selectRaw('count(*)')
                ->whereRaw('gender = "female"')
               ->whereColumn('school_id', 'schools.id')
        ])->get();

    return response()->json([
        'message' => 'schools in wards',
        'schools' => $schools,
        'total_students_in_ward' => $schools->sum('total_students'),
        'total_boys_in_ward' => $schools->sum('total_boys'),
        'total_girls_in_ward' => $schools->sum('total_girls'),
        'total_schools' => $schools->count()
    ]);



    }

    public function getHeadTeachersinWard($id){
    $headTeachers = User::whereHas('roles', function ($query) {
        $query->where('name', 'isHeadTeacher');
    })->whereHas('schools', function ($query) use ($id) {
        $query->where('ward_id', $id);
    })
    ->with('schools')->get();

    return response()->json(['headTeachers' => $headTeachers]);
    }

    public function store(Request $request)
    {
        $user = new User;
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->phonenumber = $request['phonenumber'];
        $user->email = $request['email'];
        $user->password = bcrypt($user->lastname);
        $user->save();

        if($user->save()){

        $user_id = $user->id;
        $ward_id = $request['ward_id'];
        $user_check = User::where('id', $user_id)->first();
        $wardOfficer = $user_check->id;

        $ward_officers = Officers_Wards::insert([
            'user_id' => $wardOfficer,
            'ward_id' => $ward_id
        ]);

            $user_id = $user->id;
            $role = User::find($user_id);
        // role 5 is for isWardOfficer, thus we attach this role to this user object
        // ...this will create a record in user_role table
            $role->roles()->attach(5);
            return back()->with('msg','Ward Officer was created successsfully');

        }
    }

    public function show($id)
    {
        $wardOfficer = User::find($id);
        return response()->json($wardOfficer);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
