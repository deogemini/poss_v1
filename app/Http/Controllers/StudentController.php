<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Grade;
use App\Models\Stream;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        foreach($students as $student){
            echo $student;

        }
        
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

        $array_students = [];
     $streams = Stream::where('grade_id', $id)->get();
     foreach($streams as $stream){
         $stream_id = $stream->id;
         $students = Student::where('stream_id', $stream_id)->get();
         foreach($students as $student){
            $array_students[] = $student; 

         }
     }

     return response(['message' => 'students in grade', 
     'students'=> $array_students, 'total students' => count($array_students)]);



        
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
