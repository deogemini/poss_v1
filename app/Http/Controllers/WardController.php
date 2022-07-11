<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Region;
use App\Models\Ward;

class WardController extends Controller
{
    //get all wards
     public function index()
    {  
        $wards = Ward::all();
        $districts =  District::all();
        $regions =  Region::all();

        return view('dashboard.ward.index', compact(['wards', 'districts', 'regions'])); 
    }



     public function store(Request $request)
    {
        $request->validate(
            [
                'name' =>  'required', 
                'district_id' => 'required'             
            ]
            );
        Ward::create($request -> all());

        return back()->with('msg', 'Ward Added Successfully');
    }

    public function show($id)
    {
        return  Ward::find($id);

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
    public function update(Request $request, Ward $ward)
    {
        $ward = Ward::find($ward->id);
        $ward ->update($request->all());
        return back()->with('msg','Ward updated successsfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ward $ward)
    {
        $ward->delete();
        return back()->with('msg', 'One Ward deleted successsfully');
    }

    /**
     * this method will help in searches for a user by his/her name.
     *
     * @param  str  $role_name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
         return Ward::where('name', 'like', '%'.$name.'%')->get();
    }
}

