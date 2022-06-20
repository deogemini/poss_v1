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
        $Array_Student = [];
        $attendance_fetched_present = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
                                    ->where('grade_id', $grade_id)
                                    ->where('attendance_id' , "1")->get();
        $total_present_student = $attendance_fetched_present->count();
                          
                                    foreach($attendance_fetched_present as $presentStatus){ 
                                        $student_id = $presentStatus->student_id;
                                         $boys_present = Student::where('id',$student_id)->where('gender', 'male')->get();
                                         $total_boys_present = $boys_present->count();
                                         $girls_present = Student::where('id',$student_id)->where('gender', 'female')->get();
                                         $total_girls_present = $girls_present->count();
                                    }

        $attendance_fetched_absent = AttendanceStudent::where('created_at', 'LIKE', $date.'%')
                                        ->where('grade_id', $grade_id)
                                        ->where('attendance_id' , "2");

        $total_absent_student = $attendance_fetched_absent->count();

                                          foreach($attendance_fetched_absent as $absentStatus){
                                            $student_id = $absentStatus->student_id;
                                            $boys_absent = Student::where('id',$student_id)::where('gender', 'male')->get();
                                            $total_boys_absent = $boys_absent->count();
                                            $girls_absent = Student::where('id',$student_id)::where('gender', 'male')->get();
                                            $total_girls_absent = $girls_absent->count();
                                    }
                                 
                                  
                            //         ->addSelect([
                            // 'total_present_student' => Student::selectRaw('count(*)')
                            //         ->whereIn(
                            //         'student_id',
                            //         Stream::select('id')->where('grade_id', $grade_id)),
                            // 'total_present_boys' => Student::selectRaw('count(*)')
                            //         ->whereRaw('gender = "male"')
                            //         ->whereIn(
                            //         'student_id',
                            //         Student::select('id')->where('grade_id', $grade_id)),
                            // 'total_present_girls' => Student::selectRaw('count(*)')
                            //         ->whereRaw('gender = "female"')
                            //         ->whereIn(
                            //         'student_id',
                            //         Student::select('id')->where('grade_id', $grade_id))
                            //         ])->get();

   
    //                                 }
                            //         ->addSelect([
                            // 'total_absent_student' => Student::selectRaw('count(*)')
                            //          ->whereIn(
                            //              'student_id',
                            //              Student::select('id')->where('grade_id', $grade_id)),
                            // 'total_absent_boys' => Student::selectRaw('count(*)')
                            //         ->whereRaw('gender = "male"')
                            //         ->whereIn(
                            //              'student_id',
                            //              Student::select('id')->where('grade_id', $grade_id)),
                            // 'total_absent_girls' => Student::selectRaw('count(*)')
                            //         ->whereRaw('gender = "female"')
                            //         ->whereIn(
                            //              'student_id',
                            //              Student::select('id')->where('grade_id', $grade_id))
                            //              ])->get();

                        // return response()->json(['message'=>'Attendance Report in Grade',
                        //                          'Present' => $attendance_fetched_present,
                        //                          'Absent' => $attendance_fetched_absent ]);


                                                 $present_student_arr = [];
                                                 $absent_student_arr = [];
                                             
                                                 foreach ($attendance_fetched_present as $present) {
                                                     $present_student_arr[] = array(
                                                         'total_present_students' => $present[$total_present_student],
                                                         'total_boys_present' => $present[$total_boys_present],
                                                         'total_girls_present' => $present[$total_girls_present],
                                                        //  'created_at' => $present['created_at'],
                                                     );
                                                 }
                                             
                                                 foreach ($attendance_fetched_absent as $absent) {
                                                     $absent_student_arr[] = array(
                                                         'total_absent_students' => $absent[$total_absent_student],
                                                         'total_boys_absent' => $absent[$total_boys_absent],
                                                         'total_girls_absent' => $absent[$total_girls_absent],
                                                        //  'created_at' => $present['created_at'],
                                                     );
                                                 }
                                             
                                             
                                             
                                                 return response()->json(['message'=>'Attendance Report in Grade',
                                                                                          'Present' => $present_student_arr,
                                                                                          'Absent' => $absent_student_arr ]);







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
