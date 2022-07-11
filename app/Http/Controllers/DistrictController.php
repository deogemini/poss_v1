<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Region;
use Maatwebsite\Excel\Files\Disk;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts =  District::all();
        $regions = Region::all();
        return view('dashboard.district.index', compact(['districts', 'regions']));
        
    }
   

     /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'name' =>  'required',    
                'region_id'=>'required'          
            ]
            );
            District::create($request -> all());

            return back()->with('msg', 'District Added Successfully');
    }

    public function show($id)
    {
        return Region::find($id);

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
    public function update(Request $request, District $district)
    {
        $district = District::find($district->id);
        $district ->update($request->all());
        return back()->with('msg','District updated successsfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        $district->delete();
        return back()->with('msg', 'One District deleted successsfully');
    }

    /**
     * this method will help in searches for a user by his/her name.
     *
     * @param  str  $role_name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
         return District::where('name', 'like', '%'.$name.'%')->get();
    }
}

