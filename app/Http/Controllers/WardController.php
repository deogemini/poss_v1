<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Ward;

class WardController extends Controller
{
    //get all wards
     public function index()
    {  
        $wards = Ward::all();
        foreach($wards as $ward){
            echo $ward;
        }
        
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
