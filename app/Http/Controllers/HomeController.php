<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Branch;

class HomeController extends Controller
{  
   

    public function ind()
    {
        $branches = Branch::all(); 
        //dd($branches);
        return view('home', compact('branches'));
    }

   
}
