<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School_Teachers;
use App\Models\Stream;
use App\Models\Student;

class TeacherController extends Controller
{
 //get all users with the role being isTeacher
    public function index()
    {
        $teachers = User::with('schools')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isTeacher')
        )
        ->get();

    return response()->json(['teachers' => $teachers]);
            
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

    //add new teacher in the system
    public function create(Request $request)
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
            return response(['message' => 'A new teacher registered!', 
            'data'=> $user]);
        }
    }


    public function store(Request $request)
    {
        //
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
        //
    }   
    public function destroy($id)
    {
        //
    }
}
