<?php

namespace App\Http\Controllers;

use App\Models\Officers_Wards;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ward;
use App\Models\School;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Stream;
use App\Models\School_Teachers;
use PDO;

class WardOfficersController extends Controller
{
    /**
     * Display a listing of the headTeacher in sameward.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wardOfficers = User::with('wards')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isWardOfficer')
        )
        ->get();

    return response()->json(['wardOfficers' => $wardOfficers]);
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

        if($user->save()){ 
            $user_id = $user->id;
            $ward_id = $request['ward_id'];
            $user_check = User::where('id', $user_id)->first();
            $wardOfficer = $user_check->id;
    
            $ward_officers = Officers_Wards::insert([
                'user_id' => $wardOfficer,
                'ward_id' => $ward_id
            ]);

            $user_id = $user->id;
            $role = User::find($user_id);
        // role 6 is for isDistrictOfficer, thus we attach this role to this user object 
        // ...this will create a record in user_role table
            $role->roles()->attach(5); 
            return response(['message' => 'A new ward Officer registered!', 
                'data'=> $user]);
        
        }
    }

    
    public function getSchoolsinWard($id){
        //this will be the id of ward
        $array_count = [];
        $array_school = [];
        $schools = School::where('ward_id', $id)->get();
     
        foreach($schools as $school){
            $array_school[] = $school;
         $data = count($school->grades);
         foreach($school->grades as $grade){
             $total = count($grade->streams);
             foreach($grade->streams as $stream){
                 $total_students = count($stream->students);
                 foreach($stream->students as $student){
                    $array_count[] = $student;
                    $boys = Student::where('id', $student->id)->where('gender', 'male')->get();
                    $total_boys = $boys->count();
                    $girls = Student::where('id', $student->id)->where('gender', 'female')->get();
                    $total_girls = $girls->count();
                 }
             }
         }
        }
 
        $schoolsTotal = School::where('ward_id',$id)->count();
        return response(['message' => 'schools in wards', 
                'schools'=>$array_school,
                'total students'=> $array_count, 
                'total boys'=>$total_boys,
                'total girls' => $total_girls,
                'totals schools' => $schoolsTotal]);
    

    //    $schools =    School::query()->addSelect([
    //     /** Total no of students in school */
    //     'count_students' => Student::selectRaw('count(*)')
    //         ->whereIn(
    //           'stream_id', 
    //           Stream::select('id')->whereIn(
    //             'grade_id',
    //             Grade::select('id')->whereIn(
    //                 'school_id',
    //                 School::select($school_id)
    //                  )
    //             )
    //             ),
    //     ])->get();
       
    }

    public function getHeadTeachersinWard($id){
    //this will be the id of the school available in that ward
        $schools = School::where('ward_id',$id)->get(); 
        foreach($schools as $school){
            $school = $school->id;
        $users = School_Teachers::where('school_id', $school)->get();
    
        foreach($users as $user){
            $headTeachers = User::where('id',$user->user_id)
            ->whereHas(
                'roles',
                fn($query) => $query->where('name', 'isHeadTeacher')
            )
            ->get();
    
        return response()->json(['headTeachers' => $headTeachers]);
        }
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
        $wardOfficer = User::find($id);
        return response()->json($wardOfficer);
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
