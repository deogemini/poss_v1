<?php

namespace App\Http\Controllers;

use App\Models\School_Teachers;
use App\Models\TeacherinGrades;
use App\Models\School;
use App\Models\Grade;
use Illuminate\Http\Request;
use TeachersSchool;

class TeachersinGradeControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachersinGrades = TeacherinGrades::all();
        $teachers = School_Teachers::all();
        $grades = Grade::all();
        $schools = School::all();
        return $teachersinGrades;

        return view('dashboard.teachersingrade.index', compact(['teachersinGrades', 'grades', 'schools']));
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
                'user_id' => 'required',
                'grade_id' => 'required'
            ]
        );

        TeacherinGrades::create($request -> all());
        return back()->with('msg', 'Teacher was Succesful linked in Class');
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
