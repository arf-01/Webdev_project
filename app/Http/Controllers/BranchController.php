<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User; // Import the User model

class BranchController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_address' => 'required|string|max:255',
        ]);

        // Create a new branch using the validated data
        $branch = new Branch();
        $branch->name = $validatedData['branch_name'];
        $branch->address = $validatedData['branch_address'];
        $branch->save();

        
        return redirect()->route('manage');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

       
        

       
        return redirect()->route('manage');
    }


    public function redir()
    {   
        $users = User::all();
        $br = Branch::all();


        return view('manage' ,compact('users','br') );

    }
}
