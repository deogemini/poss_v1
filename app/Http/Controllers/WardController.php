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
        return response()->json($wards);   
    }

    public function view()
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
            return Ward::create($request -> all());
    }
}
