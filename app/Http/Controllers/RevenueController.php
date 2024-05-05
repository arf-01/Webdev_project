<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\User;
use App\Models\Branch;

class RevenueController extends Controller
{
    public function calculate(Request $request)
    {
        // Retrieve the input data from the request
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $branchName = $request->input('branch_id'); // Change variable name to $branchName

        // Query to calculate revenue
        $query = Sale::query()
            ->whereBetween('sale_date', [$fromDate, $toDate]);

        // If a branch is selected, filter by branch name
        if ($branchName) {
            $query->where('branch_name', $branchName); // Change 'branch_id' to 'branch_name'
        }

        // Calculate total revenue
        $revenue = $query->sum('discounted_price');
        $users = User::all();
        $br = Branch::all();

        // Pass the revenue data to the view
        return view('manage', ['revenue' => $revenue, 'users' => $users, 'br' => $br]);
    }
}
