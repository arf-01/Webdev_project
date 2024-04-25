<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

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
            return response()->view('manage', compact('users'));
        }

        else if(Auth::attempt($credentials) && Auth::user()->is_admin==0)
        {
            return response()->view('offer');
        }
        else
        {
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }


        
        
        

       
    }
}
