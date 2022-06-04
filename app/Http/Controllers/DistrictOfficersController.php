<?php

namespace App\Http\Controllers;

use App\Models\Officers_Districts;
use Illuminate\Http\Request;
use App\Models\User;


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
        //
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
