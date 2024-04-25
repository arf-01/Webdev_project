<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function update($id)
    {
       
        $user = User::findOrFail($id); 
       
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'branch' => 'required|string|max:255',
        ]);

        
        $user->name = request('name');
        $user->email = request('email');
        $user->branch = request('branch');
        $user->save();

    
        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function delete($id)
    {
        
        $user = User::findOrFail($id);

        $user->delete();

      
        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}

