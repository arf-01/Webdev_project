@extends('layout')

@section('sec', 'login')

@section('content')

<div class="container-fluid d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card border-primary shadow-lg p-3 mb-5 bg-white rounded" style="width: 500px;">
        <div class="card-body">
            <h5 class="card-title">Login</h5>
            <form action="{{ route('loginpost') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>

@endsection

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

