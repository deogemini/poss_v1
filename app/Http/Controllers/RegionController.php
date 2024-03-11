<?php

namespace App\Http\Controllers;

use App\Imports\ImportRegion;
use Illuminate\Http\Request;
use App\Models\Region;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $regions = Region::all();
        if ($request->wantsJson()) {
            return response()->json(['regions' => $regions]);
        }

        return view('dashboard.region.index', compact('regions'));

    }
    // public function view()
    // {
    //     $regions = Region::all();
    //    return view('dashboard.region.index', compact('regions'));

    // }

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

    public function addExcel(Request $request)
    {

        Excel::import(new ImportRegion, $request->file('file')->store('files'));
        return redirect()->back()->with('msg', "Regions Added Successfully");
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
    public function update(Request $request, Region $region)
    {
        $region = Region::find($region->id);
        $region ->update($request->all());
        return back()->with('msg','Region updated successsfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return back()->with('msg', 'Region deleted successsfully');
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
