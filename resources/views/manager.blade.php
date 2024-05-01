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
            <form action="{{ route('searchProduct') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by Product Code" name="product_code">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>

        <h2>List of Products:</h2>
        @foreach($packages as $package)
    @if($package->name == $x)
        <div class="card user-card">
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
                            <input type="email" class="form-control" placeholder="Customer Email" name="customer_email">
                        </div>

                        <div class="mb-1">
                        <input type="hidden" class="form-control" value="{{ $package->discounted_price }}" name="discounted_price">

                         </div>

                        <!-- Add more fields for customer details as needed -->

                        <button type="submit" class="btn btn-success btn-sm">Sell Product</button>
                    </form>
                </div>

                <!-- Delete User Form -->
               
            </div>
        </div>
    @endif
@endforeach


    <script>
        function deleteUser(userId) {
            if (confirm('Are you sure you want to delete this user?')) {
                document.getElementById('deleteForm' + userId).submit();
            }
        }
    </script>
@endsection