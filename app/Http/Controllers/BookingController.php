<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BookingController extends Controller
{
    public function checkAvailability(Request $request)
    {
        $branch = $request->input('branch');
        $session = $request->input('session');

        $available = $this->performAvailabilityCheck($branch, $session);

        return response()->json(['available' => $available]);
    }

    private function performAvailabilityCheck($branch, $session)
    {   
        $branch = Branch::where('name', $branch)->first();
        
        if ($branch) {
            $availableSeats = $session === 'morning_session' ? $branch->morning_session : $branch->evening_session;
            
            return $availableSeats < 30; // Assuming 30 seats is the maximum capacity
        } else {
            return false; 
        }
    }
}
