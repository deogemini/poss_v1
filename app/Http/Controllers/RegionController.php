<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;


class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
       return response()->json($regions);
        
    }
    public function view()
    {
        $regions = Region::all();
       return view('dashboard.region.index', compact('regions'));
        
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
            ]
            );

         Region::create([
            'name' => $request -> name]);
     
            return back()->with('msg', 'Region Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function update(Request $request, $id)
    {
        $region = Region::find($id);
        $region ->update($request->all());
        return $region;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Region::destroy($id);
    }

    /**
     * this method will help in searches for a user by his/her name.
     *
     * @param  str  $role_name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
         return Region::where('name', 'like', '%'.$name.'%')->get();
    }
}
