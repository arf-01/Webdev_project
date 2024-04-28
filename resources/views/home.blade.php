@extends('layout')

@section('content')
    
    <section id="about" class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg p-5">
                        <h2 class="card-title text-center mb-4">About Us</h2>
                        <p class="card-text text-center">
                           EclipsElite is a sleek and modern space filled with state-of-the-art equipment, energetic vibes, and friendly staff. It's designed for efficiency and effectiveness, with designated areas for cardio, strength training, group classes, and stretching. Whether you're a beginner or a seasoned fitness enthusiast, this gym provides the perfect environment to pursue your health and wellness goals.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="branches" class="bg-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h2 class="text-center mb-4">Branches</h2>
                    <ul class="list-group">
                        @foreach($branches as $branch)
                            <li class="list-group-item">
                                <strong>{{ $branch->name }}</strong><br>
                                {{ $branch->address }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-lg p-5">
                        <h2 class="card-title text-center mb-4">Contact Us</h2>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><strong>Email:</strong> EclipsElite@outlook.com</li>
                            <li class="list-group-item"><strong>Phone:</strong> 01300011155</li>
                            <li class="list-group-item"><strong>Address:</strong> Fulbarigate,Teligati,Khulna</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
