<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Region;


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
        return response()->json($districts);
        
    }
    public function view()
    {
        $districts =  District::all();
        $regions =  Region::all();

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
            return District::create($request -> all());
    }




}
