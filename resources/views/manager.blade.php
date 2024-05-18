@extends('layout')

@section('content')

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="container">
    <h1>Welcome, {{ $x }}</h1>

    <div class="mb-3">
        <!-- Search bar -->
        <div class="input-group">
            <input type="text" class="form-control" id="searchInput" placeholder="Search by Product Code">
            <button type="button" class="btn btn-primary" onclick="searchProduct()">Search</button>
        </div>
    </div>

    <h2>List of Products:</h2>
    @foreach($packages as $package)
        @if($package->name == $x)
            <div class="card user-card" id="product{{ $package->product_code }}"> <!-- Unique identifier added -->
                <div class="card-body">
                    <div>
                        <h6>Product Details:</h6>
                        <!-- Display product details here -->
                        <p>Product Code: {{ $package->product_code }}</p>
                        <p>Original Price: {{ $package->original_price }}</p>
                        <p>Discounted Price: {{ $package->discounted_price }}</p>
                        <!-- Add more product details as needed -->

                        <!-- Form to sell the product -->
                        <form action="{{ route('sellProduct', $package->product_code) }}" method="POST" class="d-inline">
                            @csrf
                            <div class="mb-1">
                                <input type="text" class="form-control" placeholder="Customer Name" name="customer_name">
                            </div>
                            <div class="mb-1">
    <input type="tel" class="form-control" placeholder="Customer Mobile Number" name="customer_mobile">
</div>

                            <div class="mb-1">
                                <input type="number" class="form-control" placeholder="Qunatity" name="num_tickets" min="1">
                            </div>
                            <input type="hidden" class="form-control" value="{{ $package->discounted_price }}" name="discounted_price">
                            <button type="submit" class="btn btn-success btn-sm">Sell Product</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<script>
    function searchProduct() {
        var searchInput = document.getElementById('searchInput').value;
        var productElement = document.getElementById('product' + searchInput);
        if (productElement) {
            productElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        } else {
            alert('Product not found.');
        }
    }
</script>

@endsection
