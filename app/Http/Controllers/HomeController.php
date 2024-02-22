<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $teachers = User::with('schools')
        ->whereHas(
            'roles',
            fn($query) => $query->where('name', 'isTeacher')
        )
        ->get();
         $teacherNumbers = $teachers->count();
        return view('dashboard.dashboard',compact('teacherNumbers'));
    }
}
