<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\AttendanceTeacher;
use App\Models\Stream;
use App\Models\Student;
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
         $stream_id = $student->stream_id;
         $actual_stream = Stream::where('id', $stream_id)->get();
         foreach($actual_stream as $stream){
             $grade_id = $stream->grade_id;
         }         
        }
        $attendanceStudent = AttendanceStudent::insert([
            'attendance_id' => $attendance,
            'student_id' => $attendanceStudent,
            'grade_id' => $grade_id,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
        ]);

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
       
       
        return response(['message' => 'A new attendance successfully registered!', 
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


    public function getAttendanceReport($grade_id, $date){
        $Array_student_boys_present= [];
        $Array_student_boys_absent= [];
        $Array_student_girls_present = [];
        $Array_student_girls_absent = [];

        //total students are counted
        $attendance_fetched = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
                                    ->where('grade_id', $grade_id)->get();
        $total_students = $attendance_fetched->count();
        //total present students fetched
        $attendance_fetched_present = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
                                    ->where('grade_id', $grade_id)
                                    ->where('attendance_id' , "1")->get();
        //total present students are counted
         $total_present_student = $attendance_fetched_present->count();
         //starting to get total boys and girls and counting them here
                                    foreach($attendance_fetched_present as $presentStatus){ 
                                        $student_id = $presentStatus->student_id;
                                         $boys_present = Student::where('id',$student_id)->where('gender', 'male')->get();
                                         foreach($boys_present as $presentboy){
                                            $Array_student_boys_present[] = $presentboy->id;
                                         }
                                         $girls_present = Student::where('id',$student_id)->where('gender', 'female')->get();
                                         foreach($girls_present as $presentGirl){
                                            $Array_student_girls_present[] = $presentGirl->id;
                                         }
                                        
                                    }

        $attendance_fetched_absent = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
                                        ->where('grade_id', $grade_id)
                                        ->where('attendance_id' , "2")->get();
        //total absent students are counted                               
        $total_absent_student = $attendance_fetched_absent->count();
        //starting to get total boys and girls and counting them here
                            foreach($attendance_fetched_absent as $absentStatus){ 
                                        $student_id = $absentStatus->student_id;
                                         $boys_absent = Student::where('id',$student_id)->where('gender', 'male')->get();
                                         foreach($boys_absent as $absentboy){
                                            $Array_student_boys_absent[] = $absentboy->id;
                                         }
                                         
                                         $girls_absent = Student::where('id',$student_id)->where('gender', 'female')->get();
                                         foreach($girls_absent as $absentgirl){
                                            $Array_student_girls_absent[] = $absentgirl->id;
                                         }
                                        
                                    }
        return response()->json(['message'=>'Attendance Report in Grade',
                                            'Total Students' => $total_students,
                                            'Present' => $total_present_student,
                                           'Total_boys_present' => count($Array_student_boys_present),
                                            'Total_girls_present' => count($Array_student_girls_present),
                                            'Absent' => $total_absent_student,
                                            'Total_boys_absent' => count($Array_student_boys_absent),
                                            'Total_girls_absent' => count($Array_student_girls_absent)
                                         ]);
                                 } 
                                                                                                                        
    //    count students with grade($grade_id)and the attendance status is present
    //    count students with grade($grade_id)and the attendance status is Absent
    //    count students where gender is male in grade($grade_id) and the attedance status is present
    //    count students where gender is male in grade($grade_id) and the attedance status is absent
    //    count students where gender is female in grade($grade_id) and the attedance status is present
    //    count students where gender is female in grade($grade_id) and the attedance status is absent
    

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
