@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        @foreach($packages as $package)
        <di  v class="col-md-4">
            <div class="card mb-4">
                <!-- Set background image -->
                <div class="card-header" style="background-image: url('{{ asset($package->background_image) }}'); height: 150px; background-size: cover; background-position: center;"></div>
                <div class="card-body">
                    <!-- Use Google Fonts for a stylish title -->
                    <h5 class="card-title" style="font-family: 'Oswald', sans-serif;">{{ $package->name }}</h5>
                    <p class="card-text">Original Price: ${{ $package->original_price }}</p>
                    <p class="card-text">Discount: {{ $package->discount_percentage }}%</p>
                    <p class="card-text">Discounted Price: ${{ $package->discounted_price }}</p>
                    <p class="card-text">Duration: {{ $package->duration }} months</p>
                    <a href="#" class="btn btn-primary" style="font-family: 'Roboto', sans-serif;">Buy Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Add Google Fonts link -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
@endsection
