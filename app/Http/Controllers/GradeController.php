<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Grade;
use App\Models\Region;
use App\Models\School;
use App\Models\Schools;
use App\Models\Ward;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $grades = Grade::all();
        $schools = School::all();
        $wards = Ward::all();
        $districts = District::all();
        $regions = Region::all();

        return view('dashboard.grade.index', compact(['grades', 'schools', 'wards', 'districts', 'regions']));

        
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
                'school_id' => 'required',
            ]
            );

        Grade::create($request -> all());
        return back()->with('msg', 'New Grade was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Grade::find($id);
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
        $grade = Grade::find($id);
        $grade ->update($request->all());
        return back()->with('msg', 'The Grade was Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        $grade -> delete();
        return back()->with('msg', 'Grade Deleted');
    }

    /**
     * this method will help in searches for a grades by name.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
         return Grade::where('name', 'like', '%'.$name.'%')->get();
    }
}
