@extends('layout')

@section('content')
    <div class="container">
        <h2>Shopping Cart</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(count($cart) > 0)
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach($cart as $item)
                        @php
                            $subtotal = $item['quantity'] * $item['price'];
                            $totalPrice += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['code'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ $subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <p>Total Price: {{ $totalPrice }}</p>
                <a href="{{ route('cart.checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
@endsection
