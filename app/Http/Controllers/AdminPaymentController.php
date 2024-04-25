<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
    {
        // Retrieve user ID from the request
        $userId = $request->query('id');

        // Retrieve payments for the user with the specified ID
        $payments = Payment::whereHas('user', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->get();

        // Pass payments to the view
        return view('index', compact('payments'));
    }

    public function update(Request $request, $paymentId)
    {
        // Retrieve the payment record
        $payment = Payment::findOrFail($paymentId);
    
        // Update the payment status based on the checkbox value
        $payment->paid = $request->has('paid');
        $payment->save();
    
        // Redirect back or return a response
        // Add success or error messages as needed
        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }
    
}
