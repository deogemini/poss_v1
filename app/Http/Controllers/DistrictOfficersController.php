<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Officers_Districts;
use App\Models\Officers_Wards;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Ward;


class DistrictOfficersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

public function getWardsinDistrict($id){
        //this will be the id of the district available
         $district = District::where('id', $id)->first();
         $district_id = $district->id;
         $wards = Ward::where('district_id', $district_id)->get();
         return response()->json($wards);
}

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
        $districtOfficer = User::find($id);
        return response()->json($districtOfficer);
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
