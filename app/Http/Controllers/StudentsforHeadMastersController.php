<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Stream;
use App\Models\FinalYears;
use App\Models\School;
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
        // $wards = Ward::all();
        // $districts =  District::all();
        // $regions =  Region::all();
        return view('dashboard.student.headMaster', compact(['students', 'streams','grades','schools', 'finalYears']));
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
