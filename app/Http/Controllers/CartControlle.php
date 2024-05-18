<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Package;

class CartControlle extends Controller
{
    public function checkout()
    {
        session()->forget('cart'); // Clear the cart

        return redirect()->route('cart.show')->with('success', 'Checked out successfully!');
    }

    public function addToCart(Request $request, $productId)
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        // Fetch the product details by ID
        $product = Package::find($productId);
        if (!$product) {
            return redirect()->route('cart.show')->with('error', 'Product not found!');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                "id" => $product->id, 
                "code" => $product->product_code,
                "quantity" => $quantity,
                "price" => $product->discounted_price,
                "image" => $product->background_image
            ];
        }
       // dd($cart);

        session()->put('cart', $cart);

        return redirect()->route('cart.show')->with('success', 'Product added to cart!');
    }

    public function showCart()
    {
        $cart = session()->get('cart', []);

        // No need to fetch products individually if you want to send the entire cart to the view

        return view('cart_show', compact('cart'));
    }
}
