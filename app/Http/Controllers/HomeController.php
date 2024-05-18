<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Package;

class HomeController extends Controller
{  
   

    public function ind()
    {
        $packages =Package::all(); 
    
       
        $newArrivals = Package::where('created_at', '>=', now()->subDays(7))
        ->orderBy('created_at', 'desc')
        ->limit(4) // Adjust the limit as needed
        ->get();

        return view('home', compact('packages','newArrivals'));
    }





   
}
