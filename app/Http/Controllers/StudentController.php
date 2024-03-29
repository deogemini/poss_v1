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
use Illuminate\Support\Facades\Cache;


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
       // Check if the data is cached
    if (Cache::has('dashboard_data')) {
        $data = Cache::get('dashboard_data');
    } else {
        // Data not found in cache, fetch it from the database and cache it.
        $students = Student::all();
        $finalYears = FinalYears::all();
        $schools = School::all();
        $streams = Stream::all();
        $grades = Grade::all();

        $data = compact(['students', 'streams', 'schools', 'grades', 'finalYears']);

        Cache::put('dashboard_data', $data, now()->addMinutes(10));
    }

    return view('dashboard.student.index', $data);
    }

    public function importView(Request $request){
        return view('importFile');
    }
    public function import(Request $request, $school_id){
        Excel::import(new ImportStudent($school_id),
                      $request->file('file'));
        return redirect()->back();
    }

    public function exportStudents($school_id){
        return Excel::download(new ExportStudent($school_id), 'Registered Students.xlsx');
    }

    public function downloadTemplate(){
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];
        $file_name = 'StudentsTemplate.xlsx';
        $path = public_path('files/Students-Template.xlsx');
        return response()->download($path, $file_name, $headers);
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
     public function getStudentsinGrade($grade, $stream,  $school_id){
        $stream= Stream::where('name', $stream)->first();
        $stream_id = $stream->id;
       $students =  Student::where('school_id', $school_id)
                            ->where('stream_id', $stream_id)
                            ->get();

       $this -> grade = $grade;
       $gradeStudent= $students->filter(function($value,$key){
            return $value->grade == $this->grade;
       });

       if(count($gradeStudent) > 0){
        $gradeStudent = collect(array_values($gradeStudent->toArray()));

        //calculate total male, total female, and total students
       $totalMale = $gradeStudent->where('gender', 'male')->count();
       $totalFemale = $gradeStudent->where('gender', 'female')->count();

       // Make the gender comparison case-insensitive
       $totalMale += $gradeStudent->where('gender', 'Male')->count();
       $totalFemale += $gradeStudent->where('gender', 'Female')->count();

        $totalStudents = count($gradeStudent);

        return  response()->json([
            'message' => 'students in grade',
            'students' => $gradeStudent,
            'totalMale' => $totalMale,
            'totalFemale' => $totalFemale,
            'totalStudents' => $totalStudents,
    ]);
       }
       else{
        return  response('No Registered Student');
       }


    }
    //   return  response()->json([
    //     'data' => [
    //         'students in grade' => $gradeStudent]]);
    //  }

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
        $student = Student::find($id);
        $student->student_name = $request['student_name'];
        $student->gender = $request['gender'];
        $student->stream_id = $request['stream_id'];
        $student->school_id = $request['school_id'];
        $student->final_year_id = $request['final_year_id'];
        $student->save();

        return back()->with('msg','Student was Updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return back()->with('msg', 'One Student deleted successfully ');
    }



}
