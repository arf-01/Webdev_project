<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function delete($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()->with('success', 'User deleted successfully.');
    }
}



