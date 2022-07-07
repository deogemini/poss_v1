<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\School;
use App\Models\Ward;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\School_Teachers;




class HeadTeacherController extends Controller
{
    //get all HeadTeachers in the system
    public function index()
    {
        $headteachers = User::with('schools')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isHeadTeacher')
        )
        ->get();

    return response()->json(['headteachers' => $headteachers]);
       
    }

    public function view()
    {
        $headTeachers = User::with('schools')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isHeadTeacher')
        )
        ->get();
        // return $headTeachers;
        $schools = School::all();
        // return $wardOfficers;
        $wards = Ward::all();
        $districts =  District::all();
        $regions =  Region::all();

        return view('dashboard.headTeachers.index', compact(['headTeachers','schools',  'wards','districts', 'regions']));
        
    } 


    // Display a listing of the teachers with the same school_id of the headTeacher.
    public function getTeachersinSchool($id){
        $teachers = User::whereHas(
                'roles' , fn($query) =>
                $query->where('name', 'isTeacher'))->
                whereHas(
                    'schools' , fn($query) =>
                    $query->where('id', $id))->get();

        return response()->json(['teachers' =>$teachers]);
    }

    
    // Display a listing of the teachers with the same school_id of the headTeacher.
    public function getStreams($id){
        // $school = School::where('id',$id)->first();
        // $school = $school->id;
        // $grade = Grade::where('school_id', $id)->get(); 
         
        // foreach($users as $user){
        //     $teachers = User::whereHas(
        //         'roles' , function($user){
        //         $user->where('name', 'isTeacher');
        //     })->get();
        // }
         
      //  return response()->json($teachers);

    }

     // Display a listing of the teachers with the same school_id of the headTeacher.
     public function getTeachersOnDutyinSchool($id){
      $teachersOnDuty = User::whereHas(
            'roles' , fn($query) =>
            $query->where('name', 'isTeacherOnDuty'))->
            whereHas(
                'schools' , fn($query) =>
                $query->where('id', $id))->get();

    return response()->json(['teachersOnDuty' =>$teachersOnDuty]);

    }

    //creating new headTeacher in the system
    public function create(Request $request)
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
        $headTeacher = $user_check->id;

        $teacherinschool = School_Teachers::insert([
            'user_id' => $headTeacher,
            'school_id' => $school_id
        ]);

        if($user->save()){   
            $user_id = $user->id;
            $role = User::find($user_id);
        // role 4 is for isHeadTeacher, thus we attach this role to this user object 
        // ...this will create a record in user_role table
            $role->roles()->attach(4); 
            return response(['message' => 'A new Head Teacher successfully registered!',
             'data'=> $user]);
        
        }

    }


    //function to assign a specific teacher to be Teacher onduty
    public function isTeacherOnDuty($id)
    {
        $user = User::find($id);
        $user->roles()->sync(3); 
        $user->save();
        return response(['message' => 'A new Teacher on duty successfully registered!',
         'data'=> $user]);

    }
 
    public function isNotTeacherOnDuty($id)
    {
        $user = User::find($id);
        $user->roles()->sync(2); 
        $user->save();
        return response(['message' => 'A Teacher On Duty has been successfully removed!',
         'data'=> $user]);
    }


    public function show($id)
    {
        $headTeacher = User::find($id);
        return response()->json($headTeacher);
    }

  
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }
}
