<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Ward;
use App\Models\Role;
use App\Models\District;
use App\Models\Region;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School_Teachers;
use App\Models\Stream;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
 //get all users with the role being isTeacher
    public function index()
    {
        $Teachers = User::with('schools')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isTeacher')
        )
        ->get();
        $roles = Role::all();
        $schools = School::all();
        $wards = Ward::all();
        $districts =  District::all();
        $regions =  Region::all();

        return view('dashboard.teachers.index', compact(['Teachers','roles', 'schools',  'wards','districts', 'regions']));

    }

//get Grades in a given school
    public function getGrades($school_id){
        $grades = Grade::query()
        ->where('school_id',$school_id)
        ->addSelect([
            'total_students' => Student::selectRaw('count(*)')
                ->whereIn(
                    'stream_id',
                    Stream::select('id')->whereColumn('grade_id', 'grades.id')
                ),
            'total_boys' => Student::selectRaw('count(*)')
                ->whereRaw('gender = "male"')
                ->whereIn(
                    'stream_id',
                    Stream::select('id')->whereColumn('grade_id', 'grades.id')
                ),
            'total_girls' => Student::selectRaw('count(*)')
                ->whereRaw('gender = "female"')
                ->whereIn(
                    'stream_id',
                    Stream::select('id')->whereColumn('grade_id', 'grades.id')
                )
        ])->get();

        return response()->json([
            'message' => 'grades in school',
            'grades' => $grades,
            'total_students_in_school' => $grades->sum('total_students'),
            'total_boys_in_school' => $grades->sum('total_boys'),
            'total_girls_in_school' => $grades->sum('total_girls'),
            'total_grades' => $grades->count()
        ]);

    }

    public function view(){
        $Teachers = User::with('schools')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isTeacher')
        )
        ->get();
        // return $headTeachers;
        $schools = School::all();
        $wards = Ward::all();
        $districts =  District::all();
        $regions =  Region::all();

        return view('dashboard.teachers.index', compact(['Teachers','schools',  'wards','districts', 'regions']));
    }


    //add new teacher in the system
    // public function create(Request $request)
    // {
    //     $user = new User;
    //     $user->firstname = $request['firstname'];
    //     $user->lastname = $request['lastname'];
    //     $user->phonenumber = $request['phonenumber'];
    //     $user->email = $request['email'];
    //     $user->password = bcrypt($user->lastname);
    //     $user->save();


    //     $user_id = $user->id;
    //     $school_id = $request['school_id'];
    //     $user_check = User::where('id', $user_id)->first();
    //     $teacher = $user_check->id;

    //     $teacherinschool = School_Teachers::insert([
    //         'user_id' => $teacher,
    //         'school_id' => $school_id
    //     ]);

    //     if($user->save()){
    //         $user_id = $user->id;
    //         $role = User::find($user_id);
    //     // role 2 is for isTeacher, thus we attach this role to this user object
    //     // ...this will create a record in user_role table
    //         $role->roles()->attach(2);
    //         return response(['message' => 'A new teacher registered!',
    //         'data'=> $user]);
    //     }
    // }


    public function store(Request $request)
    {
        $user = new User;
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->phonenumber = $request['phonenumber'];
        $user->email = $request['email'];
        $user->password = bcrypt($user->lastname);
        $user->save();


        $user_id = $user->id;
        $school_id = $request['school_id'];
        $user_check = User::where('id', $user_id)->first();
        $teacher = $user_check->id;

        $teacherinschool = School_Teachers::insert([
            'user_id' => $teacher,
            'school_id' => $school_id
        ]);

        if($user->save()){
            $user_id = $user->id;
            $role = User::find($user_id);
        // role 2 is for isTeacher, thus we attach this role to this user object
        // ...this will create a record in user_role table
            $role->roles()->attach(2);
            return back()->with('msg','A teacher registered!');
        }
    }


    public function onduty(Request $request)
    {
        $user = new User;
        $user->firstname = $request['firstname'];
        $user->lastname = $request['lastname'];
        $user->phonenumber = $request['phonenumber'];
        $user->email = $request['email'];
        $user->password = bcrypt($user->lastname);
        $user->save();


        $user_id = $user->id;
        $school_id = $request['school_id'];
        $user_check = User::where('id', $user_id)->first();
        $teacher = $user_check->id;

        $teacherinschool = School_Teachers::insert([
            'user_id' => $teacher,
            'school_id' => $school_id
        ]);

        if($user->save()){
            $user_id = $user->id;
            $role = User::find($user_id);
        // role 2 is for isTeacher, thus we attach this role to this user object
        // ...this will create a record in user_role table
            $role->roles()->attach(3);
            return back()->with('msg','A new teacher  On Duty registered!');
        }
    }

    public function show($id)
    {
       $teacher = User::find($id);

       return response()->json($teacher);
    }

    public function edit($id)
    {
       // return response()->json(['grade'=>$grades, 'streams =>$streams]);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;

        $user->save();

        $user_id = $user->id;
        //$school_id = $request['school_id'];
        // $user_check = User::where('id', $user_id)->first();
        // $teacher = $user_check->id;

        // $teachers = School_Teachers::where('school_id', $school_id)->update([
        //     'user_id' => $user_id
        //     ]);


        DB::table('role_user')->where(['user_id' => $user_id])->update([
            'role_id' => $request->role_id
        ]);

            return back()->with('msg','Teacher was Updated successfully');


    }
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();
        $role_user = DB::table('role_user')->where('user_id', $user->id)->delete();
        //$school_teacher =  DB::table("teachers/headteachers_schools")->where('user_id', $user->id)->delete();
        return back()->with('msg', 'Teacher was deleted successsfully');
    }
}
