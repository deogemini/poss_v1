<?php

namespace App\Http\Controllers;

use App\Models\Officers_Districts;
use App\Models\Officers_Wards;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleUser;
use App\Models\School_Teachers;

class AuthController extends Controller
{
   
    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();
        $user_id = $user->id;
        $role_user = RoleUser::where('user_id', $user_id)->first();
        $teacher_user = School_Teachers::where('user_id', $user_id)->first();
        $district_officer = Officers_Districts::where('user_id', $user_id)->first();
        $ward_officer = Officers_Wards::where('user_id', $user_id)->first();

// starting to check and create token while login
        $token = $user->api_token;
        if($token){
            $token = $user->api_token;
        }else{
              $token = Str::random(60);
              $user->api_token= $token;
              $user->save();
              
        }
//ending to check and create token while login
        
// to check if user  is teacher and get school_id
       if($teacher_user){
            $school_id = $teacher_user->school_id;
            $id = $school_id;
        }
        // to check if user  isdistrict officer and get district_id
        if($district_officer){
          $district_id = $district_officer->district_id;
          $id = $district_id;
        }
    //to check if user  isward officer and get district_id
        if($ward_officer){
            $ward_id = $ward_officer->ward_id;
            $id = $ward_id;

        }
        if($role_user){
        $role = $role_user->Role->name; 
        
        }
        if(auth()->attempt($loginData)){            
            return response(['message'=>'You have passed the authentication',
             'data'=> $user, 'role' => $role , 'id' => $id ?? 'Admin']);
        }else{


            //  function to remove the role of teacher on duty

    $response = ['message' => 'Invalid credentials !'];
    return response($response, 401);
        }

    
    }   


    //logout to the application 
    public function logout (Request $request) {
        $user_id = $request->user_id;
        $user = User::find($user_id);
        $user->api_token = null;
        $user->save();

     return response()->json([
            'message' => 'Logged out successfully!',
            'status_code' => 200
        ], 200);

     }

     public function webLogout(Request $request) {
        Auth::logout();
        return redirect('/');
      }


//to create new user
    public function register(Request $request){
        // To create new user
        // ...this method will be used.
        $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'api_token' => Str::random(60),
        ]);
  
       // save roles data   
        $user_id = $user->id;
        $role = User::find($user_id);
        // role 2 is for teacher, thus we attach this role to this user object 
        // ...this will create a record in user_role table
        $role->roles()->attach(1);     
        // Roles:::
        // Teacher = 2
        // Teacher on duty = 5
        // admin = 

        $response = ['message' => 'You have been successfully login!'];
        return response($response, 200);
    
}


public function webLogin(Request $request){
    $loginData = $request->validate([
        'email' => 'email|required',
        'password' => 'required'
    ]);

    $email = $request->email;
    $user = User::where('email', $email)->first();
    $user_id = $user->id;
    $role_user = RoleUser::where('user_id', $user_id)->first();
    $teacher_user = School_Teachers::where('user_id', $user_id)->first();
    $district_officer = Officers_Districts::where('user_id', $user_id)->first();
    $ward_officer = Officers_Wards::where('user_id', $user_id)->first();

// starting to check and create token while login
    $token = $user->api_token;
    if($token){
        $token = $user->api_token;
    }else{
          $token = Str::random(60);
          $user->api_token= $token;
          $user->save();
          
    }
//ending to check and create token while login
    
// to check if user  is teacher and get school_id
   if($teacher_user){
        $school_id = $teacher_user->school_id;
        $id = $school_id;
    }
    // to check if user  isdistrict officer and get district_id
    if($district_officer){
      $district_id = $district_officer->district_id;
      $id = $district_id;
    }
//to check if user  isward officer and get district_id
    if($ward_officer){
        $ward_id = $ward_officer->ward_id;
        $id = $ward_id;

    }
    if($role_user){
    $role = $role_user->Role->name; 
    
    }
    if(auth()->attempt($loginData)){            
        return view('dashboard.dashboard');
    }else{


        //  function to remove the role of teacher on duty

$response = ['message' => 'Invalid credentials !'];
return response($response, 401);
    }


}

}