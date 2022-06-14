<?php

namespace App\Http\Controllers;
use App\Models\School;
use App\Models\Student;
use App\Models\Stream;
use App\Models\Grade;

use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $schools =    School::query()->addSelect([
      /** Total no of students in school */
      'count_students' => Student::selectRaw('count(*)')
          ->whereIn(
            'stream_id', 
            Stream::select('id')->whereIn(
              'grade_id',
              Grade::select('id')->whereColumn('school_id', 'schools.id')
            )
          ),
           /** Total no of "gender = male" students in school */
      'count_male' => Student::selectRaw('count(*)')
      ->whereRaw('gender = "male"')
      ->whereIn(
        'stream_id', 
        Stream::select('id')->whereIn(
          'grade_id',
          Grade::select('id')->whereColumn('school_id', 'schools.id')
        )
      ),
  /** Total no of "gender = female" students in school */
  'count_female' => Student::selectRaw('count(*)')
      ->whereRaw('gender = "female"')
      ->whereIn(
        'stream_id', 
        Stream::select('id')->whereIn(
          'grade_id',
          Grade::select('id')->whereColumn('school_id', 'schools.id')
        )
      ),
])->get();
return response()->json(['schools'=>$schools]); }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $school = new School;
         $school->name = $request['name'];
         $school->educationLevel = $request['educationLevel'];
         $school->ward_id = $request['ward_id'];
        $school->save();
        return response(['message' => 'A new school registered!', 'data'=>array('name'=>$school->name, 'educationLevel'=>$school->educationLevel, 'ward' => $school->ward_id)]);

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

        return School::create($request -> all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return School::find($id);
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
        $school = School::find($id);
        $school ->update($request->all());
        return $school;
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return School::destroy($id);

    }

     /**
     * this method will help in searches for a school name.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
         return School::where('name', 'like', '%'.$name.'%')->get();
    }
}
