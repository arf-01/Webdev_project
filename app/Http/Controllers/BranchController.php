<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User; 
use App\Models\Sale; 
use App\Models\Package;
use Illuminate\Support\Facades\Hash;
use Dompdf\Dompdf;

class BranchController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_address' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', // Validate email
            'password' => 'required|string|min:8', // Validate password
        ]);

        // Create a new branch using the validated data
        $branch = new Branch();
        $branch->name = $validatedData['branch_name'];
        $branch->address = $validatedData['branch_address'];
        $branch->save();

        // Create a new user using branch email and password
        $user = new User();
        $user->name = $validatedData['branch_name'];
        $user->hometown = $validatedData['branch_name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // Encrypt password
        $user->is_admin = 2; // Assuming 2 represents a regular user
        $user->save();

        return redirect()->route('manage');
    }

    public function destroy($id)
    {
        // Find the branch by its ID
        $branch = Branch::findOrFail($id);
        
        // Delete the branch
        $branch->delete();
        
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Branch deleted successfully.');
    }

    public function redir()
    {   
        $users = User::all();
        $br = Branch::all();

        return view('manage', compact('users', 'br'));
    }

    public function store_package(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'package_name' => 'required|string|max:255',
            'original_price' => 'required|numeric',
            'discount_percentage' => 'numeric',
            'background_image' => 'image', 
            'product_code' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'total_available_tickets'=>'required|numeric',
        ]);

        $backgroundImage = $request->file('background_image');
        $backgroundImageName = $backgroundImage->getClientOriginalName();
        $backgroundImage->move(public_path('staticimages'), $backgroundImageName);
        $backgroundImagePath = 'staticimages/' . $backgroundImageName; 

        // Calculate the discounted price
        $discountedPrice = $validatedData['original_price'] * (1 - ($validatedData['discount_percentage'] / 100));
           
        // Create a new package using the validated data
        $package = new Package();
        $package->name = $validatedData['package_name'];
        $package->original_price = $validatedData['original_price'];
        $package->discount_percentage = $validatedData['discount_percentage'];
        $package->discounted_price = $discountedPrice;
        $package->background_image = $backgroundImagePath;
        $package->product_code = $validatedData['product_code']; 
        $package->description = $validatedData['description']; 
        $package->total_available_tickets = $validatedData['total_available_tickets']; 
        $package->save();

        return redirect()->route('manage');
    }
    public function sellProduct(Request $request, $productCode)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_mobile' => 'required|string|max:255',
        ]);
    
        // Get the authenticated user's branch name
        $branch_name = auth()->user()->name;
    
        // Find the package by its product code
        $package = Package::where('product_code', $productCode)->firstOrFail();
    
        // Get the current total available tickets
        $total_available_tickets = $package->total_available_tickets;
    
        // Check if there are available tickets
        if ($request->filled('num_tickets') && $total_available_tickets >= $request->num_tickets) {
            // Subtract one from the total available tickets
            $package->total_available_tickets -= $request->num_tickets;
            $package->save();
    
            // Calculate discounted price
            $discounted_price = $package->discounted_price * $request->num_tickets;

    
            // Create a new sale record
            $sale = Sale::create([
                'package_id' => $package->id,
                'discounted_price' => $discounted_price,
                'customer_name' => $validatedData['customer_name'],
                'customer_mobile' => $validatedData['customer_mobile'],
                'branch_name' => $branch_name,
            ]);
    
            // Generate PDF receipt
            $pdf = new Dompdf();
            $pdf->loadHTML(view('receipt', compact('sale', 'package')));
            $pdf->setPaper('A4', 'portrait');
    
            // Render the PDF
            $pdf->render();
    
            // Save the PDF to a file
            $pdfPath = storage_path('app/public/receipts/') . 'receipt_' . $sale->id . '.pdf';
            file_put_contents($pdfPath, $pdf->output());
    
            // Provide a download link for the user
            return response()->download($pdfPath)->deleteFileAfterSend(true);
        } else {
            // Return a response indicating that no tickets are available
            session()->flash('error', 'No tickets available.');
    
            // Redirect back to the previous page
            return redirect()->back();
        }
    }
    

}
