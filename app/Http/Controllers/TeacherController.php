<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\School_Teachers;
use App\Models\Stream;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function getGrades($school_id){
//         $grade = Grade::query()->select([
//             'streams'=> Stream::all()->where('grade_id',Grade::select('id')->where('school_id', $school_id))
//         ]);
// return $grade;


        // $schools =    School::query()->addSelect([
        //     /** Total no of students in school */
        //     'count_students' => Student::selectRaw('count(*)')
        //         ->whereIn(
        //           'stream_id', 
        //           Stream::select('id')->whereIn(
        //             'grade_id',
        //             Grade::select('id')->whereColumn('school_id', 'schools.id')
        //           )
        //         ),

        $grades = Grade::where('school_id', $school_id)->get();
        foreach ($grades as $grade){
            $grade_id = $grade->id;

        $streams  = Stream::where('grade_id', $grade_id)->with('school')->get();
        return response()->json(['grade'=>$grades, 'streams' =>$streams]);

        }

        $grades = Grade::where('school_id', $school_id)->get();
        foreach ($grades as $grade){
            $grade_id = $grade->id;
            $streams  = Stream::where('grade_id', $grade_id)->get();
            return response()->json(['grade'=>$grades, 'streams' =>$streams]);

        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $teacher = User::find($id);

       return response()->json($teacher);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // return response()->json(['grade'=>$grades, 'streams =>$streams]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
