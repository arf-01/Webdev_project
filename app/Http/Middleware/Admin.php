<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use App\Models\Branch;
use App\Models\Package;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials) && Auth::user()->is_admin==1)
        {    $users = User::all();
             $br=Branch::all();
            return response()->view('manage', compact('users','br'));
        }

        else if(Auth::attempt($credentials) && Auth::user()->is_admin==0)
        {  
               $packages = Package::all(); 
              return response()->view('offer', compact('packages'));
           // return response()->view('offer');
        }

        else if(Auth::attempt($credentials) && Auth::user()->is_admin==2)
        {  
             //  $packages = Package::all(); 
             // return response()->view('offer', compact('packages'));
             $users = User::all();
             $x=Auth::user()->name;
           return response()->view('manager' ,compact('users','x'));
                

        }
        else
        {
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }


        
        
        

       
    }
}
