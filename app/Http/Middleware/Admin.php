<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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
        {   
            return response()->view('manage');
        }

        else if(Auth::attempt($credentials) && Auth::user()->is_admin==0)
        {
            return response()->view('offer');
        }
        else
        {
            return response()->view('login');
        }


        
        
        

       
    }
}
