<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'month' => 'required',
            'year' => 'required',
            'paid' => 'required',
            'amount' => 'required',
        ]);

        // Create a new payment record
        $payment = new Payment();
        $payment->user_id = $validatedData['user_id'];
        $payment->month = $validatedData['month'];
        $payment->year = $validatedData['year'];
        $payment->paid = $validatedData['paid'];
        $payment->amount = $validatedData['amount'];
        $payment->save();

        // Redirect back or to any other page as needed
        return redirect()->back()->with('success', 'Payment successfully created.');
    }
}
