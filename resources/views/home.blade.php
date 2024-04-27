@extends('layout')

@section('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">EclipsElite</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#branches">Branches</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>
                <span class="navbar-text">
                    <div class="d-flex align-items-center">
                        @guest
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                            <span class="mx-2">|</span> 
                            <a class="nav-link" href="{{ route('registration') }}">Register</a>
                        @else
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        @endguest
                    </div>
                </span>
            </div>
        </div>
    </nav>

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
