<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Hash;
use Auth;
class UserController extends Controller
{
    

    public function register(UserRequest $request){


    	User::create([

    		'name' => $request->firstname.' '. $request->lastname,
    		'email' => $request->email,
    		'password' => Hash::make($request->password)
    	]);

    	return view('auth.login');

    }


    public function login(Request $request){

    	$credentials = array(
    		'email' => $request->email,
    		'password' => $request->password
    	);


    	if(Auth::attempt($credentials)){
    		return redirect()->route('dashboard');
    	}else{
    		return redirect()->back()->with(['error' => 'Invalid username or password']);
    	}
    }

    public function fetchUsers(){

        return response(json_encode(User::where('name','!=','admin')->get()),200);
    }
    
}
