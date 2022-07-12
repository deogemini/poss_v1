<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Ward;
use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;

class SchoolingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();
        $wards = Ward::all();
        $districts =  District::all();
        $regions =  Region::all();

        return view('dashboard.school.index', compact(['schools','wards', 'districts', 'regions']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $request->validate(
            [
                'name' =>  'required',
                'educationLevel'=>'required',
                'ward_id' => 'required', 
            ]
            );

        School::create($request -> all());
        return back()->with('msg','School created successsfully');
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
                'educationLevel'=>'required',
                'ward_id' => 'required', 
            ]
            );

        School::create($request -> all());
        return back()->with('msg','School created successsfully');
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
    public function edit(Request $request, School $school)
    {
        $school = School::find($school->id);
        $school ->update($request->all());
        return back()->with('msg','School edited successsfully');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, School $school)
    {
        $school = School::find($school->id);
        $school ->update($request->all());
        return back()->with('msg','School edited successsfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(School $school)
    {
        $school->delete();
        return back()->with('msg', 'One School deleted successfully');
    }
}
