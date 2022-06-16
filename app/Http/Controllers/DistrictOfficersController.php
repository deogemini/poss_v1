<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Officers_Districts;
use App\Models\Officers_Wards;
use App\Models\School;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Stream;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Ward;


class DistrictOfficersController extends Controller
{
    //get all users with the role of being isDistrictOfficer
    public function index()
    {
        $districtOfficers = User::with('districts')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isDistrictOfficer')
        )
        ->get();

    return response()->json(['districtOfficers' => $districtOfficers]);

    }

    //add new district officer in the system
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
        $district_id = $request['district_id'];
        $user_check = User::where('id', $user_id)->first();
        $districtOfficer = $user_check->id;

        $district_officers = Officers_Districts::insert([
            'user_id' => $districtOfficer,
            'district_id' => $district_id
        ]);
        
            $user_id = $user->id;
            $role = User::find($user_id);
        // role 6 is for isDistrictOfficer, thus we attach this role to this user object 
        // ...this will create a record in user_role table
            $role->roles()->attach(6); 
            return response(['message' => 'A new district Officer successfully registered!', 
               'data'=> $user, $role]);

        }
    }

    //get wards in a district
    public function getWardsinDistrict($id){
         $wards = Ward::query()
         ->where('district_id', $id)
         ->addSelect([
        'total_students' => Student::selectRaw('count(*)')
         ->whereIn(
             'stream_id', 
             Stream::select('id')->whereIn(
                 'grade_id',
                 Grade::select('id')->whereIn(
                    'school_id',
                    School::select('id')->whereColumn('ward_id', 'wards.id')
                 )
             )
         ),
         'total_boys' => Student::selectRaw('count(*)')
         ->whereRaw('gender = "male"')
         ->whereIn(
             'stream_id', 
             Stream::select('id')->whereIn(
                 'grade_id',
                 Grade::select('id')->whereIn(
                    'school_id',
                    School::select('id')->whereColumn('ward_id', 'wards.id')
                 )
             )
                 ),
                 'total_girls' => Student::selectRaw('count(*)')
                 ->whereRaw('gender = "female"')
                 ->whereIn(
                     'stream_id', 
                     Stream::select('id')->whereIn(
                         'grade_id',
                         Grade::select('id')->whereIn(
                            'school_id',
                            School::select('id')->whereColumn('ward_id', 'wards.id')
                         )
                     )
                 )

         
        ])->get();

        return response()->json([
            'message' => 'wards in district',
            'wards' => $wards,
            'total_students_in_ward' => $wards->sum('total_students'),
            'total_schools' => $wards->count()
        ]);
    }

    //get Ward Officers in District
    public function getWardOfficerinDistrict($id){
    //this will be the id of the district available
        $district = District::where('id', $id)->first();
        $district_id = $district->id;
        $wards = Ward::where('district_id', $district_id)->get();
        foreach($wards as $ward){
        $ward = $ward->id;
        $users = Officers_Wards::where('ward_id', $ward)->get();
        
        foreach($users as $user){
            $user = $user->user_id;
            $wardOfficers = User::where('id', $user)->whereHas( 
            'roles' , 
            fn($query) =>
            $query->where('name', 'isWardOfficer')
            )->get();
            }
            return $wardOfficers;
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $districtOfficer = User::find($id);
        return response()->json($districtOfficer);
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
