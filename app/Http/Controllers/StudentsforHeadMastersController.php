<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\FinalYears;
use App\Models\School;
use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Facades\DB;


use App\Models\School_Teachers;



class StudentsforHeadMastersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user(); 
        $user_id = $user->id;
        $school = School_Teachers::where('user_id', $user_id)->first();
        $school_id = $school->school_id;
        //$school =  App\Models\School::where('id', $school_id)->first();
    
        $students = Student::where('school_id', $school_id)->get();
        $finalYears = FinalYears::all();
        $schools = School::all();
        $streams = Stream::all();
        $grades = Grade::all();

        $teachers = User::whereHas(
            'roles' , fn($query) =>
            $query->where('name', 'isTeacher'))->
            whereHas(
                'schools' , fn($query) =>
                $query->where('id', $school_id))->get();
        // $wards = Ward::all();
        // $districts =  District::all();
        // $regions =  Region::all();
        return view('dashboard.student.headMaster', compact(['students', 'streams','grades','schools', 'finalYears', 'teachers']));
    }

    public function AddteacherinSchool(Request $request){
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
                return back()->with('message','A new teacher registered in this school');
            }
        }
    }
    public function teachersinschool()
    {

        $user = Auth::user(); 
        $user_id = $user->id;
        $schools = School::all();
        $roles = Role::all();
        $school = School_Teachers::where('user_id', $user_id)->first();
        $school_id = $school->school_id;
       $teachers = User::whereHas(
            'roles' , fn($query) =>
            $query->where('name', 'isTeacher'))->
            whereHas(
                'schools' , fn($query) =>
                $query->where('id', $school_id))->get();
        return view('dashboard.student.headMasterTeacher', compact(['teachers', 'schools', 'roles']));
    }

    public function teachersondutyinschool()
    {

        $user = Auth::user(); 
        $schools = School::all();
        $roles = Role::all();
        $user_id = $user->id;
        $school = School_Teachers::where('user_id', $user_id)->first();
        $school_id = $school->school_id;
       $teachers = User::whereHas(
            'roles' , fn($query) =>
            $query->where('name', 'isTeacherOnDuty'))->
            whereHas(
                'schools' , fn($query) =>
                $query->where('id', $school_id))->get();
        return view('dashboard.student.teacherOnDuty', compact(['teachers', 'schools', 'roles']));
    }

    public function studentsinschool(){
        $user = Auth::user(); 
        $user_id = $user->id;
        $school = School_Teachers::where('user_id', $user_id)->first();
        $school_id = $school->school_id;
        //$school =  App\Models\School::where('id', $school_id)->first();
    
        $students = Student::where('school_id', $school_id)->get();

        return view('dashboard.student.teacherpage', compact(['students']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student = new Student;
        $student->student_name = $request['student_name'];
        $student->gender = $request['gender'];
        $student->stream_id = $request['stream_id'];
        $student->school_id = $request['school_id'];
        $student->final_year_id = $request['final_year_id'];
        $student->save();  

        return response(['message' => 'A student successfully registered!', 
               'data'=> $student]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $student = new Student;
        $student->student_name = $request['student_name'];
        $student->gender = $request['gender'];
        $student->stream_id = $request['stream_id'];
        $student->school_id = $request['school_id'];
        $student->final_year_id = $request['final_year_id'];
        $student->save();  

        return back()->with('msg' ,'A student successfully registered!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function editTod(Request $request, $id)
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
