<?php

namespace App\Http\Controllers;

use App\Models\FinalYears;
use App\Models\School;
use App\Models\Grade;
use App\Models\Stream;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportStudent;
use App\Exports\ExportStudent;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $grade;
    public function index()
    {
        $students = Student::all();
        $finalYears = FinalYears::all();
        $schools = School::all();
        $streams = Stream::all();
        $grades = Grade::all();
        // $wards = Ward::all();
        // $districts =  District::all();
        // $regions =  Region::all();

        return view('dashboard.student.index', compact(['students', 'streams','grades','schools', 'finalYears']));
        
    }

    public function importView(Request $request){
        return view('importFile');
    }
  
    public function import(Request $request){
        Excel::import(new ImportStudent, 
                      $request->file('file'));
        return redirect()->back();
    }
  
    public function exportStudents(Request $request){
        return Excel::download(new ExportStudent, 'students.xlsx');
    }


    public function gradesinschool(){
        $grades = Grade::whereHas('school', function($query){
            $query->whereId(request()->input('school_id', 0));
        })->pluck('name', 'id');

        return response()->json($grades);
    }
    public function streamsingrade(){
        $streams = Stream::whereHas('grade', function($query){
            $query->whereId(request()->input('grade_id', 0));
        })->pluck('name', 'id');

        return response()->json($streams);
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

        $array_students = [];
        $students = Student::where('school_id', $id)->get();
         foreach($students as $student){
            $array_students[] = $student;
             }

     return response(['message' => 'students in school', 
     'students'=> $array_students, 'total students' => count($array_students)]);
    }

    public function view()
    {
        $students = Student::all();
        $schools = School::all();
        $streams = Stream::all();
        $grades = Grade::all();
        // $wards = Ward::all();
        // $districts =  District::all();
        // $regions =  Region::all();

        return view('dashboard.student.index', compact(['students', 'streams','grades','schools']));
        
    }

    
    //function to get student by using grade in string and the school id
     public function getStudentsinGrade($grade, $school_id){
       $students =  Student::where('school_id', $school_id)->get();

       $this -> grade = $grade;
       $gradeStudent= $students->filter(function($value,$key){
            return $value->grade == $this->grade;
       });

      return  response(['message' => 'students in class',
                'students' => $gradeStudent,
                'total students' => count($gradeStudent)]); 
     }

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
