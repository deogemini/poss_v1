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
//get all users with the role of isWardOfficer
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

    //add new user in the system with the role of isWardOfficer
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

    // get all schools in a given ward
    public function getSchoolsinWard($id){
         $schools = School::query()
        ->where('ward_id',$id)
        ->addSelect([
            'total_students' => Student::selectRaw('count(*)')
                ->whereIn(
                    'stream_id', 
                    Stream::select('id')->whereIn(
                        'grade_id',
                        Grade::select('id')->whereColumn('school_id', 'schools.id')
                    )
                ),
            'total_boys' => Student::selectRaw('count(*)')
                ->whereRaw('gender = "male"')
                ->whereIn(
                    'stream_id', 
                    Stream::select('id')->whereIn(
                        'grade_id',
                        Grade::select('id')->whereColumn('school_id', 'schools.id')
                    )
                ),
            'total_girls' => Student::selectRaw('count(*)')
                ->whereRaw('gender = "female"')
                ->whereIn(
                    'stream_id', 
                    Stream::select('id')->whereIn(
                        'grade_id',
                        Grade::select('id')->whereColumn('school_id', 'schools.id')
                    )
                )      
        ])->get();

    return response()->json([
        'message' => 'schools in wards',
        'schools' => $schools,
        'total_students_in_ward' => $schools->sum('total_students'),
        'total_boys_in_ward' => $schools->sum('total_boys'),
        'total_girls_in_ward' => $schools->sum('total_girls'),
        'total_schools' => $schools->count()
    ]);
       
    }
//get headTeachers in ward 
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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $wardOfficer = User::find($id);
        return response()->json($wardOfficer);
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
