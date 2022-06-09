<?php

namespace App\Http\Controllers;

use App\Models\Officers_Wards;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ward;
use App\Models\School;
use App\Models\School_Teachers;

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

        // $ward = Ward::where('id', $id)->first();
        // $ward = $ward->id;

        $schools = School::where('ward_id',$id)->get();
     
        $schoolsTotal = count(School::where('ward_id',$id)->get());

        return response(['message' => 'schools in wards', 
                'data'=> $schools, 'totals schools' => $schoolsTotal]);
       
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
