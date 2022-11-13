<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\AttendanceTeacher;
use App\Models\School;
use App\Models\Stream;
use App\Models\Student;
use App\Models\TODremark;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Constraint\Count;

// use App\Http\Controllers\Str;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $grade;
    public function index()
    {
        $attendances =  Attendance::all();
        foreach($attendances as $attendance ){
            echo $attendance;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    //    $arr [] = $request["data"];
       if(count( $request["data"])>0){
        foreach( $request["data"] as $data){

// return $data;

        $status = strtolower($data['status']);

        $attendanceUser = $data['teacher_id'];

        $attendanceStudent= $data['student_id'];


        $att_checker = Attendance::where('status', $status)->first();
        $attendance = $att_checker->id;

        $actual_student =  Student::where('id', $attendanceStudent)->get();
        foreach($actual_student as $student){
         $grade = $student->grade;
         $stream_id =   $student->stream_id;
         $school_id = $student->school_id;
        //  $actual_stream = Stream::where('id', $stream_id)->get();
        //  foreach($actual_stream as $stream){
        //      $grade_id = $stream->grade_id;
        //  }
        }


        $date = $request['date'];
        $record_check_attendance_student = AttendanceStudent::where('updated_at', 'LIKE', '%'.$date.'%')->where('attendance_id', $attendance)->where('grade', $grade)->where('student_id', $attendanceStudent)->get();
        if(count($record_check_attendance_student) > 1){
            return response()->json(['message'=>"Attendance record of this class has been already saved"]);
        }else{
            $attendanceStudent = AttendanceStudent::insert([
                'attendance_id' => $attendance,
                'student_id' => $attendanceStudent,
                 'grade' => $grade,
                 'stream_id' => $stream_id,
                 'school_id' => $school_id,
                 'dateofattendance' =>  $date,
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
            ]);

        }

        $attendanceUser = AttendanceTeacher::insert([
            'user_id' => $attendanceUser,
            'attendance_id' => $attendance,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),

        ]);
        }
        // $remark = new Remark;
        // $remark->attendance_id =  $attendanceUser;
        // $remark->remark = "dhcsdjcs";
        // $remark->save();
       }
        return response(['message' => 'The attendance of this has been successfully saved',
               'data'=> $attendance]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'status' =>  'required'
            ]
            );

        return Attendance::create($request -> all());
    }

    public function view()
    {

       return view('dashboard.attendanceReports.index');

    }



    public function TODremark(Request $request){

        // $attendances_fetched = AttendanceStudent::where('dateofattendance', $date)->get();
        // foreach($attendances_fetched as $attendance_fetched ){
        //     $attendance_student_dateofattendance = $attendance_fetched->dateofattendance;
        // }
        $TODremark = TODremark::insert([
            'remark' => $request['remark'],
            'school_id' => $request['school_id'],
            'user_id' => $request['user_id'],
            'pendingbyHeadMaster' => 1,
            'dateofattendances' => $request['date']
        ]);

        return response(['message' => 'The remark of today has been sent',
               'data'=> $TODremark]);
    }





    public function getGradeAttendanceReport($grade, $stream,  $school_id, $date){
            // $this -> grade = $grade;
        // $gradeStudent= $students->filter(function($value,$key){
        //      return $value->grade == $this->grade;
        // });

        //total students are in a class

        $stream= Stream::where('name', $stream)->first();
        $stream_id = $stream->id;

        $attendance_fetched = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('grade', $grade)
                                    ->where('stream_id', $stream_id)
                                    ->where('school_id', $school_id)
                                    ->get();

        $total_students_in_grade = $attendance_fetched->count();


        //total present students fetched in a grade
        $attendance_fetched_present = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('grade', $grade)
                                    ->where('stream_id', $stream_id)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "1")->get();
         $total_present_student_in_grade = $attendance_fetched_present->count();

         //starting to get total boys and girls in a grade and counting them here

         //male
         $male_present = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('grade', $grade)
                                    ->where('stream_id', $stream_id)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "1")
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'male');
                                    })
                                    ->count();

        $female_present = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('grade', $grade)
                                    ->where('stream_id', $stream_id)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "1")
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'female');
                                    })
                                    ->count();

        //total absent students are counted    in  Grade
        $attendance_fetched_absent = AttendanceStudent::where('dateofattendance', $date)
                                        ->where('grade', $grade)
                                        ->where('stream_id', $stream_id)
                                        ->where('school_id', $school_id)
                                        ->where('attendance_id' , "2")->get();
        $total_absent_student = $attendance_fetched_absent->count();


        $male_absent = AttendanceStudent::where('dateofattendance', $date)
        ->where('grade', $grade)
        ->where('stream_id', $stream_id)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "2")
        ->whereHas('student' , function($query){
            return $query->where('gender', 'male');
        })
        ->count();

        $female_absent = AttendanceStudent::where('dateofattendance', $date)
                ->where('grade', $grade)
                ->where('stream_id', $stream_id)
                ->where('school_id', $school_id)
                ->where('attendance_id' , "2")
                ->whereHas('student' , function($query){
                    return $query->where('gender', 'female');
                })
                ->count();

                if($total_students_in_grade == 0){
                    return response()->json([
                        'message'=>'No Attendance called for the entered data',
                    ])->setStatusCode(400)
                    ;

                }else{
                    return response()->json([
                        'message'=>'Attendance Report in stream',
                        'grade'=> $grade,
                        'stream'=> $stream->name,
                        'Total Students in stream' => $total_students_in_grade,
                        'Present' => $total_present_student_in_grade,
                       'Total_boys_present' => $male_present,//count($Array_student_boys_present),
                        'Total_girls_present' => $female_present,//count($Array_student_girls_present),
                        'Absent' => $total_absent_student,
                        'Total_boys_absent' => $male_absent,
                        'Total_girls_absent' => $female_absent,
                        'Date' => $date,
                     ])->setStatusCode(200)
                     ;
                    }

}



//-----------------TOD REPORT----------------//
// public function  TODsreport($school_id, $date){
//     $school = School::where('id', $school_id)->first();
//     $school_education_level = $school->educationLevel;
//     $levels =[];
//     $grade = null;

//     if($school_education_level == 'Secondary'){
//         array_push($levels, 'Form One', 'Form Two', 'Form Three', 'Form Four');

//         foreach($levels as $level){

//             $total_students = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//             ->where('school_id', $school_id)
//             ->where('grade', $level )
//             ->count();

//             $total_boys_present_in_class = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//             ->where('school_id', $school_id)
//             ->where('attendance_id' , "1")
//             ->where('grade', $level )
//             ->whereHas('student' , function($query){
//                 return $query->where('gender', 'male');
//             })
//             ->count();

//             $total_girls_present_in_class = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//             ->where('school_id', $school_id)
//             ->where('attendance_id' , "1")
//             ->where('grade', $level )
//             ->whereHas('student' , function($query){
//                 return $query->where('gender', 'female');
//             })
//             ->count();

//             $total_boys_absent_in_class = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//             ->where('school_id', $school_id)
//             ->where('attendance_id' , "2")
//             ->where('grade', $level )
//             ->whereHas('student' , function($query){
//                 return $query->where('gender', 'male');
//             })
//             ->count();

//             $total_girls_absent_in_class = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//             ->where('school_id', $school_id)
//             ->where('attendance_id' , "2")
//             ->where('grade', $level )
//             ->whereHas('student' , function($query){
//                 return $query->where('gender', 'female');
//             })
//             ->count();

//         }
//         $grade = $level;




//     }else{
//        array_push($levels,'Standard One','Standard Two', 'Standard Three','Standard Four','Standard Five', 'Standard Six', 'Standard Seven');

//        foreach($levels as $level){
//         $grade = $level;

//         $total_students = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//         ->where('school_id', $school_id)
//         ->where('grade', $level )
//         ->count();
//         $total_boys_present_in_class = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//         ->where('school_id', $school_id)
//         ->where('attendance_id' , "1")
//         ->where('grade', $level )
//         ->whereHas('student' , function($query){
//             return $query->where('gender', 'male');
//         })
//         ->count();

//         $total_girls_present_in_class = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//         ->where('school_id', $school_id)
//         ->where('attendance_id' , "1")
//         ->where('grade', $level )
//         ->whereHas('student' , function($query){
//             return $query->where('gender', 'female');
//         })
//         ->count();

//         $total_boys_absent_in_class = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//         ->where('school_id', $school_id)
//         ->where('attendance_id' , "2")
//         ->where('grade', $level )
//         ->whereHas('student' , function($query){
//             return $query->where('gender', 'male');
//         })
//         ->count();

//         $total_girls_absent_in_class = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//         ->where('school_id', $school_id)
//         ->where('attendance_id' , "2")
//         ->where('grade', $level )
//         ->whereHas('student' , function($query){
//             return $query->where('gender', 'female');
//         })
//         ->count();
//     }

//     }



//    //-------total number of students called in attendance in that date-------//
//     $attendanceschool_fetched  = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//                                                     ->where('school_id', $school_id)
//                                                     ->get();
//     $total_students_in_school = $attendanceschool_fetched->count();
//     //-------total number of students called in attendance in that date-------//

//     //--------total present students fetched in that date-------------------------------//
//     $attendance_fetched_present = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//                                                     ->where('school_id', $school_id)
//                                                     ->where('attendance_id' , "1")->get();
//     $total_present_students = $attendance_fetched_present->count();
//     //--------total present students fetched in that date-------------------------------//


//     //---------total present boys-----------------------------------------------------//
//     $total_boys_present = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//                                             ->where('school_id', $school_id)
//                                             ->where('attendance_id' , "1")
//                                             ->whereHas('student' , function($query){
//                                                 return $query->where('gender', 'male');
//                                             })
//                                             ->count();

//     //---------total present girls-----------------------------------------------------//
//     $total_girls_present = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//                                                 ->where('school_id', $school_id)
//                                                 ->where('attendance_id' , "1")
//                                                 ->whereHas('student' , function($query){
//                                                     return $query->where('gender', 'female');
//                                                 })
//                                                 ->count();

//     //---------------total absent students in a school-------------------------------//
//     $attendance_fetched_absent = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//                                                     ->where('school_id', $school_id)
//                                                     ->where('attendance_id' , "2")
//                                                     ->get();
//     $total_absent_students = $attendance_fetched_absent->count();

//     //------------total absent boys in a school---------------------------------//
//     $total_boys_absent = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//                                             ->where('school_id', $school_id)
//                                             ->where('attendance_id' , "2")
//                                             ->whereHas('student' , function($query){
//                                             return $query->where('gender', 'male');
//                                             })
//                                             ->count();

//     //-----------------total absent girls in a school ---------------------------//
//     $total_girls_absent = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
//                                                 ->where('school_id', $school_id)
//                                                 ->where('attendance_id' , "2")
//                                                 ->whereHas('student' , function($query){
//                                                 return $query->where('gender', 'female');
//                                                 })
//                                                 ->count();






//     return response()->json([
//         'message'=> 'Attendance Report in School',
//         $grade => [
//             'TotalStudents' => $total_students,
//             'TotalPresentBoys'=> $total_boys_present_in_class,
//             'TotalPresentGirls'=> $total_girls_present_in_class,
//             'TotalAbsentBoys'=> $total_boys_absent_in_class,
//             'TotalAbsentGirls'=> $total_girls_absent_in_class
//         ]
//         ,
//         'TotalStudents'=> $total_students_in_school,
//         'TotalPresentStudents'=> $total_present_students,
//         'TotalAbsentStudents'=> $total_absent_students,
//         'TotalPresentBoys'=> $total_boys_present,
//         'TotalPresentGirls'=> $total_girls_present,
//         'TotalAbsentBoys'=> $total_boys_absent,
//         'TotalAbsentGirls'=> $total_girls_absent
//     ]);
// }

public function TODreport($school_id, $date)
{
    $school = School::where('id', $school_id)->first();
    $school_education_level = $school->educationLevel;

    $result =['message' => 'Attendance Report in School'];

    $result['grades'] = [];

    $levels = [
        'Standard One','Standard Two', 'Standard Three','Standard Four',
        'Standard Five', 'Standard Six', 'Standard Seven',
    ];

    if($school_education_level == 'Secondary') {
        $levels = ['Form One', 'Form Two', 'Form Three', 'Form Four'];
    }
    foreach($levels as $level) {

        $resultii[$level] = [];

       $resultii[$level]['grade'] = $level;
       $resultii[$level]['total_students'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('grade', $level )
            ->count();
        $resultii[$level]['total_boys_present_in_class'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('attendance_id' , "1")
            ->where('grade', $level )
            ->whereHas('student' , function($query){
                return $query->where('gender', 'male');
            })
            ->count();

        $resultii[$level]['total_girls_present_in_class'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('attendance_id' , "1")
            ->where('grade', $level )
            ->whereHas('student' , function($query){
                return $query->where('gender', 'female');
            })
            ->count();

        $resultii[$level]['total_boys_absent_in_class'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('attendance_id' , "2")
            ->where('grade', $level )
            ->whereHas('student' , function($query){
                return $query->where('gender', 'male');
            })
            ->count();

        $resultii[$level]['total_girls_absent_in_class'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('attendance_id' , "2")
            ->where('grade', $level )
            ->whereHas('student' , function($query){
                return $query->where('gender', 'female');
            })
            ->count();
           $result['grades'][]= $resultii[$level];
    }


    //-------total number of students called in attendance in that date-------//
      $attendanceschool_fetched  = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->get();
    $result['total_students_in_school'] = $attendanceschool_fetched->count();
    //-------total number of students called in attendance in that date-------//

    //--------total present students fetched in that date-------------------------------//
    $attendance_fetched_present = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "1")
        ->get();
    $result['total_present_students'] = $attendance_fetched_present->count();
    //--------total present students fetched in that date-------------------------------//


    //---------total present boys-----------------------------------------------------//
    $result['total_boys_present'] = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "1")
        ->whereHas('student' , function($query) {
            return $query->where('gender', 'male');
        })
        ->count();

    //---------total present girls-----------------------------------------------------//
    $result['total_girls_present'] = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "1")
        ->whereHas('student' , function($query) {
            return $query->where('gender', 'female');
        })
        ->count();

    //---------------total absent students in a school-------------------------------//
    $attendance_fetched_absent = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "2")
        ->get();
    $result['total_absent_students'] = $attendance_fetched_absent->count();

    //------------total absent boys in a school---------------------------------//
    $result['total_boys_absent'] = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "2")
        ->whereHas('student' , function($query) {
            return $query->where('gender', 'male');
        })
        ->count();

    //-----------------total absent girls in a school ---------------------------//
    $result['total_girls_absent'] = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "2")
        ->whereHas('student' , function($query) {
            return $query->where('gender', 'female');
        })
        ->count();


    return response()->json($result);
}

        public function pendingReportList($school_id){
            $datelist = [];
            $dates = TODremark::where('school_id', $school_id)
                                ->where('pendingbyHeadMaster', 1)
                                ->get();
            foreach($dates as $date){
                $datelist[] = $date->dateofattendances;

            }
            return response()->json($datelist);

        }

        public function rejectedReportList($school_id){
            $datelist = [];
            $dates = TODremark::where('school_id', $school_id)
                                ->where('rejectedByHeadMaster', 1)
                                ->get();
            foreach($dates as $date){
                $datelist[] = $date->dateofattendances;

            }
            return response()->json($datelist);

        }

        public function approvedReportList($school_id){
            $datelist = [];
            $dates = TODremark::where('school_id', $school_id)
                                ->where('approvedbyHeadMaster', 1)
                                ->get();
            foreach($dates as $date){
                $datelist[] = $date->dateofattendances;

            }
            return response()->json($datelist);

        }

public function pendingReport($school_id, $date)
{
    $school = School::where('id', $school_id)->first();
    $school_education_level = $school->educationLevel;
    $result =['message' => 'Attendance Report in School'];

    $result['grades'] = [];

    $levels = [
        'Standard One','Standard Two', 'Standard Three','Standard Four',
        'Standard Five', 'Standard Six', 'Standard Seven',
    ];

    if($school_education_level == 'Secondary') {
        $levels = ['Form One', 'Form Two', 'Form Three', 'Form Four'];
    }
    foreach($levels as $level) {

        $resultii[$level] = [];

       $resultii[$level]['grade'] = $level;
       $resultii[$level]['total_students'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('grade', $level )
            ->count();
        $resultii[$level]['total_boys_present_in_class'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('attendance_id' , "1")
            ->where('grade', $level )
            ->whereHas('student' , function($query){
                return $query->where('gender', 'male');
            })
            ->count();

        $resultii[$level]['total_girls_present_in_class'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('attendance_id' , "1")
            ->where('grade', $level )
            ->whereHas('student' , function($query){
                return $query->where('gender', 'female');
            })
            ->count();

        $resultii[$level]['total_boys_absent_in_class'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('attendance_id' , "2")
            ->where('grade', $level )
            ->whereHas('student' , function($query){
                return $query->where('gender', 'male');
            })
            ->count();

        $resultii[$level]['total_girls_absent_in_class'] = AttendanceStudent::where('dateofattendance', $date)
            ->where('school_id', $school_id)
            ->where('attendance_id' , "2")
            ->where('grade', $level )
            ->whereHas('student' , function($query){
                return $query->where('gender', 'female');
            })
            ->count();
           $result['grades'][]= $resultii[$level];
    }

    //-------total number of students called in attendance in that date-------//
      $attendanceschool_fetched  = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->get();
    $result['total_students_in_school'] = $attendanceschool_fetched->count();
    //-------total number of students called in attendance in that date-------//

    //--------total present students fetched in that date-------------------------------//
    $attendance_fetched_present = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "1")
        ->get();
    $result['total_present_students'] = $attendance_fetched_present->count();
    //--------total present students fetched in that date-------------------------------//


    //---------total present boys-----------------------------------------------------//
    $result['total_boys_present'] = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "1")
        ->whereHas('student' , function($query) {
            return $query->where('gender', 'male');
        })
        ->count();

    //---------total present girls-----------------------------------------------------//
    $result['total_girls_present'] = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "1")
        ->whereHas('student' , function($query) {
            return $query->where('gender', 'female');
        })
        ->count();

    //---------------total absent students in a school-------------------------------//
    $attendance_fetched_absent = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "2")
        ->get();
    $result['total_absent_students'] = $attendance_fetched_absent->count();

    //------------total absent boys in a school---------------------------------//
    $result['total_boys_absent'] = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "2")
        ->whereHas('student' , function($query) {
            return $query->where('gender', 'male');
        })
        ->count();

    //-----------------total absent girls in a school ---------------------------//
    $result['total_girls_absent'] = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)
        ->where('attendance_id' , "2")
        ->whereHas('student' , function($query) {
            return $query->where('gender', 'female');
        })
        ->count();

        $todremark = TODremark::where('school_id', $school_id)
                                ->where('dateofattendances', $date)
                                ->where('pendingbyHeadMaster', 1)
                                ->first();

                if(empty($todremark)){
                      $result['remarkyenyewe'] = "No Remark for this attendance";
                }else{
                    $result['remarkyenyewe']  = $todremark->remark;
                }
    return response()->json($result);
}


                        public function rejectReport($school_id, $date)
                        {

                                $todremark = TODremark::where('school_id', $school_id)
                                                        ->where('dateofattendances', $date)
                                                        ->where('pendingbyHeadMaster', 1)
                                                        ->first();

                                        if(empty($todremark)){
                                            $result['remarkyenyewe'] = "No Remark for this attendance";
                                        }else{

                                            DB::table('t_o_dremarks')->where('dateofattendances', $date)->update([
                                                'rejectedbyHeadMaster' => 1,
                                                'pendingbyHeadMaster' => 2
                                            ]);

                                            $result['remarkyenyewe']  = $todremark->remark;
                                            $result['reportStatus']  = 'The Report is Rejected';
                                        }
                            return response()->json($result);
                        }


                        public function approveReport($school_id, $date)
                        {

                                $todremark = TODremark::where('school_id', $school_id)
                                                        ->where('dateofattendances', $date)
                                                        ->where('pendingbyHeadMaster', 1 )
                                                        ->orWhere('rejectedbyHeadMaster', 1 )
                                                        ->first();

                                        if(empty($todremark)){
                                            $result['remarkyenyewe'] = "No Remark for this attendance";
                                        }else{

                                            DB::table('t_o_dremarks')->where('dateofattendances', $date)->update([
                                                'approvedbyHeadMaster' => 1,
                                                'pendingbyHeadMaster' => 2,
                                                'rejectedbyHeadMaster' => 2
                                            ]);

                                            $result['remarkyenyewe']  = $todremark->remark;
                                            $result['reportStatus']  = 'The Report is Approved';
                                        }

                            return response()->json($result);
                        }


                        public function approvedReport($school_id, $date)
                        {
                            $school = School::where('id', $school_id)->first();
                            $school_education_level = $school->educationLevel;
                            $result =['message' => 'Attendance Report in School'];
                            $result['grades'] = [];

                            $levels = [
                                'Standard One','Standard Two', 'Standard Three','Standard Four',
                                'Standard Five', 'Standard Six', 'Standard Seven',
                            ];

                            if($school_education_level == 'Secondary') {
                                $levels = ['Form One', 'Form Two', 'Form Three', 'Form Four'];
                            }
                            foreach($levels as $level) {

                                $resultii[$level] = [];

                               $resultii[$level]['grade'] = $level;
                               $resultii[$level]['total_students'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('grade', $level )
                                    ->count();
                                $resultii[$level]['total_boys_present_in_class'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "1")
                                    ->where('grade', $level )
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'male');
                                    })
                                    ->count();

                                $resultii[$level]['total_girls_present_in_class'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "1")
                                    ->where('grade', $level )
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'female');
                                    })
                                    ->count();

                                $resultii[$level]['total_boys_absent_in_class'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "2")
                                    ->where('grade', $level )
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'male');
                                    })
                                    ->count();

                                $resultii[$level]['total_girls_absent_in_class'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "2")
                                    ->where('grade', $level )
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'female');
                                    })
                                    ->count();
                                   $result['grades'][]= $resultii[$level];
                            }

                            //-------total number of students called in attendance in that date-------//
                            $attendanceschool_fetched  = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->get();
                            $result['total_students_in_school'] = $attendanceschool_fetched->count();
                            //-------total number of students called in attendance in that date-------//

                            //--------total present students fetched in that date-------------------------------//
                            $attendance_fetched_present = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "1")
                                ->get();
                            $result['total_present_students'] = $attendance_fetched_present->count();
                            //--------total present students fetched in that date-------------------------------//


                            //---------total present boys-----------------------------------------------------//
                            $result['total_boys_present'] = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "1")
                                ->whereHas('student' , function($query) {
                                    return $query->where('gender', 'male');
                                })
                                ->count();

                            //---------total present girls-----------------------------------------------------//
                            $result['total_girls_present'] = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "1")
                                ->whereHas('student' , function($query) {
                                    return $query->where('gender', 'female');
                                })
                                ->count();

                            //---------------total absent students in a school-------------------------------//
                            $attendance_fetched_absent = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "2")
                                ->get();
                            $result['total_absent_students'] = $attendance_fetched_absent->count();

                            //------------total absent boys in a school---------------------------------//
                            $result['total_boys_absent'] = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "2")
                                ->whereHas('student' , function($query) {
                                    return $query->where('gender', 'male');
                                })
                                ->count();

                            //-----------------total absent girls in a school ---------------------------//
                            $result['total_girls_absent'] = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "2")
                                ->whereHas('student' , function($query) {
                                    return $query->where('gender', 'female');
                                })
                                ->count();

                                $todremark = TODremark::where('school_id', $school_id)
                                                        ->where('dateofattendances', $date)
                                                        ->where('approvedbyHeadMaster', 1)
                                                        ->first();

                                        if(empty($todremark)){
                                            $result['remarkyenyewe'] = "No Remark for this attendance";
                                        }else{
                                            $result['remarkyenyewe']  = $todremark->remark;
                                            $result['reportStatus']  = 'The Report is Approved';
                                        }
                            return response()->json($result);
                        }


                        public function rejectedReport($school_id, $date)
                        {
                            $school = School::where('id', $school_id)->first();
                            $school_education_level = $school->educationLevel;
                            $result =['message' => 'Attendance Report in School'];
                            $result['grades'] = [];

                            $levels = [
                                'Standard One','Standard Two', 'Standard Three','Standard Four',
                                'Standard Five', 'Standard Six', 'Standard Seven',
                            ];

                            if($school_education_level == 'Secondary') {
                                $levels = ['Form One', 'Form Two', 'Form Three', 'Form Four'];
                            }
                            foreach($levels as $level) {

                                $resultii[$level] = [];

                               $resultii[$level]['grade'] = $level;
                               $resultii[$level]['total_students'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('grade', $level )
                                    ->count();
                                $resultii[$level]['total_boys_present_in_class'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "1")
                                    ->where('grade', $level )
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'male');
                                    })
                                    ->count();

                                $resultii[$level]['total_girls_present_in_class'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "1")
                                    ->where('grade', $level )
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'female');
                                    })
                                    ->count();

                                $resultii[$level]['total_boys_absent_in_class'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "2")
                                    ->where('grade', $level )
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'male');
                                    })
                                    ->count();

                                $resultii[$level]['total_girls_absent_in_class'] = AttendanceStudent::where('dateofattendance', $date)
                                    ->where('school_id', $school_id)
                                    ->where('attendance_id' , "2")
                                    ->where('grade', $level )
                                    ->whereHas('student' , function($query){
                                        return $query->where('gender', 'female');
                                    })
                                    ->count();
                                   $result['grades'][]= $resultii[$level];
                            }

                            //-------total number of students called in attendance in that date-------//
                            $attendanceschool_fetched  = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->get();
                            $result['total_students_in_school'] = $attendanceschool_fetched->count();
                            //-------total number of students called in attendance in that date-------//

                            //--------total present students fetched in that date-------------------------------//
                            $attendance_fetched_present = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "1")
                                ->get();
                            $result['total_present_students'] = $attendance_fetched_present->count();
                            //--------total present students fetched in that date-------------------------------//


                            //---------total present boys-----------------------------------------------------//
                            $result['total_boys_present'] = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "1")
                                ->whereHas('student' , function($query) {
                                    return $query->where('gender', 'male');
                                })
                                ->count();

                            //---------total present girls-----------------------------------------------------//
                            $result['total_girls_present'] = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "1")
                                ->whereHas('student' , function($query) {
                                    return $query->where('gender', 'female');
                                })
                                ->count();

                            //---------------total absent students in a school-------------------------------//
                            $attendance_fetched_absent = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "2")
                                ->get();
                            $result['total_absent_students'] = $attendance_fetched_absent->count();

                            //------------total absent boys in a school---------------------------------//
                            $result['total_boys_absent'] = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "2")
                                ->whereHas('student' , function($query) {
                                    return $query->where('gender', 'male');
                                })
                                ->count();

                            //-----------------total absent girls in a school ---------------------------//
                            $result['total_girls_absent'] = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "2")
                                ->whereHas('student' , function($query) {
                                    return $query->where('gender', 'female');
                                })
                                ->count();

                                $todremark = TODremark::where('school_id', $school_id)
                                                        ->where('dateofattendances', $date)
                                                        ->where('rejectedbyHeadMaster', 1)
                                                        ->first();

                                        if(empty($todremark)){
                                            $result['remarkyenyewe'] = "No Remark for this attendance";
                                        }else{
                                            $result['remarkyenyewe']  = $todremark->remark;
                                            $result['reportStatus']  = 'The Report is rejected';
                                        }
                            return response()->json($result);
                        }



    public function attendanceReportHeadMaster($school_id, $date){
        $attendanceschool_fetched = AttendanceStudent::where('dateofattendance', $date)
        ->where('school_id', $school_id)->get();
        $total_students_in_school = $attendanceschool_fetched->count();


           //total present students fetched
           $attendance_fetched_present = AttendanceStudent::where('dateofattendance', $date)
           ->where('school_id', $school_id)
           ->where('attendance_id' , "1")->get();
                    //total present students are counted
                    $total_present_student = $attendance_fetched_present->count();
                    //starting to get total boys and girls and counting them here

                    //male
                    $male_present = AttendanceStudent::where('dateofattendance', $date)
                            ->where('school_id', $school_id)
                            ->where('attendance_id' , "1")
                            ->whereHas('student' , function($query){
                                return $query->where('gender', 'male');
                            })
                            ->count();

                    $female_present = AttendanceStudent::where('dateofattendance', $date)
                            ->where('school_id', $school_id)
                            ->where('attendance_id' , "1")
                            ->whereHas('student' , function($query){
                                return $query->where('gender', 'female');
                            })
                            ->count();

                    $attendance_fetched_absent = AttendanceStudent::where('dateofattendance', $date)
                                ->where('school_id', $school_id)
                                ->where('attendance_id' , "2")->get();
                    //total absent students are counted
                    $total_absent_student = $attendance_fetched_absent->count();

                    $male_absent = AttendanceStudent::where('dateofattendance', $date)
                    ->where('school_id', $school_id)
                    ->where('attendance_id' , "2")
                    ->whereHas('student' , function($query){
                    return $query->where('gender', 'male');
                    })
                    ->count();

                    $female_absent = AttendanceStudent::where('dateofattendance', $date)
                    ->where('school_id', $school_id)
                    ->where('attendance_id' , "2")
                    ->whereHas('student' , function($query){
                    return $query->where('gender', 'female');
                    })
                    ->count();


        $todremark = TODremark::where('school_id', $school_id)
                                ->where('dateofattendances', $date)->first();

                if(empty($todremark)){
                      $remarkyenyewe = "No Remark for this attendance";
                }else{
                    $remarkyenyewe = $todremark->remark;
                }

                                return response()->json([
                                'message'=> 'Attendance Report in School',
                                'Total Students' => $total_students_in_school,
                                'Total Present Students' => $total_present_student,
                                'Total_boys_present' => $male_present,//count($Array_student_boys_present),
                                'Total_girls_present' => $female_present,//count($Array_student_girls_present),
                                'Total Absent Student' => $total_absent_student,
                                'Total_boys_absent' => $male_absent,
                                'Total_girls_absent' => $female_absent,
                                'Date' => $date,
                                'remark' => $remarkyenyewe
                ]);


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Attendance::find($id);
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
        $attendance = Attendance::find($id);
        $attendance ->update($request->all());
        return $attendance;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         return Attendance::destroy($id);
    }

     /**
     * this method will help in searches for a remarks.
     *
     * @param  str  $remarks
     * @return \Illuminate\Http\Response
     */
    public function search($remarks)
    {
         return Attendance::where('remarks', 'like', '%'.$remarks.'%')->get();
    }
}
