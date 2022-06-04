<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use App\Models\AttendanceStudent;
use App\Models\AttendanceTeacher;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
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

        $attendanceStudent = AttendanceStudent::insert([
            'attendance_id' => $attendance,
            'student_id' => $attendanceStudent
        ]);

        $attendanceUser = AttendanceTeacher::insert([
            'user_id' => $attendanceUser,
            'attendance_id' => $attendance
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
