<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User; 
use App\Models\Sale; 
use App\Models\Package;// Import the User model
use Illuminate\Support\Facades\Hash;

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


        return view('manage' ,compact('users','br') );

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
        $package->background_image =$backgroundImagePath;
        $package->product_code = $validatedData['product_code']; 

       // dd($package);

        $package->save();

        // Redirect back with success message
       // return redirect()->back()->with('success', 'Package added successfully.');

       return redirect()->route('manage');
    }

    public function sellProduct(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|string|email|max:255',
           // 'branch_name' => 'required|string|max:255',
        ]);
    
        // Get the branch name and email from the authenticated user
        $branch_name = auth()->user()->name;
        $discounted_price = $request->discounted_price;
       // $branch_email = auth()->user()->email;
    
        // Create a new sale record
        Sale::create([
            'package_id' => $id,
           'discounted_price'=> $discounted_price ,
            'customer_name' => $validatedData['customer_name'],
            'customer_email' => $validatedData['customer_email'],
            'branch_name' => $branch_name,
        ]);
    
        // You can also add the branch email if needed
        Package::findOrFail($id)->delete();
        // Redirect or return a response as needed
    }

}