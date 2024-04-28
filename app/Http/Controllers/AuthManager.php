<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Payment;
use App\Models\Branch;


class AuthManager extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function registration()
    {     
        $branches = Branch::all(); 
        return view('registration', compact('branches'));
       // return view('registration');
    }
    

    public function loginpost(Request $request)
    {  
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {   
            return view('offer');
        }

        return redirect()->route('login')->with("credential not valid");
    }

    public function registrationpost(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required'
    ]);

    // Create the user
    $user = User::create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'hometown' => $request->input('hometown'),
        'branch' => $request->input('branch'),
       // 'session' => $request->input('session')
       // 'session' =>

       


    ]);
    // Create payment entries for the next 12 months
    

  
       // $branches = Branch::all(); // Fetch all branches from the database
    
        return redirect()->route('login')->with("registration successfull");
    
}

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('home');
    }
}  