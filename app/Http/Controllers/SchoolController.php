<?php

namespace App\Http\Controllers;
use App\Models\School;
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
        $schools = School::all();   
        foreach($schools as $school){
        echo $school;
        }
    }

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
